<?php

namespace App\Helper;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;

class MainModel extends Model
{
    public function makeInsert($tablename,array $fields){
        if ($tablename && $fields) {
            try {
                $fields = array_except($fields, ['_token','submitbtn']);
                return DB::table($tablename)->insert($fields);
            } catch (\Exception $e) {
                throw new \Exception('Error: ' . $e->getMessage());
            }
        } else throw new \Exception("Argument not passed");
    }

    public function makeInsertGetId($tablename,array $fields){
        if ($tablename && $fields) {
            try {
                $fields = array_except($fields, ['_token','submitbtn']);
                return DB::table($tablename)->insertGetId($fields);
            } catch (\Exception $e) {
                throw new \Exception('Error: ' . $e->getMessage());
            }
        } else throw new \Exception("Argument not passed");
    }

    public function makeUpdate($tablename, array $fields, array $where){ // can recieve multiple cond in array
        if ($tablename && $fields) {
            try {
                $fields = array_except($fields, ['_token','submitbtn','user_id']);
                return  DB::table($tablename)->where($where)->update($fields);
            } catch (\Exception $e) {
                throw new \Exception('Error: ' . $e->getMessage());
            }
        } else throw new \Exception("Argument not passed");
    }

    public function makeDelete($tablename,array $field){ // can recieve multiple cond in array
        if ($tablename && $field) {
            try {
                return  DB::table($tablename)->where($field)->delete();
            } catch (\Exception $e) {
                throw new \Exception('Error: ' . $e->getMessage());
            }
        } else throw new \Exception("Argument not passed");
    }

    public function isRecordExisist($tablename,$field_name,$val){ // only for single condition check
        if ($tablename && $field_name) {
            try {
                return DB::table($tablename)->where($field_name,'=',$val)->count();
            } catch (\Exception $e) {
                dd($e->getMessage());
                $errorCode = (int)$e->getCode();
                throw new \Exception($errorCode);
            }
        } else throw new \Exception("Argument not passed");
    }

    public function isRecordExisist2($tablename,$field_name){ // 2nd param can receive an array
        if ($tablename && $field_name) {
            try {
                return DB::table($tablename)->where($field_name)->count();
            } catch (\Exception $e) {
                dd($e->getMessage());
                $errorCode = (int)$e->getCode();
                throw new \Exception($errorCode);
            }
        } else throw new \Exception("Argument not passed");
    }

    public function getActiveStatusRecords($table){
        if ($table) {
            try {
                return DB::table($table)->where('status','1')->get();
            } catch (\Exception $e) {
                dd($e->getMessage());
                $errorCode = (int)$e->getCode();
                throw new \Exception($errorCode);
            }
        } else throw new \Exception("Argument not passed");
    }

    public function getResultByConditions($table, $where = [], $select = [], $orderby = [], $limit = 0, $offset = 0)
    { // Pass empty to skip condition param
        if ($table) {
            try {
                $response = DB::table($table);
                if (count($where))
                    $response->where($where);
                if (count($select))
                    $response->select($select);
                if (count($orderby)) {
                    foreach ($orderby as $field => $sorttype) {
                        $response->orderBy($field, $sorttype);
                    }
                }

                if ($limit != 0) {
                    $response->skip($offset);
                    $response->take($limit);
                }

                return $response->get();
            } catch (\Exception $e) {
                throw new \Exception('Error: ' . $e->getMessage());
            }
        } else throw new \Exception("Argument not passed");
    }

    public function getCountsByConditions($table,$arr){ // Pass empty to skip condition param
        if ($table) {
            try {
                if(count($arr))
                   return DB::table($table)->where($arr)->count();
                else
                   return DB::table($table)->count();
            } catch (\Exception $e) {
                dd($e->getMessage());
                $errorCode = (int)$e->getCode();
                throw new \Exception($errorCode);
            }
        } else throw new \Exception("Argument not passed");
    }

