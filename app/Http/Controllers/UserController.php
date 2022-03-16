<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
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

        //die;
        $arr_user =  User::where('id',Auth::user()->id)->get();
        $is_admin_access = 0;
        if(count($arr_user) > 0){
            $is_admin_access = $arr_user[0]->access_type;
        }


        if($is_admin_access==0){
            return redirect('dashboard');
        }else{

            $managers =  User::where('is_deleted', 0)->where('created_user_id', Auth::User()->id)->get();


            return view('user', ['ActiveMenu' => 'User', 'users' => $managers]);
        }
    }




    public function listUser(Request $request)
    {
        $Results = User::select('id', 'name', 'email','access_type', 'status', 'created_at')->where('category', 'User')->where('org_id',Auth::User()->org_id)->where('id','<>',Auth::User()->id)->where('is_deleted', 0)->get();//->where('created_user_id', Auth::User()->id)

        foreach($Results as $result)
        {
            $result->action = '<a href="#" title="Edit" class="btn btn-info btn-sm editUser" style="margin-top: 5px;" data-id="'.$result->id.'"><i class="fa fa-edit"></i></a> <a href="#" title="Delete" class="btn btn-danger btn-sm deleteUser" style="margin-top: 5px;" data-id="'.$result->id.'"><i class="fa fa-trash"></i></a>';

            if($result->access_type == 1)
            {
                $result->access_type = 'Admin';
            }else{
                $result->access_type = 'User';
            }
        }

        return Datatables::of($Results)->make(true);
    }

    public function addUser(Request $request)
    {

        //print_r($request->all());
    //	die();
        $rule = ['name' => 'required|max:255', 'email' => 'required|unique:users|email|max:255'];

        $token = base64_encode(random_bytes(32));
        $token = strtr($token, '+/==', 'Acsd');

        $request->validate($rule);

        $email = $request->email;

        User::insert(['name' => $request->name, 'email' => $request->email, 'category' => "User", 'password' => '', 'created_user_id' => Auth::User()->id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),'verify_token'=>$token,'access_type'=>$request->accesstype,'org_id' => Auth::User()->org_id]);//\Hash::make($request->password)


        $url = URL::to('/').'/setpassword/'.$token;

        $link = '<br/><br/><b>Hi '.$request->name.',</b><br/><br/>You have been invited to join the '.env('APP_NAME').' user portal. You are just one step away to access the portal. Please click the button given below to create your account password.<br/><br/><a style="font-weight: bold;float: none;font-family: Arial,Helvetica,sans-serif;display: inline-block;color: #fff;line-height: 1;padding: 0.5em 1em;background: #3d85c6;border: 1px solid #1777b7;border-radius: 3px;margin: 25px 0 5px 0;text-decoration: none;font-size: 130%;" href="'.$url.'">Create Password</a> <br/><br/><br/>Thank You,<br/><b>Team '.env('APP_NAME').'</b>';


        $subject = 'YOU HAVE BEEN INVITED TO JOIN THE '.strtoupper(env('APP_NAME')).' USER PORTAL';
        $content = $link;
        app('App\Http\Controllers\CommonController')->MailToUsers($email,$subject,$content);



    }

    public function deleteUser(Request $request)
    {

            $user = User::where('id', $request->id)->where('category', 'User')->where('is_deleted', 0)->first();

            User::where('id', $request->id)->where('category', 'User')->where('is_deleted', 0)
            ->update(['email' => $user->email."(".date('YmdHis').")", 'updated_at' => date('Y-m-d H:i:s'), 'is_deleted' => 1]);



    }

    public function editUser(Request $request)
    {
        $result = User::where('id', $request->id)->first();

        return Response::json($result);
    }

    public function editProfile(Request $request)
    {
        $result = User::where('id', Auth::User()->id)->first();

        return Response::json($result);
    }

    public function updateProfile(Request $request)
    {

        User::where('id', Auth::User()->id)->update(['name' => $request->profile_name, 'email' => $request->profile_email, 'updated_at' => date('Y-m-d H:i:s')]);
    }


    public function updatePassword(Request $request)
    {
        User::where('id', Auth::User()->id)->update(['password' => Hash::make($request->p_password), 'updated_at' => date('Y-m-d H:i:s')]);
    }


    public function updateUser(Request $request)
    {
        $user = User::where('id', $request->user_id)->where('category', 'User')->where('is_deleted', 0)->first();

        $rule = ['name' => 'required|max:255', 'email' => 'required|unique:users,email,'.$user->id.'|email|max:255'];

        $request->validate($rule);

        User::where('id', $request->user_id)->where('category', 'User')->where('is_deleted', 0)
        ->update(['name' => $request->name, 'email' => $request->email, 'updated_at' => date('Y-m-d H:i:s'),'access_type'=>$request->accesstype]);
    }
}
