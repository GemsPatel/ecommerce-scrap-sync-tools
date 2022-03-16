<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use App\Http\Controllers\ShopifyController;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Yajra\Datatables\Datatables;

	class LogsController extends Controller
	{

		/**
			* @return \Illuminate\Contracts\Support\Renderable
		*/

		public function __construct()
		{
			$this->middleware('auth');
		}

		public function product_logs(Request $request){
			return view('product_log',['ActiveMenu'=>'Product Logs']);
		}

		public function get_product_log(Request $request){
			$org_id = Auth::user()->org_id;
			$filter_by_status = $request->filter_by_status;

			//$ordersyncstartdate = '2021-03-06';

			$Results = DB::table('brightpearl_product As bp_prod')
			->select('bp_prod.*', 'log.response')
			->leftJoin('sync_process_logs AS log', 'log.record_id', '=', 'bp_prod.id')
			->where('bp_prod.organization_id',$org_id)->where('bp_prod.is_deleted', 0)
			//->whereDate('bp_prod.created_at', '>=', $ordersyncstartdate)
			->Where(function ($query) use($filter_by_status) {
				if($filter_by_status=='synced'){
					$query->where('bp_prod.product_sync_status','synced');
				}else if($filter_by_status=='pending'){
					$query->where('bp_prod.product_sync_status','pending');
				}else if($filter_by_status=='failed'){
					$query->where('bp_prod.product_sync_status','failed');
				}
			})->get();

			foreach($Results as $result)
			{
				$result->created_at = $result->created_at ? date('d-m-Y h:i A',strtotime($result->created_at)) : '';
				//$result->sync_date_time = $result->sync_date_time ? date('m/d/Y h:i A',strtotime($result->sync_date_time)) : '';
				//$result->sync_date = date('m/d/Y h:i A',strtotime($result->sync_date) - (5*60*60));
				//$result->product_sync_status = strtoupper($result->product_sync_status);
			}
			return Datatables::of($Results)->make(true);
		}

		public function resyncProduct(Request $request){
			$SFC = new ShopifyController;
			$id = $request->id;

			$response = response()->json(['status_code' => 0, 'status_text' => 'Error In Resync. Please try again']);

			$nresponse = $SFC->makeUpdateShopifyItem(Auth::user()->id, $id);

			if($nresponse){
				return $nresponse;
			}else{
				$response = response()->json(['status_code' => 0, 'status_text' => 'Error in Resync. Please check your Sync Configuration Settings']);
			}

			return $response;
		}

	}