    public function getFirstResultByConditions($table, $where = [], $select = [], $orderby = [])
    {
        if ($table) {
            try {
                $response = DB::table($table);
                if (count($where))
                    $response->where($where);
                if (count($select))
                    $response->select($select);
                if (count($orderby))
                    foreach($orderby as $field=>$sorttype){
                        $response->orderBy($field,$sorttype);
                    }

                return $response->first();
            } catch (\Exception $e) {
                throw new \Exception('Error: ' . $e->getMessage());
            }
        } else throw new \Exception("Argument not passed");
    }

    public function time_since($timestamp) {
        $datetime1=new DateTime("now");
        $datetime2=date_create($timestamp);
        $diff=date_diff($datetime1, $datetime2);
        $timemsg='';
        if($diff->y > 0){
            $timemsg = $diff->y .' year'. ($diff->y > 1?"'s":'');
        }
        else if($diff->m > 0){
            $timemsg = $diff->m . ' month'. ($diff->m > 1?"'s":'');
        }
        else if($diff->d > 0){
            $timemsg = $diff->d .' day'. ($diff->d > 1?"'s":'');
        }
        else if($diff->h > 0){
            $timemsg = $diff->h .' hour'.($diff->h > 1 ? "'s":'');
        }
        else if($diff->i > 0){
            $timemsg = $diff->i .' minute'. ($diff->i > 1?"'s":'');
        }
        else if($diff->s > 0){
            $timemsg = $diff->s .' second'. ($diff->s > 1?"'s":'');
        }

        $timemsg = $timemsg.' ago';
        return $timemsg;
    }

    public function getAllTimeZone(){
        $timezone_list = DB::table('timezone')->orderBy('country','ASC')->get();
        return json_encode($timezone_list);
    }

    public function getAllNewTimeZone(){
        $timezone_list = DB::table('timezone_new')->where('status','1')->get();
        $quick_opt['US'] = ['Pacific Standard Time','Mountain Standard Time','Central Standard Time','Eastern Standard Time','Arizona, Phoenix'];
        $quick_opt['CAN'] = ['Eastern Daylight Time','Newfoundland Daylight Time','Atlantic Daylight Time','Central Daylight Time','Central Standard Time','Mountain Daylight Time','Pacific Daylight Time'];
        $quick_opt['UK'] = ['British Summer Time'];
        $quick_opt['AUS'] = ['Australian Eastern Standard Time','Norfolk Island Time','Australian Central Standard Time','Australian Western Standard Time','Christmas Island Time'];

        $arr['quick_options'] = [];
        $arr['other'] = [];

        foreach($timezone_list as $key => $val){
            if(in_array($val->name, $quick_opt['US'])){
                $arr['quick_options']['US'][] = $val;
            }else if(in_array($val->name, $quick_opt['CAN'])){
                $arr['quick_options']['CAN'][] = $val;
            }else if(in_array($val->name, $quick_opt['UK'])){
                $arr['quick_options']['UK'][] = $val;
            }else if(in_array($val->name, $quick_opt['AUS'])){
                $arr['quick_options']['AUS'][] = $val;
            }else{
                $arr['other'][] = $val;
            }
        }
        return json_encode($arr);
    }

