<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Organisation;
use Session;
use App\Report;
use DB;
    
class ContactController extends Controller
{
    public function match_org_name() {
        $org = new Organisation;
        $res = $org->view_name();
        $names = [];
        if (!empty($res)) {
            foreach ($res as $k=>$v) {
                $names[$k] = $v->name;
            }
        }
        return $names;
    }
    public  function Index(){
        return view('dataentry', [
               'name' => $this->getUserName(),
               'list_org_name' => $this->match_org_name()               
            ]);
    }

    public  function  data_search(){
        return view('datasearch',['name' => $this->getUserName()]);
    }
   
    public function batchadd_contact(Request $request){
        if(!$this->check_permission()){
            session::flash('message', "Session expired, login required");
            return redirect()->action('HomeController@index');
        }
        $data=[];
        foreach($request->recordType as $k=>$v){
            $data[$k]['recordType']=$v;
            $data[$k]['recordStatus']=$request->recordStatus[$k];
            $data[$k]['instruction']=$request->instruction[$k];
            $data[$k]['fname']=$request->fname[$k];
            $data[$k]['lname']=$request->lname[$k];
            $data[$k]['title']=$request->title[$k];
            $data[$k]['jobtitle']=$request->jobtitle[$k];

            $data[$k]['email']=$request->email[$k];
            $data[$k]['telephone']=$request->telephone[$k];
            $data[$k]['telephone2']=$request->telephone2[$k];
            $data[$k]['mobile']=$request->mobile[$k];
            $data[$k]['personType']=$request->personType[$k];
            $data[$k]['organisation']=$request->organisation[$k];
            $data[$k]['departmentLevel1']=$request->departmentLevel1[$k];
            $data[$k]['linkedln']=$request->linkedln[$k];
            $data[$k]['professionalInterest']=$request->professionalInterest[$k];
            $data[$k]['biographyText']=$request->biographyText[$k];

            $data[$k]['notes']=$request->notes[$k];
            $data[$k]['postcode']=empty($request->postcode[$k])?0:0;
            $data[$k]['region']=empty($request->region[$k])?'':'';
            $data[$k]['country']=empty($request->country[$k])?'':'';
            $data[$k]['created_at']=date('Y-m-d H:i:s');
            $data[$k]['updated_at']=date('Y-m-d H:i:s');
            $data[$k]['entry_time']=date('Y-m-d H:i:s');
            
        }
        // dump($data);die;
        DB::table('contact')->insert($data);
        session::flash('message', "Contact import successfully");
        $report = new Report;
        $report->add_report($report, 1, 0, 0, $this->getMid());
        return redirect()->action('DatauploadController@Index');
    }

    public function add_contact(Request $request){
        if(!$this->check_permission()){
            session::flash('message', error_message("Session expired, login required"));
            return redirect()->action('HomeController@index');
        }
        $contact = new Contact;
        $contact->recordType = trim($request->recordType);
        $contact->recordStatus = trim($request->recordStatus);
        $contact->instruction = trim($request->instruction);
        $contact->fname = trim($request->fname);
        $contact->lname = trim($request->lname);
        $contact->title = trim($request->title);
        $contact->jobtitle = trim($request->jobtitle);
        $contact->email = trim($request->email);
        $contact->telephone = trim($request->telephone);
        $contact->telephone2 = trim($request->telephone2);
        $contact->mobile = trim($request->mobile);
        $contact->personType = trim($request->personType);
        $contact->organisation = trim($request->organisation);
        $contact->departmentLevel1 = trim($request->departmentLevel1);
        // $contact->departmentLevel2 = trim($request->departmentLevel2);
        $contact->postcode = trim($request->postcode);
        $contact->region = trim($request->region);
        $contact->country = trim($request->country);
        $contact->linkedln = trim($request->linkedIn);
        $contact->professionalInterest = trim($request->professionalInterest);
        $contact->biographyText = trim($request->biographyText);
        $contact->notes = trim($request->notes);
        $contact->entry_time = date('Y-m-d H:i:s');
        $contact->save();
        session::flash('message', "Contact added successfully");
        $report = new Report;
        $report->add_report($report, 0, 1, 0, $this->getMid());
        return redirect()->action('ContactController@Index');
    }
    
    
    public function edit_contact(Request $request){
        if(!$this->check_permission()){
            session::flash('message', "Permission denied or session expired");
            return redirect()->action('HomeController@index');
        }
        $id=$request->get('id');
        $fieldStr=$request->get('fieldStr');
        $con = DB::table('contact')->where('id', $id)->first();
        // echo "<pre>";
        // var_dump($id, $org);die;
        if (empty($con)) {
            session::flash('message','do not exist the contact id!');
            return redirect()->action('SearchController@search', ['fieldStr'=>$fieldStr]);
        }
        return view('edit_contact', [
            'fieldStr' => $fieldStr,
            'table' =>'contact',
            'con' => $con,
            'name' => $this->getUserName()
        ]);
    }
    
    public function update_contact(Request $request){
        if(!$this->check_permission()){
            session::flash('message', "Permission denied or session expired");
            return redirect()->action('HomeController@index');
        }
        $contact = new Contact;
        $id = trim($request->id);
        $data['instruction'] = trim($request->instruction);
        $data['title']  = trim($request->title);
        $data['fname']  = trim($request->fname);
        $data['lname']  = trim($request->lname);
        $data['jobtitle']  = trim($request->jobtitle);
        $data['email']  = trim($request->email);
        $data['organisation']  = trim($request->organisation);
        $data['departmentLevel1']  = trim($request->departmentLevel1);
        $data['dapartmentLevel2']  = trim($request->dapartmentLevel2);
        $res=$contact->where("id", $id)->update($data);
        if ($res) {
            $report = new Report;
            $report->add_report($report, 0, 1, 0, $this->getMid());
        }
        $fieldStr = $request->input('fieldStr');  
        return redirect()->action('SearchController@search', ['fieldStr'=>$fieldStr]);
    }

    public function delete_contact(Request $request){
        if(!$this->check_permission()){
            session::flash('message', "Permission denied or session expired");
            return redirect()->action('HomeController@index');
        }
        $id=$request->get('id');
        $fieldStr=$request->get('fieldStr');
        $res = DB::delete('delete from contact where id = ?',[$id]);
         if ($res) {
            $report = new Report;
            $report->add_report($report, 0, 0, 1, $this->getMid());
        }
        return redirect()->action('SearchController@search', ['fieldStr'=>$fieldStr]);
    }

}
