<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Session;
use App\Report;

class UserController extends Controller
{
    public function pre_add_user(){
        return view("adduser",[
               'name' =>$this->getUserName()
        ]);
    }
    
    public function admin_user(){
        if(!$this->check_permission()){
            session::flash('message',"Permission denied or session expired");
            return redirect()->action('HomeController@index');
        }
        $users = DB::table('user')
              ->orderBy('id','desc')
              ->paginate(10);
        return view('adminuser', [
                'users' => $users,
                'name' => $this->getUserName()
        ]);
    }
    
    public function add_user(Request $request){
        if(!$this->check_permission()){
            session::flash('message', "Permission denied or session expired");
            return redirect()->action('HomeController@index');
        }
        $user = new User;
        $id = trim($request->id);
        $user->fname = trim($request->fname);
        $user->lname = trim($request->lname);
        $user->email = trim($request->email);
        $user->password = sha1(trim($request->password));
        $user->type = trim($request->userlevel);
        if (trim($request->active)=='on'){
            $user->active = 1;
        }else{
            $user->active = 0;
        }
        $user->entry_time = date('Y-m-d H:i:s');
        switch ($user->type) {
            case 0:
                $user->role_id=0;
                break;
            case 1:
                $user->role_id=1;
                break;
            case 2:
                $user->role_id=2;
                break;
            default:
                break;
        }
        // echo "<pre>";
        // print_r($user);
        $user->save();
        $report = new Report;
        $report->add_report($report, 1, 0, 0, $this->getMid());
        return redirect()->action('UserController@admin_user');

    }
    
    public function view_user($id){
        if(!$this->check_permission()){
            session::flash('message', "Permission denied or session expired");
            return redirect()->action('HomeController@index');
        }
        return view('useredit', [
                    'name' => $this->getUserName(),
                    'user' => $this->getUser()
        ]);
    }

    public function update_user(Request $request){
        if(!$this->check_permission()){
            session::flash('message', "Permission denied or session expired");
            return redirect()->action('HomeController@index');
        }
        $user = new User;
        $id = trim($request->id);
        $data['fname'] = trim($request->fname);
        $data['lname'] = trim($request->lname);
        $data['email'] = trim($request->email);
        $data['password'] = sha1(trim($request->password));
        $data['type'] = intval(trim($request->type));
        if (trim($request->active)=='on'){
            $data['active'] = 1;
        }else{
            $data['active'] = 0;
        }
        $data['entry_time'] = date('Y-m-d H:i:s');
        switch ($user->type) {
            case 0:
                $data['role_id']=0;
                break;
            case 1:
                $data['role_id']=1;
                break;
            case 2:
                $data['role_id']=2;
                break;
            default:
                break;
        }
        $res=$user->where("id", $id)->update($data);
        // var_dump($res);
        if ($res) {
            $report = new Report;
            $report->add_report($report, 0, 1, 0, $this->getMid());
        }
        return redirect()->action('UserController@admin_user');
    }
    
    
    public function delete_user(Request $request){
        if(!$this->check_permission()){
            session::flash('message', "Permission denied or session expired");
            return redirect()->action('HomeController@index');
        }
        $id=$request->get('id');
        $user = DB::table('user')->where('id', $id)->first();
        $loginUser = $this->getUser();
        if ($loginUser->type <= $user->type){
            session::flash('message', "Same level user can not be delete!");
            return redirect()->action('UserController@admin_user');
        }
        $res = DB::delete('delete from user where id = ?',[$id]);
        if ($res) {
            $report = new Report;
            $report->add_report($report, 0, 0, 1, $this->getMid());
        }
        return redirect()->action('UserController@admin_user');
    }

    public function edit_user(Request $request){
        if(!$this->check_permission()){
            session::flash('message', "Permission denied or session expired");
            return redirect()->action('HomeController@index');
        }
        $id=$request->get('id');
        $user = DB::table('user')->where('id', $id)->first();
        $loginUser = $this->getUser();
        if ($loginUser->type <= $user->type){
            session::flash('message', "Same level user can not be edit!");
            return redirect()->action('UserController@admin_user');
        }
        return view('useredit', [
            'user' => $user,
            'name' =>$this->getUserName()
        ]);
    }
    
    public  function  admin_search(){
        return view('admin_search', ['name' => $this->getUserName()]);
    }

}
