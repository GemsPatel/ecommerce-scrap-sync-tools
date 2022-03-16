<?php
	namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

	class CommonController extends Controller
	{

		public function getDateTime(){
			$time = date('Y-m-d H:i:s');
			return $time;
		}

		public function CronSendListOfErrorViaMail($org_id){//$org_id

			//$org_id = 1;

			$filename_list = "Failed_Report_".$org_id.".csv";

			// For Product
			$errors_list = array();

			$list = array();
			$list[] = "S.NO.";
			$list[] = "SKU";
			$list[] = "Product Name";
			$list[] = "Sync Date Time";
			$list[] = "Sync Status";
			$list[] = "Failed Reason";
			$errors_list[] = $list;

			$arrlog = DB::table('sync_log')->where('org_id',$org_id)->where('flag_notification',0)->where('sync_status','Failed')->orderBy('sync_date_time','asc')->get();

			$no = 1;
			$is_send = 0;
			if(count($arrlog) > 0){
				$is_send = 1;
				foreach($arrlog as $row){

					$list = array();
					$list[] = $no;
					$list[] = date('m/d/Y h:i A',strtotime($row->sync_date_time));
					$list[] = $row->sync_category;
					$list[] = $row->additional_details;
					$list[] = $row->operation_type;
					$list[] = $row->reason;
					$errors_list[] = $list;

					DB::table('sync_log')->where('sync_id',$row->sync_id)->where('org_id',$org_id)->update(['flag'=>1]);

					$no++;
				}

				$file = fopen('public/errorfiles/'.$filename_list,"w");

				foreach ($errors_list as $line) {
				  fputcsv($file, $line);
				}

				fclose($file);

			}



			$arr_emails = DB::table('email_settings')->where('org_id',$org_id)->get();
			$emails = "";

			if(count($arr_emails) > 0 && $is_send==1){

				$emails = explode(',',$arr_emails[0]->emails);
				foreach($emails as $emailid){
					if($emailid!=""){
						$notification_email = trim($emailid);

						try{
							Mail::raw("See Below Attached CSV Files For Error Report", function($message) use($filename_list,$notification_email,$is_send){
							$message->to(explode(',', preg_replace('/\s+/', '', trim($notification_email))));
								if($is_send==1){
									$message->attach(base_path('public/errorfiles/'.$filename_list));
								}
								$message->subject("Failed Report");
							});
						}catch(\Exception $e) {
							echo 'Message: ' .$e->getMessage();
						}
					}
				}
			}





		}

		public function MailToUsers($email,$subject,$content){ // it is calling from 2-3 places like user add,forgot password
			$data = array();
			$data['content'] = $content;

			try{

				Mail::send('emails.message', $data, function ($message) use ($subject,$email) {
					$message->subject($subject);
					$message->to($email);
				});

			}catch(\Exception $e) {
				echo 'Message: ' .$e->getMessage();
			}

		}

		public function MailToDevelopmentTeam($content,$subject,$email){ // Sending mail when we didn't get any order from last 1 hour
			//$email = ["bhoopendra.constacloud@gmail.com","manpreet@apiworx.com"];

			//$email = "bhoopendra.constacloud@gmail.com";
			//$subject = "K2Awards Order Failed";
			$data = array();
			$data['content'] = $content;

			try{

				Mail::send('emails.message', $data, function ($message) use ($subject,$email) {
					$message->subject($subject);
					$message->to($email);
				});

			}catch(\Exception $e) {
				echo 'Message: ' .$e->getMessage();
			}

		}

		public function sync_process_logs($sync_type,$sync_status,$response,$record_id='0',$organization_id=null)
		{

			if(!$organization_id ){

			}

			$fields = array(
							'sync_type' => $sync_type,
							'sync_status' => $sync_status,
							'response' => $response,
							'record_id' => $record_id,
							'organization_id' => $organization_id
						);

			$found = DB::table('sync_process_logs')
			->where(['organization_id'=>$organization_id, 'record_id'=>$record_id, 'sync_type' =>$sync_type])
			->orderBy('id', 'DESC')->first();

			if($found){
				DB::table('sync_process_logs')->where(['id'=>$found->id])
				->update(['sync_status' => $sync_status,'timeStamp'=>time(),'response' => $response]);
			}else{
				$fields['timeStamp'] = time();
				DB::table('sync_process_logs')->insert($fields);
			}

		}

		public static function getMappedField($for,$orgid,$field_name,$platform)
		{
			$dataq = DB::connection()->table('mapping_ls_bp As M')->join('sf_bp_fields As sff', 'M.sf_id', '=', 'sff.id')
			->join('sf_bp_fields As bpf', 'M.bp_id', '=', 'bpf.id')
			->where(['M.mapping_type'=>$for,'M.status'=>1,'M.organization_id'=>$orgid]);
			if($platform=='shopify'){
				$dataq->where('ssf.name',$field_name)->select('bpf.*');
			}elseif($platform=='brightpearl'){
				$dataq->where('bpf.name',$field_name)->select('lsf.*');
			}

			$data = $dataq->first();
			if($data && $data->db_field_name){
				return [$data->db_field_name,$data->field_type,$data->customFieldType];
			}else if($data)
			{
				return [$data->name,$data->field_type,$data->customFieldType];
			} else {
				return [0,0,0];
			}
		}
	}
