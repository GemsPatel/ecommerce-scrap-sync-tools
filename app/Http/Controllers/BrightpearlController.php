<?php
	namespace App\Http\Controllers;
	use App\Helper\MainModel;
	use App\Helper\BrightpearlApi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

	class BrightpearlController extends Controller
	{
		/**
			* Create a new controller instance.
			*
			* @return void
		*/
		public static $provider_sf = 'shopify';
		public static $provider_bp = "brightpearl";

		public $obj, $BpApi;
		public function __construct()
		{
			$this->BpApi = new BrightpearlApi();
			$this->obj = new MainModel();
		}

		// This method checks Brightpearl api connection by given api creds
		public function checkBPCredentials($app_ref,$account_token,$account_name)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, env('BP_API_BASE_URL').$account_name."/warehouse-service/warehouse");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			$headers = array();
			$headers[] = 'brightpearl-app-ref: '.$app_ref;
			$headers[] = 'brightpearl-account-token: '.$account_token;

			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			$info = curl_getinfo($ch);
			curl_close($ch);

			$status = false;
			if($info['http_code']==200 || $info['http_code']==201){
				$status = true;
			}
			return $status;
		}

		// This method is used to get all small and basic details of brightpearl before getting large record sets
		public function preInitialSync($user_id){
			$this->storeProductUrls($user_id);
			$this->obj->makeUpdate('api_config',['pre_initial_sync' => 1, 'sync_ac' => 1],['organization_id'=>$user_id,'api_provider'=>'brightpearl']);
		}

		// This method is used to get all large data sets. This calls after preInitialSync done.
		public function bpFetchUserInitialData($user_id){ // BP initial fetch in parts
			set_time_limit(0);

			$this->BpApi->initialSyncExistingProductsBP($user_id);  // Product & Custom order fields metadata

			$pending_uris = $this->obj->getCountsByConditions('brightpearl_urls', ['organization_id'=>$user_id, 'status'=>0]); // Check whether all uri are processed or not. Status 0 means not processed.
			if($pending_uris == 0){
				// If no uri are pending to process then update as sync is completed
				$this->obj->makeUpdate('api_config',['sync_completed' => 1, 'sync_ac' => 0],['organization_id'=>$user_id,'api_provider'=>'brightpearl']); // Updating price flag to updated
			}else{
				// If got pending uri then reset sync_ac as 1 to restart initial sync from cron
				$this->obj->makeUpdate('api_config',['sync_ac' => 1],['organization_id'=>$user_id,'api_provider'=>'brightpearl']);
			}
		}

		// This methos is user to send notification to client to inform that initial sync has been done.
		public function sendAcSyncedEmail($user_id=''){
			if($user_id){
			   	$users = $this->obj->getResultByConditions('users',['status'=>1,'id'=>$user_id], ['org_id', 'email']);
			}else{
				$users = $this->obj->getResultByConditions('users',['status'=>1], ['org_id', 'email']);
			}

			foreach($users as $uv){
				$bp_ac = $this->obj->getFirstResultByConditions('api_config',['organization_id'=>$uv->org_id,'api_provider'=>'brightpearl','sync_completed'=>1,'status'=>1], ['id', 'mail_notified']);
				$sf_ac = $this->obj->getFirstResultByConditions('api_config',['organization_id'=>$uv->org_id,'api_provider'=>'shopify','sync_completed'=>1,'status'=>1], ['id', 'mail_notified']);
				if($bp_ac && $sf_ac){
					if ($bp_ac->mail_notified=='0' || $sf_ac->mail_notified=='0'){
						$email = $uv->email;
						$final_arr = ['reason' => "Initial Sync Completed"];
						try {
							Mail::send('emails.configure_email_notification', ['data' => $final_arr], function ($msg) use ($email) {
								$msg->to($email);
								$msg->subject("Shopify-Brightpearl - Initial Sync Completed");
								$msg->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
							});

							$this->obj->makeUpdate('api_config',['mail_notified' => 1],['id'=>$sf_ac->id]);
							$this->obj->makeUpdate('api_config',['mail_notified' => 1],['id'=>$bp_ac->id]);
						} catch (\Exception $e) {
							// echo $e;
						}
					}
				}
			}
		}

		public function storeProductUrls($org_id){
			try{
				$params = ['api_config.api_provider'=>self::$provider_bp, 'api_config.status'=>1];
				if($org_id){
					$params['api_config.organization_id'] = $org_id;
				}

				$bp_info = DB::table('api_config')->leftJoin('users','users.id','=','api_config.organization_id')
				->where('users.status','=',1)->where($params)->select('api_config.organization_id')
				->get();

				foreach($bp_info as $api_exsist){
					$org_id = $api_exsist->organization_id;

					$result = $this->BpApi->callCurlMethod('OPTIONS', "/product-service/product", $org_id);
					$response = json_decode($result, true);
					if(isset($response['response']['getUris'])){
						$getUris = $response['response']['getUris'];
						foreach($getUris as $getUri){
							$bp_prod_uri = $this->obj->getFirstResultByConditions('brightpearl_urls', ['url' => $getUri, 'organization_id' => $org_id, 'url_name' => 'product'], ['id']);

							if (!$bp_prod_uri) {
								$this->obj->makeInsert('brightpearl_urls', ['url' => $getUri, 'organization_id' => $org_id, 'url_name' => 'product']);
							}
						}
					}
				}
			}
			catch (\Exception $e) {
				Log::error($e->getMessage());
				return $e->getMessage();
			}
		}

	}