    public function getTimeZoneDate($offset,$timezone,$date,$format){
        $timezones =
            array (
                '10.30' => 'Australia/Lord_Howe',
                '11.30' => 'Pacific/Norfolk',
                '12.45' => 'Pacific/Chatham',
                '14.00' => 'Pacific/Kiritimati',
                '-12.00' => 'Pacific/Wake',
                '-11.00' => 'Pacific/Apia',
                '-11.00' => 'Pacific/Apia',
                '-10.00' => 'Pacific/Honolulu',
                '-9.00' => 'America/Anchorage',
                '-9.30' => 'Pacific/Marquesas',
                '-8.00' => 'America/Los_Angeles', // conf
                '8.45' => 'Australia/Eucla',
                '-7.00' => 'America/Phoenix',
                '-6.00' => 'America/Managua',
                '-6.00' => 'America/Chicago',
                '-6.00' => 'America/Mexico_City',
                '-6.00' => 'America/Mexico_City',
                '-6.00' => 'America/Mexico_City',
                '-6.00' => 'America/Regina',
                '-5.00' => 'America/Bogota',
                '-5.00' => 'America/New_York',
                '-5.00' => 'America/Indiana/Indianapolis',
                '-5.00' => 'America/Bogota',
                '-5.00' => 'America/Bogota',
                '-4.00' => 'America/Halifax',
                '-4.30' => 'America/Caracas',
                '-4.00' => 'America/Santiago',
                '-3.30' => 'America/St_Johns',
                '-3.00' => 'America/Sao_Paulo',
                '-3.00' => 'America/Argentina/Buenos_Aires',
                '-3.00' => 'America/Argentina/Buenos_Aires',
                '-2.00' => 'America/Noronha',
                '-1.00' => 'Atlantic/Azores',
                '-1.00' => 'Atlantic/Cape_Verde',
                '0.00' => 'Europe/London',
                '1.00' => 'Europe/Berlin',
                '1.00' => 'Europe/Belgrade',
                '1.00' => 'Europe/Berlin',
                '1.00' => 'Europe/Berlin',
                '1.00' => 'Europe/Belgrade',
                '1.00' => 'Europe/Paris',
                '1.00' => 'Europe/Belgrade',
                '1.00' => 'Europe/Paris',
                '1.00' => 'Europe/Belgrade',
                '1.00' => 'Europe/Paris',
                '1.00' => 'Europe/Paris',
                '1.00' => 'Europe/Belgrade',
                '1.00' => 'Europe/Berlin',
                '1.00' => 'Europe/Sarajevo',
                '1.00' => 'Europe/Sarajevo',
                '1.00' => 'Europe/Berlin',
                '1.00' => 'Europe/Berlin',
                '1.00' => 'Europe/Sarajevo',
                '1.00' => 'Africa/Lagos',
                '2.00' => 'Europe/Istanbul',
                '2.00' => 'Europe/Bucharest',
                '2.00' => 'Africa/Cairo',
                '2.00' => 'Africa/Johannesburg',
                '2.00' => 'Europe/Helsinki',
                '2.00' => 'Europe/Istanbul',
                '2.00' => 'Asia/Jerusalem',
                '2.00' => 'Europe/Helsinki',
                '2.00' => 'Europe/Istanbul',
                '2.00' => 'Africa/Johannesburg',
                '3.00' => 'Asia/Baghdad',
                '3.00' => 'Asia/Riyadh',
                '3.00' => 'Europe/Moscow',
                '3.00' => 'Africa/Nairobi',
                '3.00' => 'Asia/Riyadh',
                '3.00' => 'Europe/Moscow',
                '3.00' => 'Europe/Moscow',
                '3.30' => 'Asia/Tehran', // Conf
                '4.00' => 'Asia/Muscat',
                '4.00' => 'Asia/Tbilisi',
                '4.00' => 'Asia/Muscat',
                '4.00' => 'Asia/Tbilisi',
                '4.00' => 'Asia/Tbilisi',
                '4.30' => 'Asia/Kabul',
                '5.00' => 'Asia/Yekaterinburg',
                '5.00' => 'Asia/Karachi',
                '5.00' => 'Asia/Karachi',
                '5.00' => 'Asia/Karachi',
                '5.30' => 'Asia/Kolkata',
                '5.30' => 'Asia/Kolkata',
                '5.30' => 'Asia/Kolkata',
                '5.30' => 'Asia/Kolkata',
                '5.45' => 'Asia/Kathmandu',
                '6.00' => 'Asia/Dhaka',
                '6.00' => 'Asia/Dhaka',
                '6.30' => 'Asia/Rangoon',
                '7.00' => 'Asia/Bangkok',
                '7.00' => 'Asia/Bangkok',
                '7.00' => 'Asia/Bangkok',
                '7.00' => 'Asia/Krasnoyarsk',
                '8.00' => 'Asia/Hong_Kong',
                '8.00' => 'Asia/Hong_Kong',
                '8.00' => 'Asia/Hong_Kong',
                '8.00' => 'Asia/Irkutsk',
                '8.00' => 'Asia/Singapore',
                '8.00' => 'Australia/Perth',
                '8.00' => 'Asia/Singapore',
                '8.00' => 'Asia/Taipei',
                '8.00' => 'Asia/Irkutsk',
                '8.00' => 'Asia/Hong_Kong',
                '9.00' => 'Asia/Tokyo',
                '9.00' => 'Asia/Tokyo',
                '9.00' => 'Asia/Seoul',
                '9.00' => 'Asia/Tokyo',
                '9.00' => 'Asia/Yakutsk',
                '9.30' => 'Australia/Adelaide',
                '9.30' => 'Australia/Darwin',
                '10.00' => 'Australia/Brisbane',
                '10.00' => 'Australia/Sydney',
                '10.00' => 'Pacific/Guam',
                '10.00' => 'Australia/Hobart',
                '10.00' => 'Australia/Sydney',
                '10.00' => 'Pacific/Guam',
                '10.00' => 'Australia/Sydney',
                '10.00' => 'Asia/Vladivostok',
                '11.00' => 'Asia/Magadan',
                '11.00' => 'Asia/Magadan',
                '11.00' => 'Asia/Magadan',
                '12.00' => 'Pacific/Auckland',
                '12.00' => 'Pacific/Fiji',
                '12.00' => 'Pacific/Fiji',
                '12.00' => 'Pacific/Fiji',
                '12.00' => 'Pacific/Auckland',
                '13.00' => 'Pacific/Tongatapu',
            );

        $tz = $timezones[$offset];
        date_default_timezone_set($tz);

        $date = new DateTime($date,new DateTimeZone($timezone));
        $date->setTimezone( new DateTimeZone($tz) );
        return $date->format($format);
    }

