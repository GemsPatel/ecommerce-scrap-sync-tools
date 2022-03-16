<?php
	namespace App\Http\Controllers;
	use Illuminate\Http\Request;
	use App\Helper\MainModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

	class ConfigurationController extends Controller
	{
		/**
			* Create a new controller instance.
			*
			* @return void
		*/

		public function __construct()
		{
			$this->middleware('auth');
			$this->obj = new MainModel();
		}

		public function index(Request $request)
		{
			$org_id = Auth::User()->org_id;

			$params_bp = ['api.organization_id'=>$org_id, 'api.status'=>1, 'api.api_provider'=>'brightpearl'];
			$bp_account = DB::table('api_config AS api')->where($params_bp)
			->select('api.organization_id', 'api.account_name', 'api.app_id', 'api.app_secret', 'api.status')->first();

			$product = $this->obj->getFirstResultByConditions('sync_settings',
			['organization_id'=>$org_id, 'setting_type'=>'product'],
			['id', 'allow_product_sync', 'sf_product_unique_map']);

			$bp_fields = '';
			$bp_fields_sku = '';
			$sf_fields = '';
			$sf_fields_sku = '';
			$fields = DB::table('sf_bp_fields')->where(['status'=>1,'type'=>'product','organization_id'=>0])->get();
			//dd($fields);
			foreach($fields as $fk => $fv){
				if($fv->platform=='brightpearl'){
					$bp_fields .= '<option value="'.$fv->id.'">'.$fv->description.'</option>';
					if (strpos(strtolower($fv->name), 'upc') !== false){
						$bp_fields_sku .= '<option value="'.$fv->id.'">'.$fv->description.'</option>';
					}
				}else if($fv->platform=='shopify'){
					$sf_fields .= '<option value="'.$fv->id.'">'.$fv->description.'</option>';
					if (strpos(strtolower($fv->name), 'barcode') !== false){
						$sf_selected = '';
						if($product && $product->sf_product_unique_map){
							if($fv->id == $product->sf_product_unique_map){
								$sf_selected = 'selected';
							}
						}else{
							if($fv->name == 'barcode'){
								$sf_selected = 'selected';
							}
						}

						$sf_fields_sku .= '<option '.$sf_selected.' value="'.$fv->id.'">'.$fv->description.'</option>';
					}
				}
			}
			$ActiveMenu = 'Sync Configuration';
			if(isset($bp_account->app_secret)){
				return view('sync_configuration', compact('ActiveMenu','bp_account','sf_fields','bp_fields','bp_fields_sku','sf_fields_sku','product'));
			}else{
				return redirect()->route('settings');
			}

		}

		public function save_product_setting(Request $request)
		{
			$org_id = Auth::User()->org_id;

			$fields = array(
				'bp_product_unique_map' => @$request->bp_product_unique_map ? $request->bp_product_unique_map : 0,
				'sf_product_unique_map' => @$request->sf_product_unique_map ? $request->sf_product_unique_map : 0,
				'allow_product_sync' => @$request->allow_product_sync ? $request->allow_product_sync : 0
			);

			DB::table('sync_settings')->where('organization_id', $org_id)->update($fields);

			return back()->with('success', 'Settings are updated!');
		}

	}
