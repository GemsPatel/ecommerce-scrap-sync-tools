<?php

namespace App\Helper;

use Auth;
use DB;
use App\BrightpearlSync1;
use App\Helper\MainModel;
use App\Common;

class BrightpearlApi
{

    public $obj, $common;
    public function __construct()
    {
        //$this->common = new Common();
        $this->obj = new MainModel();
    }

    /* Common Method Brightpeal Curl Method */
    public function callCurlMethod($methodType = '', $url = '', $accountCode = '', $body = '')
    {
        $result = '';
        $ch = curl_init();

        $auth = $this->getBPCredentials($accountCode);

        if ($auth) {
            if (isset($auth->account_name)) {
                $baseUrl = env('BP_API_BASE_URL') . $auth->account_name . $url;
                $app_ref = base64_decode($auth->app_id);
                $access_token = base64_decode($auth->app_secret);

                if (strtolower($methodType) == 'post') {
                    /* CURL POST METHOD */
                    curl_setopt($ch, CURLOPT_URL, $baseUrl);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $methodType);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

                    $headers = array();
                    $headers[] = "Content-Type: application/json";
                    $headers[] = 'brightpearl-app-ref:' . $app_ref;
                    $headers[] = 'brightpearl-account-token:' . $access_token;


                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    sleep(1);
                    if (!$result = curl_exec($ch)) {
                        $result = curl_error($ch);
                    }
                    curl_close($ch);
                    return $result;
                } else if (strtolower($methodType) == 'put') {
                    /* CURL POST METHOD */
                    curl_setopt($ch, CURLOPT_URL, $baseUrl);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $methodType);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

                    $headers = array();
                    $headers[] = "Content-Type: application/json";
                    $headers[] = 'brightpearl-app-ref:' . $app_ref;
                    $headers[] = 'brightpearl-account-token:' . $access_token;


                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    sleep(1);
                    if (!$result = curl_exec($ch)) {
                        $result = curl_error($ch);
                    }
                    curl_close($ch);
                    return $result;
                } else if (strtolower($methodType) == 'patch') {
                    /* CURL POST METHOD */

                    curl_setopt($ch, CURLOPT_URL, $baseUrl);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $methodType);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

                    $headers = array();
                    $headers[] = "Content-Type: application/json";
                    $headers[] = 'brightpearl-app-ref:' . $app_ref;
                    $headers[] = 'brightpearl-account-token:' . $access_token;


                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    sleep(1);
                    if (!$result = curl_exec($ch)) {
                        $result = curl_error($ch);
                    }
                    curl_close($ch);
                    return $result;
                } else if (strtolower($methodType) == 'delete') {
                    /* CURL GET METHOD */
                    curl_setopt($ch, CURLOPT_URL, $baseUrl);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $methodType);

