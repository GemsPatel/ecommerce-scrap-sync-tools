<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helper\BrightpearlApi;
use App\Http\Controllers\BrightpearlController;
use App\Http\Controllers\ShopifyController;
use App\Helper\MainModel;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test(){
        $SFC = new ShopifyController;
        $BPC = new BrightpearlController;
        $BPA = new BrightpearlApi;
        $obj = new MainModel;

        // $account_name = 'apiworxtest8';
        // $app_ref = 'apiworxtest8_1234';
        // $account_token = 'NCE283+jNS0rpcgEiSlb2C9VzlApYY8QeIsMwzTd06Q=';
        // dd($BPC->checkBPCredentials($app_ref,$account_token,$account_name));

        //dd($BPA->callCurlMethod('OPTIONS', "/product-service/product", 1));

        // $shopify_domain = 'm41store.myshopify.com';
        // $access_token = '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';
        // dd($SFC->checkShopifyCredentials($shopify_domain,$access_token));

        //dd($SFC->makeUpdateShopifyItem(1, 20));
        $process_limit = 10;
        $bp_items = DB::table('brightpearl_product AS A')
        ->where(['A.organization_id'=>1,'A.is_deleted'=>0])
        ->where(function ($query1)  {
            $query1->where('A.product_sync_status', '=', 'pending');
            $query1->orWhere('A.product_sync_status', '=', 'failed');
        })
        ->limit($process_limit)
        ->orderBy('A.product_sync_status','ASC')
        ->orderBy('A.updated_at','ASC')
        ->select('A.id','A.product_sync_status')->get();
        dd( $bp_items );
    }
}
