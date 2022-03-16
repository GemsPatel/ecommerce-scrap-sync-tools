@php
//$bp_account_connect = DB::table('bp_account')->where('status', 1)->where('org_id', Auth::User()->org_id)->count();
//$shopify_account_connect = DB::table('shopify_account')->where('status', 1)->where('org_id', Auth::User()->org_id)->count();

	$params_bp = ['api.organization_id'=>$org_id, 'api.status'=>1, 'api.api_provider'=>'brightpearl'];
	$bp_account_connect = DB::table('api_config AS api')->where($params_bp)
	->select('api.organization_id', 'api.account_name', 'api.app_id', 'api.app_secret', 'api.sync_completed')->first();

	$params_sf = ['api.organization_id'=>$org_id, 'api.status'=>1, 'api.api_provider'=>'shopify'];
	$shopify_account_connect = DB::table('api_config AS api')->where($params_sf)
	->select('api.organization_id', 'api.account_name', 'api.app_id', 'api.app_secret', 'api.sync_completed')->first();

	$arrcompletemsg = array();

	if( $params_bp && $params_bp->sync_completed != 1 ){
		$arrcompletemsg[] = "<i class='mdi mdi-alert'></i> Please wait before turning ON the Synchronization, Brightpearl Products are getting fetched!";
	}

	if( $params_sf && $params_sf->sync_completed != 1 ){
		$arrcompletemsg[] = "<i class='mdi mdi-alert'></i> Please wait before turning ON the Synchronization, Shopify Products are getting fetched!";
	}

	@endphp

	@if(count($arrcompletemsg) >  0 && $bp_account_connect && $shopify_account_connect)
	<div class="alert alert-warning alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<small><?php echo implode('<br/>',$arrcompletemsg); ?></small>
	</div>
@endif