                    $headers = array();
                    $headers[] = "Content-Type: application/json";
                    $headers[] = 'brightpearl-app-ref:' . $app_ref;
                    $headers[] = 'brightpearl-account-token:' . $access_token;


                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    sleep(1);
                    if (!$result = curl_exec($ch)) {
                        $result = curl_error($ch);
                    }
                    curl_close($ch);
                    return $result;
                } else if (strtolower($methodType) == 'get') {
                    /* CURL GET METHOD */
                    curl_setopt($ch, CURLOPT_URL, $baseUrl);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $methodType);

                    $headers = array();
                    $headers[] = "Content-Type: application/json";
                    $headers[] = 'brightpearl-app-ref:' . $app_ref;
                    $headers[] = 'brightpearl-account-token:' . $access_token;

                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    sleep(1);
                    if (!$result = curl_exec($ch)) {
                        $result = curl_error($ch);
                    }
                    curl_close($ch);
                    return $result;
                } else {
                    /* CURL GET METHOD */
                    curl_setopt($ch, CURLOPT_URL, $baseUrl);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $methodType);

                    $headers = array();
                    $headers[] = "Content-Type: application/json";
                    $headers[] = 'brightpearl-app-ref:' . $app_ref;
                    $headers[] = 'brightpearl-account-token:' . $access_token;

                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    sleep(1);
                    if (!$result = curl_exec($ch)) {
                        $result = curl_error($ch);
                    }
                    curl_close($ch);
                    return $result;
                }
            }
        }

        return $result;
    }

    public function getHeaders($respHeaders)
    {
        $headers = array();

        $headerText = substr($respHeaders, 0, strpos($respHeaders, "\r\n\r\n"));

        foreach (explode("\r\n", $headerText) as $i => $line) {
            if ($i === 0) {
                $headers['http_code'] = $line;
            } else {
                list($key, $value) = explode(': ', $line);

                $headers[$key] = $value;
            }
        }

        return $headers;
    }

    /* Get Brightpeal Credentials */
    public function getBPCredentials($accountCode)
    {
        $exist = DB::table('api_config')->select('id', 'organization_id', 'account_name', 'app_id', 'app_secret', 'status', 'sync_completed', 'env_type', 'ac_connected_date')
        ->where('status', '1')->where('api_provider', 'brightpearl')
        ->where(function ($query1) use ($accountCode) {
            $query1->where('account_name', $accountCode)->Orwhere('organization_id', $accountCode);
        })->first();

        if ($exist) {
            return $exist;
        }
        return false;
    }

    public static function checkEmoji($str)
    {
        $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
        preg_match($regexEmoticons, $str, $matches_emo);
        if (!empty($matches_emo[0])) {
            // print_r($matches_emo[0]);
            return true;
        }

        // Match Miscellaneous Symbols and Pictographs
        $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
        preg_match($regexSymbols, $str, $matches_sym);
        if (!empty($matches_sym[0])) {
            // print_r($matches_sym[0]);
            return true;
        }

        // Match Transport And Map Symbols
        $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
        preg_match($regexTransport, $str, $matches_trans);
        if (!empty($matches_trans[0])) {
            //print_r($matches_trans[0]);
            return true;
        }

        // Match Miscellaneous Symbols
        $regexMisc = '/[\x{2600}-\x{26FF}]/u';
        preg_match($regexMisc, $str, $matches_misc);
        if (!empty($matches_misc[0])) {
            // print_r($matches_misc[0]);
            return true;
        }

        // Match Dingbats
        $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
        preg_match($regexDingbats, $str, $matches_bats);
        if (!empty($matches_bats[0])) {
            // print_r($matches_bats[0]);
            return true;
        }
        // Match  you can rip out everything from 0-31 and 127-255 with this:
        $regexUnwant = '/[\x00-\x1F\x7F-\xFF]/';
        preg_match($regexUnwant, $str, $matches_unwant);
        if (!empty($matches_unwant[0])) {
            // print_r($matches_unwant[0]);
            return true;
        }

        return false;
    }

    public function initialSyncExistingProductsBP($accountCode,$allow_updatedon_date=1) // Only for initial sync search id is direct product search
    {
        $initial_synced = 'No';

        $limit = 10;
        $getUris = $this->obj->getResultByConditions('brightpearl_urls', ['status' => 0, 'organization_id' => $accountCode, 'url_name' => 'product'], ['id', 'url'], ['created_at' => 'asc'], $limit);

        foreach($getUris as $getUri){
            $url = '/product-service'.$getUri->url.'?includeOptional=customFields,nullCustomFields';
            $result2 = $this->callCurlMethod('GET',$url, $accountCode);
            $data1 = json_decode($result2, 1);
            if (isset($data1['response'])) {
                $Items = $data1['response'];
                if(count($Items)){
                    foreach ($Items as $detail) {

                        if (isset($detail['salesChannels'][0]['productName']) && trim($detail['salesChannels'][0]['productName'])) {
                            $id = $detail['id'];

                            if (!self::checkEmoji($detail['identity']['sku'])) {

                                $fields = array(
                                    'organization_id' => $accountCode,
                                    'item_id' => $id,
                                    'sku' => !empty($detail['identity']['sku']) ? $detail['identity']['sku'] : NULL,
                                    'name' => !empty($detail['salesChannels'][0]['productName']) ? $detail['salesChannels'][0]['productName'] : NULL,
                                    'isbn' => isset($detail['identity']['isbn']) ? $detail['identity']['isbn'] : NULL,
                                    'ean' => isset($detail['identity']['ean']) ? $detail['identity']['ean'] : NULL,
                                    'upc' => isset($detail['identity']['upc']) ? $detail['identity']['upc'] : NULL,
                                    'mpn' => isset($detail['identity']['mpn']) ? $detail['identity']['mpn'] : NULL,
                                    'barcode' => isset($detail['identity']['barcode']) ? $detail['identity']['barcode'] : NULL,
                                    'status' => $detail['status'],
                                    'createdOn' => isset($detail['createdOn']) ? $detail['createdOn'] : NULL,
                                    'updatedOn' => isset($detail['updatedOn']) ? $detail['updatedOn'] : NULL
                                );

                            }

                            $existing = $this->obj->getFirstResultByConditions('brightpearl_product', ['item_id'=>$id, 'organization_id'=>$accountCode], ['id']);

                            if ( $existing ) {

                                if (!empty($fields)) {
                                    $fields['is_deleted'] = 0;
                                    $fields['product_sync_status'] = 'pending';
                                    $this->obj->makeUpdate('brightpearl_product', ['id'=>$existing->id], $fields);
                                }

                            } else {

                                if (!empty($fields)) {
                                    $this->obj->makeInsert('brightpearl_product', $fields);
                                }

                            }

                            $fields = []; // clear array after use

                        }

                    }

                    $this->obj->makeUpdate('brightpearl_urls', ['status' => 1], ['id' => $getUri->id]);
                }
            } else {
                if ( isset($data1['errors'][0]['code']) && $data1['errors'][0]['code'] == 'CMNC-404') {
                    $initial_synced = 'Yes';
                }
            }
        }

        return $initial_synced;
    }

}
