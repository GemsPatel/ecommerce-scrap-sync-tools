<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

	class SetPasswordController extends Controller
	{

		/**
			* @return \Illuminate\Contracts\Support\Renderable
		*/
		public function setPassword(Request $request)
		{
				//$token = $request->segment(1);

				$token = $request->segment(2);

				$arr_users = DB::table('users')->where('verify_token',$token)->where('is_verified',0)->get();

				if(count($arr_users) > 0){

					return view('auth.passwords.create_password',compact('arr_users'));
				}else{
					return redirect('login');
				}

		}

		public function saveNewPassword(Request $request)
		{
			$rule = [ 'email' => 'required', 'password' => 'required|min:8|max:25', 'confirm_password' => 'required|same:password|min:8|max:25'];

			$request->validate($rule);

			$arruser = DB::table('users')->where('verify_token',$request->HdToken)->where('is_verified',0)->get();

			if(count($arruser) > 0){

				DB::table('users')->where('verify_token',$request->HdToken)->where('is_verified',0)->update(['password' => Hash::make($request->password), 'updated_at' => date('Y-m-d H:i:s'), 'verify_token' => '','is_verified' => 1]);

				//Session::flash('success_msg', "Password created successfully. You can login now.");
				//return redirect('login');
				 Auth::loginUsingId($arruser[0]->id);

				return redirect('dashboard');

			}else{

				Session::flash('error_msg', "Some error occurred. Please try again. ");
				return redirect()->back();

			}

		}

	}
