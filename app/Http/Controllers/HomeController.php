<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $org_id = Auth::User()->org_id;

        $data['product_total'] = DB::table('brightpearl_product')->where('organization_id',$org_id)->count();
        $data['product_pending'] = DB::table('brightpearl_product')->where('organization_id',$org_id)->whereIn('product_sync_status',['pending','processing'])->count();
		$data['product_synced'] = DB::table('brightpearl_product')->where('organization_id',$org_id)->whereIn('product_sync_status',['synced'])->count();
		$data['product_failed'] = DB::table('brightpearl_product')->where('organization_id',$org_id)->where('product_sync_status','failed')->count();

		// return view('home',['ActiveMenu'=>'Dashboard','product_total'=>$product_total,'product_pending'=>$product_pending,'product_synced'=>$product_synced,'product_failed'=>$product_failed]);
        return view('home',[$data]);
    }

}