    public function convertLocalDateToUTC($zoneOffset,$date,$format){
        try {
            $offset = $zoneOffset * 60 * 60;
            $converted_date = date($format, strtotime($date)- $offset);
        }catch (\Exception $e) {
            $converted_date = 'Error';
        }
        return $converted_date;
    }

    public function getTimeZoneName($offset,$timezone,$date,$format,$extract=':'){
        // $offset = '?04.00';
        // $extract = '.';
        // Calculate seconds from offset
        list($hours, $minutes) = explode($extract, $offset);

        $seconds = $hours * 60 * 60 + $minutes * 60;
        // Get timezone name from seconds

        $tz = timezone_name_from_abbr('', $seconds, 1);
        // Workaround for bug #44780

        if($tz === false) $tz = timezone_name_from_abbr('', $seconds, 0);
        // Set timezone
        //dd($seconds,$hours, $minutes,$tz);
        //echo $tz;
        date_default_timezone_set($tz);
        //echo date_default_timezone_get().'<br>';
        $date = new DateTime($date,new DateTimeZone($timezone));
        $date->setTimezone( new DateTimeZone($tz) );
        return $date->format($format);
    }

    public static function diffInDays($date1, $date2){
        //$datetime = new DateTime();
        $datetime1 = new DateTime($date1);

        $datetime2 = new DateTime($date2);
        $diff = $datetime2->diff($datetime1);
        //dd($diff);
        //$diff = $datetime2->diff($datetime1);
        //dd($diff);
        if($diff->invert == 1)
            return -$diff->days;
        else
            return $diff->days;
    }

    public function encryptToken($key){
        return \Crypt::encrypt($key);
    }

    public function decryptToken($key){
        return \Crypt::decrypt($key);
    }

}
