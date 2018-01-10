<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organisation;
use App\Report;
use DB;
use Session;

class OrganisationController extends Controller
{
    public function index(){
        return view('organisation', ['name' => $this->getUserName()]);
    }
    
    public function organisation_form(){
        if(!$this->check_permission()){
            session::flash('message', "Session expired, login required");
            return redirect()->action('HomeController@index');
        }
        $title = "Organisation";
        $organisation = DB::table('organisation')
        ->where('id', '!=', 1)
        ->orderBy('id', 'desc')
        ->paginate(10);
        $all_organisations = DB::table('organisation')
        ->where('id', '!=', 1)
        ->get();
        return view('organisation', [
                   'name' =>$this->getUserName(),
                    'title' => $title,
                    'organisation' => $organisation,
                    'all_organisation' => $all_organisations
             ]);
    }
    
    public function batchadd_organisation(Request $request){
        if(!$this->check_permission()){
            session::flash('message', "Session expired, login required");
            return redirect()->action('HomeController@index');
        }
        // dump($request, !isset($request->name));die;
        if (!isset($request->name) && !isset($request->orgType)) {
            session::flash('message', "please select organisation upload!");
            redirect()->action('DatauploadController@Index');
        }
        $data=[];
        foreach($request->name as $k=>$v){
            $data[$k]['name']=$v;
            $data[$k]['orgType']=$request->orgType[$k];
            $data[$k]['interestSectorAreas']=$request->interestSectorAreas[$k];
            $data[$k]['twitter']=$request->twitter[$k];
            $data[$k]['schoolLowerAge']=$request->schoolLowerAge[$k];
            $data[$k]['schoolHigherAge']=$request->schoolHigherAge[$k];
            $data[$k]['schoolURN']=$request->schoolURN[$k];
            $data[$k]['notes']=$request->notes[$k];
            $data[$k]['postcode']=empty($request->postcode[$k])?0:0;
            $data[$k]['region']=empty($request->region[$k])?'':'';
            $data[$k]['country']=empty($request->country[$k])?'':'';
            $data[$k]['created_at']=date('Y-m-d H:i:s');
            $data[$k]['updated_at']=date('Y-m-d H:i:s');
        }
        DB::table('organisation')->insert($data);
        $report = new Report;
        $report->add_report($report, 1, 0, 0, $this->getMid());
        session::flash('message', "Organisation import successfully");
        return redirect()->action('DatauploadController@Index');
    }
    
    public function add_organisation(Request $request){
        if(!$this->check_permission()){
            session::flash('message', "Session expired, login required");
            return redirect()->action('HomeController@index');
        }
        $organisation = new Organisation;
        $organisation->name = trim($request->name);
        $organisation->orgType = trim($request->orgType);
        $organisation->interestSectorAreas = trim($request->interestSectorAreas);
        $organisation->twitter = trim($request->twitter);
        $organisation->schoolLowerAge = trim($request->schoolLowerAge);
        $organisation->schoolHigherAge = trim($request->schoolHigherAge);
        $organisation->schoolURN = trim($request->schoolURN);
        $organisation->notes = trim($request->notes);
        $organisation->postcode = trim($request->postcode);
        $organisation->region = trim($request->region);
        $organisation->country = trim($request->country);
        $organisation->save();
        $report = new Report;
        $report->add_report($report, 1, 0, 0, $this->getMid());
        session::flash('message', "Organisation added successfully");
        return redirect()->action('OrganisationController@organisation_form');
    }
       
    
    public function edit_organisation(Request $request){
        if(!$this->check_permission()){
            session::flash('message', "Permission denied or session expired");
            return redirect()->action('HomeController@index');
        }
        $id=$request->get('id');
        $fieldStr=$request->get('fieldStr');
        $org = DB::table('organisation')->where('id', $id)->first();
        // echo "<pre>";
        // var_dump($id, $org);die;
        if (empty($org)) {
            session::flash('message','do not exist the organisation id!');
            return redirect()->action('SearchController@search',['fieldStr'=>$fieldStr]);
        }
        return view('edit_org', [
            'fieldStr' => $fieldStr,
            'table' =>'organisation',
            'org' => $org,
            'name' => $this->getUserName()
        ]);
    }
   
    
    public function update_organisation(Request $request){
        if(!$this->check_permission()){
            session::flash('message', "Permission denied or session expired");
            return redirect()->action('HomeController@index');
        }
        $organisation = new Organisation;
        $id = trim($request->id);
        $data['name'] = trim($request->name);
        $data['orgType']  = trim($request->orgType);
        $data['schoolLowerAge']  = trim($request->schoolLowerAge);
        $data['schoolHigherAge']  = trim($request->schoolHigherAge);
        $data['schoolURN']  = trim($request->schoolURN);
        $data['country']  = trim($request->country);
        $data['region']  = trim($request->region);
        $res=$organisation->where("id", $id)->update($data);
        if ($res) {
            $report = new Report;
            $report->add_report($report, 0, 1, 0, $this->getMid());
        }
        $fieldStr = $request->input('fieldStr');  
        return redirect()->action('SearchController@search',['fieldStr'=>$fieldStr]);
    }

    public function delete_organisation(Request $request){
        if(!$this->check_permission()){
            session::flash('message', "Permission denied or session expired");
            return redirect()->action('HomeController@index');
        }
        $id=$request->get('id');
        $fieldStr=$request->get('fieldStr');
        $res = DB::delete('delete from organisation where id = ?',[$id]);
         if ($res) {
            $report = new Report;
            $report->add_report($report, 0, 0, 1, $this->getMid());
        }
        return redirect()->action('SearchController@search',['fieldStr'=>$fieldStr]);
    }

    public function match_org_name(Request $request) {
        $name = trim($request->get('name'));
        $res = DB::table('organisation')
        ->where('name', 'like', '%'.$name.'%')
        ->get();
        // var_dump($res,$name);die;
        $data = [];
        $data['data']=$res;
        if (!empty($res)) {
           $data['code']=0;
        } else {
            $data['code']=-1;
        }
        echo json_encode($data);
    }
    
}
