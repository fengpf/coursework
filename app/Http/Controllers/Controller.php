<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Session;
use App\Address;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function PostCodeLookup(Request $request){
        // $postCode = 'SE21 8JL';
        $postcode = trim($request->postcode);
        $res=[];
        $addr= new Address;
        $address = $addr->view_address($postcode);
        if ($address) {
            $res['country']=$address->country;
            $res['region']=$address->region;
            $res['from'] = 'db';
        } else {
            $data = \Postcode::postcodeLookup($postcode);
            if ($data->status==200){
                $country = $data->result->country;
                $region = $data->result->region;
                $res['country'] = $country;
                $res['region'] = $region;
                $res['from'] = 'postcodes.io';
                $addr->add_address($addr, $postcode, $region, $country);
            } else {
                return json_encode($data);
            }
        }
//         echo "<pre>";
//         print_r($res);
        // die;
        echo json_encode($res);      
    }

    public function getMid() {
        $mid = 0;
        if (session::get('user_id')){
            $mid = session::get('user_id')[0];
        } elseif(session::get('superadmin_id')){
            $mid = session::get('superadmin_id')[0];
        } elseif(session::get('admin_id')){
            $mid = session::get('admin_id')[0];
        }
        if ($mid==0) {
            return redirect()->action('HomeController@index');
        }
        return $mid;
    }

    public function getUserName(){
        $user = $this->getUser();
        if (empty($user)) {
            return redirect()->action('HomeController@index');
        }
        $name = $user->fname.' '.$user->lname;
        return $name;
    }

    public function getUser(){
        $user = DB::table('user')
        ->where('id', $this->getMid())
        ->first();
        return $user;
    }

    public function check_permission() {
        $superadmin = Session::get('superadmin_login');
        $admin = session::get('admin_login');
        $user = session::get('user_login');
        if($superadmin == true || $admin == true || $user == true){
            if($user == true){
                $user_id = session::get('user_id');
                $perm = DB::table('user')
                ->where('id', $user_id)
                ->first();
                $permission = $perm->active;
                if($permission == 1){
                    return true;
                } else {
                    return false;
                }
            }
            if($admin == true){
                return true;
            }
            if($superadmin == true){
                return true;
            }
        } else {
            return false;
        }
    }
}
