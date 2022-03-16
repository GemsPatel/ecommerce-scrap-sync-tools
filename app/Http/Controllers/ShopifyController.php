<?php
	namespace App\Http\Controllers;
	use App\Helper\MainModel;
	use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\DB;

	class ShopifyController extends Controller
	{
		/**
			* Create a new controller instance.
			*
			* @return void
		*/

		public static $provider_sf = 'shopify';
    	public static $provider_bp = "brightpearl";
		public $obj, $common;
		public function __construct()
		{
			$this->obj = new MainModel();
			$this->common = new CommonController();
		}

        // Comman function to perform different shopify curl operations (GET/POST/DELETE)
		public function curlRequestShopify($org_id,$method,$target_url,$postData=''){

			$res = array();
			$accountdetails = $this->getSFCredentials($org_id);

			if( $accountdetails ){

				$domain = base64_decode($accountdetails->domain);
				$access_token = base64_decode($accountdetails->access_token);

				$url = 'https://'.$domain.'/admin/api/2021-01/'.$target_url;

				if($method=='POST'){
					$curl = curl_init();

					curl_setopt_array($curl, array(
					  CURLOPT_URL => $url,
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'POST',
					  CURLOPT_POSTFIELDS =>$postData,
					  CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json',
						'X-Shopify-Access-Token: '.$access_token
					  ),
					));

					$result = curl_exec($curl);
					if (curl_errno($curl)) {
						echo 'Error:' . curl_error($curl);
					}
					$info = curl_getinfo($curl);
					curl_close ($curl);
					$result_data = json_decode($result,true);
					$res['status_code'] = $info['http_code'];
					$res['result_data'] = $result_data;

				}else if($method=='DELETE'){

					$curl = curl_init();
					curl_setopt_array($curl, array(
					  CURLOPT_URL => $url,
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'DELETE',
					  CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json',
						'X-Shopify-Access-Token: '.$access_token
					  ),
					));

					$result = curl_exec($curl);
					if (curl_errno($curl)) {
						echo 'Error:' . curl_error($curl);
					}
					$info = curl_getinfo($curl);
					curl_close ($curl);

					$result_data = json_decode($result,true);
					$res['status_code'] = $info['http_code'];
					$res['result_data'] = $result_data;

				}else if($method=='GET'){

					$curl = curl_init();
					curl_setopt_array($curl, array(
					  CURLOPT_URL => $url,
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'GET',
					  CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json',
						'X-Shopify-Access-Token: '.$access_token
					  ),
					));

					$result = curl_exec($curl);
					if (curl_errno($curl)) {
						echo 'Error:' . curl_error($curl);
					}
					$info = curl_getinfo($curl);
					curl_close ($curl);

					$result_data = json_decode($result,true);
					$res['status_code'] = $info['http_code'];
					$res['result_data'] = $result_data;


				}else if($method=='PUT'){
					$curl = curl_init();

					curl_setopt_array($curl, array(
					  CURLOPT_URL => $url,
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'PUT',
					  CURLOPT_POSTFIELDS =>$postData,
					  CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json',
						'X-Shopify-Access-Token: '.$access_token
					  ),
					));

					$result = curl_exec($curl);
					if (curl_errno($curl)) {
						echo 'Error:' . curl_error($curl);
					}
					$info = curl_getinfo($curl);
					curl_close ($curl);
					$result_data = json_decode($result,true);
					$res['status_code'] = $info['http_code'];
					$res['result_data'] = $result_data;
				}
				return $res;

			}else{
				echo "send error mail";
				// send email to admin to connect their account
			}
		}

		/* Get Shopify Credentials */
		public function getSFCredentials($accountCode)
		{
			$exist = DB::table('api_config')->select('id', 'organization_id', 'domain', 'access_token', 'status', 'sync_completed', 'ac_connected_date')
			->where('status', '1')->where('api_provider', 'shopify')
			->where(function ($query1) use ($accountCode) {
				$query1->where('organization_id', $accountCode);
			})->first();

			if ($exist) {
				return $exist;
			}
			return false;
		}

        // Function to check shopify account credentials whether it is exist and valid or not
		public function checkShopifyCredentials($shopify_domain,$access_token)
		{
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://'.$shopify_domain.'/admin/api/2021-01/webhooks.json',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'X-Shopify-Access-Token: '.$access_token,
			  ),
			));

			$result = curl_exec($curl);
			if (curl_errno($curl)) {
				echo 'Error:' . curl_error($curl);
			}
			$info = curl_getinfo($curl);
			curl_close ($curl);

			$status = false;
			if($info['http_code']==200 || $info['http_code']==201){
				$status = true;
			}
			return $status;
		}

		public function sfFetchUserInitialData($org_id){
			$this->initialSyncExistingProductsSF($org_id);
		}

		public function initialSyncExistingProductsSF($org_id){
			$limit = 250;
			$since_id = 0;
			$is_url = $this->obj->getFirstResultByConditions('shopify_urls', ['organization_id'=>$org_id, 'status'=>1, 'url_name'=>'initial_product'], ['id', 'page', 'inprocess']);
			if($is_url){
				if($is_url->inprocess == 1){
					return false;
				}
				$url_id = $is_url->id;
				$since_id = $is_url->page;
				$this->obj->makeUpdate('shopify_urls', ['inprocess'=>1], ['id' => $url_id]);
			}else{
				$url_data = [
					'organization_id' => $org_id,
					'url_name' => 'initial_product',
					'inprocess' => 1
				];
				$url_id = $this->obj->makeInsertGetId('shopify_urls', $url_data);
			}

			// $total = 0;
			$response = $this->curlRequestShopify($org_id,'GET','products.json?since_id='.$since_id.'&limit='.$limit,'');
			if($response['status_code']==200 || $response['status_code']==201){

				$result = $response['result_data']['products'];
				if(count($result) > 0){

					foreach($result as $row){
						// $total++;
						$since_id = $row['id'];
						$this->createUpdateShopifyProducts($row,$org_id);
					}

				}

				if(count($result) < $limit){
					$this->obj->makeUpdate('shopify_urls', ['page'=>0, 'status'=>0, 'inprocess'=>0], ['id' => $url_id]);
					$this->obj->makeUpdate('api_config',['sync_completed'=>1, 'sync_ac'=>0],['organization_id'=>$org_id,'api_provider'=>'shopify']);
				}else{
					$this->obj->makeUpdate('api_config', ['sync_ac'=>1], ['organization_id'=>$org_id,'api_provider'=>'shopify']);
					$this->obj->makeUpdate('shopify_urls', ['page'=>$since_id, 'inprocess'=>0], ['id' => $url_id]);
				}

				return true;
			}else{
				return false;
			}
		}

        // Function to create/update shopify orders recored in app's database
		public function createUpdateShopifyProducts($row,$org_id)
		{
			$product_id = @$row['id'];

			if(count($row['variants']) > 0){
				foreach($row['variants'] as $rline){
					$product_variant_id = @$rline['id'];
					$arrlineitems = array();
					$arrlineitems['organization_id'] = $org_id;
					$arrlineitems['product_id'] = $product_id;
					$arrlineitems['product_variant_id'] = $product_variant_id;
					$arrlineitems['title'] = @$rline['title'];
					$arrlineitems['sku'] = @$rline['sku'];
					$arrlineitems['barcode'] = @$rline['barcode'];
					$arrlineitems['option1'] = @$rline['option1'];
					$arrlineitems['option2'] = @$rline['option2'];
					$arrlineitems['option3'] = @$rline['option3'];
					$arrlineitems['api_created_at'] = @$rline['created_at'];
					$arrlineitems['api_updated_at'] = @$rline['updated_at'];

					$existing = $this->obj->getFirstResultByConditions('shopify_product',
								[ 'organization_id'=>$org_id, 'product_id'=>$product_id, 'product_variant_id'=>$product_variant_id ],
								[ 'id' ]); // Check whether all uri are processed or not. Status 0 means not processed.
					if($existing){
						$this->obj->makeUpdate('shopify_product', ['id'=>$existing->id], $arrlineitems);
					}else{
						$this->obj->makeInsert('shopify_product', $arrlineitems);
					}

				}
			}

		}

		public function syncProductsInSF($org_id){

			set_time_limit(0);
			$params = ['api_config.api_provider'=>self::$provider_sf,'api_config.status'=>1,'api_config.sync_completed'=>1];
			if($org_id){
				$params['api_config.organization_id'] = $org_id;
			}
			$sf_info = DB::table('api_config')->leftJoin('users','users.id','=','api_config.organization_id')
			->where('users.status','=',1)
			->where($params)
			->select('api_config.id','api_config.organization_id')
			->get();

			$process_limit = 100;

			foreach($sf_info as $api_ek => $api_exsist){

				/*$product = DB::table('sync_settings')
				->leftJoin('sf_bp_fields','ls_bp_fields.id','=','sync_settings.sf_product_unique_map')
				->where(['sync_settings.organization_id'=>$api_exsist->organization_id,
				'sync_settings.api_config_id'=>$api_exsist->id,'sync_settings.setting_type'=>'product'])
				->select('sync_settings.allow_product_sync', 'sync_settings.id', 'ls_bp_fields.name as field_name')->first();

				$allow_sync = 0;
				if( $product && $product->allow_product_sync=='1' ){
					$allow_sync = 1;
				}*/

				$allow_sync = 1;
				if($allow_sync){ // Block sync if sync settings off

					do{
						$allow_next_call = false;

						/*$bp_items = DB::table('brightpearl_product AS A')
						->where(['A.product_sync_status'=>'pending','A.organization_id'=>$api_exsist->organization_id,'A.is_deleted'=>0])
						->limit($process_limit)
						->orderBy('A.updated_at','ASC')
						->select('A.id','A.product_sync_status')->get();
						if(!count($bp_items)){ // If pending not found check for other failed, synced
							$bp_items = DB::table('brightpearl_product AS A')
							->where(['A.product_sync_status'=>'failed','A.organization_id'=>$api_exsist->organization_id,'A.is_deleted'=>0])
							->limit($process_limit)
							->orderBy('A.updated_at','ASC')
							->select('A.id','A.product_sync_status')->get();
						}*/ // old concept to get records

						$bp_items = DB::table('brightpearl_product AS A')
						->where(['A.organization_id'=>$api_exsist->organization_id,'A.is_deleted'=>0])
						->where(function ($query1)  {
							$query1->where('A.product_sync_status', '=', 'pending');
							$query1->orWhere('A.product_sync_status', '=', 'failed');
						})
						->limit($process_limit)
						->orderBy('A.product_sync_status','ASC')
						->orderBy('A.updated_at','ASC')
						->select('A.id','A.product_sync_status')->get();

						if(count($bp_items) == $process_limit){ // Don't want to loop contineously
							$allow_next_call = false;
						}

						$process_ids = [];
						foreach($bp_items as $lk => $lv){
							$process_ids[] = $lv->id;
							$update_data = ['product_sync_status'=>'processing'];
							$this->obj->makeUpdate('brightpearl_product',$update_data,['id'=>$lv->id, 'organization_id'=>$api_exsist->organization_id]);
						}

						foreach($process_ids as $pk => $pv){
							$this->makeUpdateShopifyItem($api_exsist->organization_id, $pv);
						}

					}while($allow_next_call);
				}
			}
		}

		public function makeUpdateShopifyItem($org_id, $bp_id){

			$post_data = [];
			$bp_info = '';
			$bp_info = DB::table('brightpearl_product AS itm_bp')
			->select('itm_bp.id', 'itm_bp.organization_id', 'itm_bp.sku', 'itm_bp.upc', 'itm_bp.shopify_item_id')
			->where(['itm_bp.id'=>$bp_id, 'itm_bp.organization_id'=>$org_id])->first();

			if($bp_info){  // if sku or upc not found then don't sync
				$nmsg = null;
				if( !trim($bp_info->upc) ){
					$nmsg = 'Item creation failed. UPC not found';
				}
				if( !trim($bp_info->sku) ){
					$nmsg = 'Item creation failed. SKU not found';
				}
				if( $nmsg ){
					$update_data = ['product_sync_status'=>'failed','last_product_sync_time'=>date('Y-m-d H:i:s')];
					$this->obj->makeUpdate('brightpearl_product',$update_data,['id'=>$bp_id, 'organization_id'=>$bp_info->organization_id]);
					$this->common->sync_process_logs('product', 'failed', $nmsg, $bp_id, $bp_info->organization_id);
					return response()->json(['status_code' => 0, 'status_text' => $nmsg]);
				}
            }

			if( $bp_info ){
                $sf_product_id = null;
				$sf_product_variant_id = null;
				$option1 = null;
				$option2 = null;
				$option3 = null;

				$sf_unique_key = 'barcode';

				if( !$sf_product_id && $bp_info && $bp_info->upc ){ // If Ls SKU found check bp sku

                    $sf_info = $this->obj->getFirstResultByConditions('shopify_product',
					[ "$sf_unique_key"=>$bp_info->upc, 'organization_id'=>$org_id, 'status'=>1 ],
					[ 'product_id', 'product_variant_id', 'barcode', 'option1', 'option2', 'option3' ]);

                    if($sf_info && $sf_info->product_variant_id){
						$sf_product_id = $sf_info->product_id;
                        $sf_product_variant_id = $sf_info->product_variant_id;
						$option1 = $sf_info->option1;
						$option2 = $sf_info->option2;
						$option3 = $sf_info->option3;
                    }
                }

				if( isset($sf_product_id) && isset($sf_product_variant_id) ){
					$post_data['product']['id'] = $sf_product_id;
					$post_data['product']['variants'][] = [
						"product_id"=> $sf_product_id,
						"variants_id"=> $sf_product_variant_id,
						"sku"=> $bp_info->sku,
						"option1"=> $option1,
						"option2"=> $option2,
						"option3"=> $option3
					];

					$response = $this->curlRequestShopify($org_id, 'PUT', 'products/'. $sf_product_id .'.json', json_encode($post_data, true));
					if($response['status_code']==200 || $response['status_code']==201){
						if( isset($response['result_data']) && isset($response['result_data']['product']) ){
							$item = $response['result_data']['product'];
							$item_info = $this->obj->getFirstResultByConditions('shopify_product',
										['product_id'=>$item['id'], 'organization_id'=>$org_id],
										['id']);

							if($item_info){
								$fk_sf_product_id = $item_info->id;
								$shopify_sync_info = [
									'title'=> $item['variants'][0]['title'],
									'sku'=> $item['variants'][0]['sku'],
									'barcode'=> $item['variants'][0]['barcode'],
									'option1'=> $item['variants'][0]['option1'],
									'option2'=> $item['variants'][0]['option2'],
									'option3'=> $item['variants'][0]['option3'],
									'api_created_at'=> $item['variants'][0]['created_at'],
									'api_updated_at'=> $item['variants'][0]['updated_at'],
									'last_product_sync_time'=> date('Y-m-d H:i:s'),
									'product_sync_status'=> 'synced',
									'brightpearl_item_id'=> $bp_id
								];

								$this->obj->makeUpdate('shopify_product', $shopify_sync_info, ['id'=>$fk_sf_product_id]);
								$bp_sync_info = [ 'product_sync_status'=>'synced', 'last_product_sync_time'=>date('Y-m-d H:i:s'), 'shopify_item_id'=>$fk_sf_product_id ];
								$this->obj->makeUpdate('brightpearl_product', $bp_sync_info, ['id'=>$bp_id, 'organization_id'=>$org_id]);
							}

							$nmsg = 'Product Synced Successfully!';
							$update_data = ['product_sync_status'=>'synced', 'last_product_sync_time'=>date('Y-m-d H:i:s')];
							$this->obj->makeUpdate('brightpearl_product', $update_data, ['id'=>$bp_id, 'organization_id'=>$bp_info->organization_id]);
							$this->common->sync_process_logs('product', 'synced', $nmsg, $bp_id, $bp_info->organization_id);
							return response()->json(['status_code' => 1, 'status_text' => $nmsg]);
						}

					}else{

						$nmsg = 'Item not found.';
						if( isset($response['error']) ){
							$nmsg = $response['error'];
						}
						$update_data = ['product_sync_status'=>'failed', 'last_product_sync_time'=>date('Y-m-d H:i:s')];
						$this->obj->makeUpdate('brightpearl_product', $update_data, ['id'=>$bp_id, 'organization_id'=>$bp_info->organization_id]);
						$this->common->sync_process_logs('product', 'failed', $nmsg, $bp_id, $bp_info->organization_id);
						return response()->json(['status_code' => 0, 'status_text' => $nmsg]);

					}
				}else{

					$update_data = ['product_sync_status'=>'failed','last_product_sync_time'=>date('Y-m-d H:i:s')];
					$nmsg = 'No relevant item found in Shopify to sync this item.';
					$this->obj->makeUpdate('brightpearl_product', $update_data, ['id'=>$bp_id, 'organization_id'=>$bp_info->organization_id]);
					$this->common->sync_process_logs('product', 'failed', $nmsg, $bp_id, $bp_info->organization_id);
					return response()->json(['status_code' => 0, 'status_text' => $nmsg]);

				}

			}

		}

	}

