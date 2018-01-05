<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
    
    
class SearchController extends Controller
{

    private function setInput($var){
        if(isset($var) && !empty($var)){
            return $var;
        } else {
            return false;
        }
    }

    public function search(Request $request){
        $recordType = $this->setInput($request->get('recordType'));
        $entry_recordtype = $this->setInput($request->get('entry_recordtype'));
        $noentry_recordtype = $this->setInput($request->get('noentry_recordtype'));
        $con_recordtype = $this->setInput($request->get('con_recordtype'));
        

        // $instruction = $this->setInput($request->get('instruction'));
        // $recordStatus = $this->setInput($request->get('recordStatus'));
        // $jobtitle = $this->setInput($request->get('jobtitle'));
        // $personType = $this->setInput($request->get('personType'));
        // $professionalInterest = $this->setInput($request->get('professionalInterest'));
        // $organisation = $this->setInput($request->get('organisation'));
        // $departmentLevel1 = $this->setInput($request->get('departmentLevel1'));
        // $departmentLevel2 = $this->setInput($request->get('departmentLevel2'));
        // $orgType = $this->setInput($request->get('orgType'));
        // $country = $this->setInput($request->get('country'));
        // $region = $this->setInput($request->get('region'));
        // $biographyText = $this->setInput($request->get('biographyText'));
        // $notes = $this->setInput($request->get('biographyText'));
        // $schoolLowerAge = $this->setInput($request->get('schoolLowerAge'));
        // $schoolHigherAge = $this->setInput($request->get('schoolHigherAge'));
        // $schoolURN = $this->setInput($request->get('schoolURN'));
       
        $where = $this->getWhere($recordType, $entry_recordtype, $noentry_recordtype, $con_recordtype);
        $results = DB::select('select * from contact,organisation where '.$where, []);

                // ->where('contact.instruction',$instruction)
                // ->where('contact.recordStatus',$recordStatus)
                // ->where('contact.jobtitle',$jobtitle)
                // ->where('contact.personType',$personType)
                // ->where('contact.professionalInterest',$professionalInterest)
                // ->where('contact.organisaiton',$organisation)
                // ->where('contact.departmentLevel1',$departmentLevel1)
                // ->where('contact.departmentLevel2',$departmentLevel2)
                // ->where('contact.biographyText',$biographyText)
                // ->where('contact.notes',$notes)
                // ->where('organisation.orgType',$orgType)
                // ->where('organisation.professionalInterest',$professionalInterest)
                // ->where('organisation.schoolLowerAge',$schoolLowerAge)
                // ->where('organisation.schoolHigherAge',$schoolHigherAge)
                // ->where('organisation.schoolURN',$schoolURN)
        // dump($results);die;
      
        if (!empty($results)) {
           $data['code']=0;
        } else {
            $data['code']=-1;
        }
        $data['results']=$results;
        $data['name']=$this->getUserName();
        echo json_encode($data);
    }

    // public function search(Request $request){
    //     $table = trim($request->table);
    //     $field = trim($request->field);
    //     $entry = trim($request->entry);
    //     $noentry = trim($request->noentry);
    //     $condition = trim($request->condition);
    //     $where = $this->getWhere($field, $entry, $noentry, $condition);
    //     $results = DB::select('select * from '. $table. ' where '.$where, []);
    //     return view('searchreturn',[
    //                 'table' =>  $table,
    //                 'results' => $results,
    //                 'name' =>$this->getUserName()
    //             ]);
    // }

    public function search_flush(){
        $res = DB::table('organisation')
        ->paginate(20);
        return view('searchreturn',[
                    'table' =>'organisation',
                    'results' => $res,
                    'name' =>$this->getUserName()
        ]);
    }

    public function search_contact_flush(){
        $res = DB::table('contact')
        ->paginate(20);
        return view('searchreturn',[
                    'table' =>'contact',
                    'results' => $res,
                    'name' =>$this->getUserName()
        ]);
    }

    public function search_admin(Request $request){
        $field = trim($request->field);
        $entry = trim($request->entry);
        $noentry = trim($request->noentry);
        $condition = trim($request->condition);
        $where = $this->getWhere($field, $entry, $noentry, $condition);
        // var_dump('select * from user where '.$where);die;
        $res = DB::select('select * from user where '.$where, []);
        // var_dump($res);
        $loginUser = $this->getUser();
        foreach($res as $v) {
            if ($v->type == $loginUser->type){
                session::flash('message', "Same level user can not edit");
                break;
            }
        }
        return view('search_admin_return',[
                    'results' => $res,
                    'name' =>$this->getUserName()
                ]);
    }

    public function search_admin_flush(){
        $res = DB::table('user')->paginate(20);
        return view('search_admin_return',[
                    'results' => $res,
                    'name' =>$this->getUserName()
        ]);
    }

    private function getWhere($field, $entry, $noentry, $condition) {
        $where = '';
        $entryArr = explode(',', $entry);
        $noentryArr = explode(',', $noentry);
        if ($entry != '' && !empty($entryArr)) {
            foreach ($entryArr as $k=>$v) {
                if ($k != 0){
                    $where.= ' or ';
                }
                if ($condition == 'like') {
                    $where .= $field . ' like ' ."'" .'%'.$v . "' ";
                } elseif($condition == 'exact') {
                    $where .= $field . ' = ' ."'" .$v. "' ";
                }
            }
        }
        if ($noentry != '' &&  !empty($noentryArr)) {
            $where.= ' and ';
            foreach ($noentryArr as $k=>$v) {
                if ($k != 0){
                    $where.= ' and ';
                }
                if ($condition == 'like') {
                    $where .= $field .' not like '."'" .'%'.$v . "' ";
                } elseif($condition == 'exact') {
                    $where .= $field .' != ' . "'" .$v. "' ";
                }
            }
        }
        if ($entry == '' && $noentry=='') {
            $where .= '1=1';
        }
        return $where;  
    }
   
}
