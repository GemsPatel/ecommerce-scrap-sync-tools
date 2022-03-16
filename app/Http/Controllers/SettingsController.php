<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use App\Http\Controllers\BrightpearlController;
	use App\Http\Controllers\ShopifyController;
	use App\Helper\MainModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

	class SettingsController extends Controller
	{

		public $obj, $SfCtrl;
		public function __construct()
		{
			$this->middleware('auth');
			$this->obj = new MainModel();
			$this->SfCtrl = new ShopifyController();
			$this->BpCtrl = new BrightpearlController();
		}
		/**
			* @return \Illuminate\Contracts\Support\Renderable
		*/
		public function index(Request $request)
		{
			$org_id = Auth::User()->org_id;

			$params_bp = ['api.organization_id'=>$org_id, 'api.status'=>1, 'api.api_provider'=>'brightpearl'];
			$bp_account_details = DB::table('api_config AS api')->where($params_bp)
			->select('api.organization_id', 'api.account_name', 'api.app_id', 'api.app_secret')->first();

			$params_sf = ['api.organization_id'=>$org_id,'api.status'=>1, 'api.api_provider'=>'shopify'];
			$shopify_account_details = DB::table('api_config AS api')->where($params_sf)
			->select('api.organization_id', 'api.access_token', 'api.domain')->first();

			return view('setting',['ActiveMenu'=>'Settings','shopify_account_details'=>$shopify_account_details,'bp_account_details'=>$bp_account_details]);
		}

		public function connectShopifyAccount(Request $request)
		{
			$org_id = Auth::User()->org_id;
			$shopify_domain = $request->shopify_domain;
			$shopify_access_token = $request->shopify_access_token;

			// checking credentials are valid or not
			$is_valid = $this->SfCtrl->checkShopifyCredentials($shopify_domain,$shopify_access_token);
			if($is_valid){

				$sf_ac = $this->obj->getFirstResultByConditions('api_config',['organization_id'=>$org_id,'api_provider'=>'shopify'], ['id']);
                if($sf_ac){
                    $this->obj->makeUpdate('api_config',
                    ['access_token'=>base64_encode($shopify_access_token),'domain'=>base64_encode($shopify_domain),'ac_connected_date'=>date('Y-m-d H:i:s'),'status'=>1],
                    ['id'=>$sf_ac->id]);
                }else{
                    $this->obj->makeInsert('api_config',['organization_id'=>$org_id,'api_provider'=>'shopify',
					'access_token'=>base64_encode($shopify_access_token),'domain'=>base64_encode($shopify_domain),'ac_connected_date'=>date('Y-m-d H:i:s')]);
                }

				$response = ['status_code' => 1, 'status_text' => 'Connected Successfully' ];
			}else{
				$response = ['status_code' => 0, 'status_text' => 'Invalid Credentials' ];
			}
			return $response;
		}

		public function disconnectShopifyAccount(Request $request)
		{
			$org_id = Auth::User()->org_id;

			DB::table('api_config')->where(['organization_id'=>$org_id, 'api_provider'=>'shopify',])
			->update(['account_name'=>null,'app_id'=>null,'app_secret'=>null,'status'=>0,
			'domain'=>null,'access_token'=>null,'ac_connected_date'=>null,'sync_ac'=>1,'sync_completed'=>0,'mail_notified'=>0]);

			$this->obj->makeDelete('mapping_sf_bp',['organization_id'=>$org_id]); // Mapping deletion
			$this->obj->makeDelete('sync_settings',['organization_id'=>$org_id]);
			$this->obj->makeDelete('sync_process_logs',['organization_id'=>$org_id]);
			$this->obj->makeDelete('shopify_urls',['organization_id'=>$org_id]);
			$this->obj->makeDelete('shopify_product',['organization_id'=>$org_id]);
			$this->obj->makeDelete('sf_bp_fields',['organization_id'=>$org_id,'platform'=>'shopify']);
		}

		public function connectBrightpearlAccount(Request $request)
		{
			$org_id = Auth::User()->org_id;
			$bp_app_ref = $request->bp_app_ref;
			$bp_account_token = $request->bp_account_token;
			$bp_account_name = $request->bp_account_name;

			// checking credentials are valid or not
			$is_valid = $this->BpCtrl->checkBPCredentials($bp_app_ref,$bp_account_token,$bp_account_name);
			if($is_valid){

				$sf_ac = $this->obj->getFirstResultByConditions('api_config',['organization_id'=>$org_id,'api_provider'=>'brightpearl'], ['id']);
                if($sf_ac){
                    $this->obj->makeUpdate('api_config',
                    ['account_name'=>$bp_account_name,'app_id'=>base64_encode($bp_app_ref),'app_secret' => base64_encode($bp_account_token),'ac_connected_date'=>date('Y-m-d H:i:s'),'status'=>1],
                    ['id'=>$sf_ac->id]);
                }else{
                    $op = $this->obj->makeInsertGetId('api_config',['organization_id'=>$org_id,'api_provider'=>'brightpearl','account_name'=>base64_encode($bp_account_name),
					'app_id'=>base64_encode($bp_app_ref),'app_secret'=>base64_encode($bp_account_token),'ac_connected_date'=>date('Y-m-d H:i:s')]);
                }

				$response = ['status_code' => 1, 'status_text' => 'Connected Successfully' ];
			}else{
				$response = ['status_code' => 0, 'status_text' => 'Invalid Credentials' ];
			}
			return $response;
		}

		public function disconnectBrightpearlAccount(Request $request)
		{
			$org_id = Auth::User()->org_id;

			DB::table('api_config')->where(['api_provider'=>'brightpearl','organization_id'=>$org_id])
			->update(['account_name'=>null,'app_id'=>null,'app_secret'=>null,'ac_connected_date'=>null,'status'=>0,'sync_ac'=>1,'sync_completed'=>0,'pre_initial_sync'=>0,'mail_notified'=>0]);
			$this->obj->makeDelete('mapping_sf_bp',['organization_id'=>$org_id]); // Mapping deletion
			$this->obj->makeDelete('sync_settings',['organization_id'=>$org_id]);
			$this->obj->makeDelete('sync_process_logs',['organization_id'=>$org_id]);
			$this->obj->makeDelete('brightpearl_urls',['organization_id'=>$org_id]);
			$this->obj->makeDelete('brightpearl_product',['organization_id'=>$org_id]);
			$this->obj->makeDelete('sf_bp_fields',['organization_id'=>$org_id,'platform'=>'brightpearl']);

		}

		public function restartProductSync(){
			$org_id = Auth::User()->id;

			try{

				$this->obj->makeDelete('mapping_sf_bp',['organization_id'=>$org_id]); // Mapping deletion
				$this->obj->makeDelete('sync_settings',['organization_id'=>$org_id]);
				$this->obj->makeDelete('sync_process_logs',['organization_id'=>$org_id]);
				$this->obj->makeDelete('brightpearl_urls',['organization_id'=>$org_id]);
				$this->obj->makeDelete('brightpearl_product',['organization_id'=>$org_id]);
				$this->obj->makeDelete('shopify_urls',['organization_id'=>$org_id]);
				$this->obj->makeDelete('shopify_product',['organization_id'=>$org_id]);
				$this->obj->makeDelete('sf_bp_fields',['organization_id'=>$org_id]);

				$this->obj->makeUpdate('api_config',['pre_initial_sync'=>0, 'sync_ac'=>1, 'sync_completed'=>0, 'mail_notified'=>0],['organization_id'=>$org_id]);

				$response = response()->json(['status_code' => 1, 'status_text' => 'Product sync has been restarted.']);
				return $response;
			}catch (\Exception $e) {
				$response = response()->json(['status_code' => 0, 'status_text' => $e->getMessage()]);
				return $response;
			}
		}

	}
