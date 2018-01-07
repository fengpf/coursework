<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
    
    
class SearchController extends Controller
{

    private function setWhere($field, $entryArr, $noentryArr, $condition, $handle){
        
        if (!empty($entryArr)) {
            if ($condition=='exact'){
                 foreach ($entryArr as $v) {
                     if (!empty($v)) {
                       $handle->where($field, '=', $v);
                     }
                 }
            } elseif ($condition=='like') {
                 foreach ($entryArr as $v) {
                     if (!empty($v)) {
                        $handle->where($field, 'like', '%' . $v . '%');
                     }
                 }
            } elseif ($condition=='not') {
                 foreach ($entryArr as $v) {
                     if (!empty($v)) {
                        $handle->where($field, 'not like', '%' . $v . '%');
                     }
                 }
            }
        }

        if (!empty($noentryArr)) {
             if ($condition=='exact'){
                 foreach ($noentryArr as $v) {
                     if (!empty($v)) {
                         $handle->where($field, '=', $v);
                     }
                 }
             } elseif ($condition=='like') {
                 foreach ($noentryArr as $v) {
                     if (!empty($v)) {
                        $handle->where($field, 'like', '%' . $v . '%');
                     }
                 }
             } elseif ($condition=='not') {
                 foreach ($noentryArr as $v) {
                     if (!empty($v)) {
                        $handle->where($field, 'not like', '%' . $v . '%');
                     }
                 }
             }
         }
    }

    public function search(Request $request){
        // key entry noentry condition
        $fieldStr = trim($request->get('fieldStr'));
        // $checkStr = trim($request->get('checkStr'));
        $fieldArr = json_decode($fieldStr, true);
        $handle = DB::table('contact');
        $handle2 = DB::table('organisation');
        $queryOrg = false;
        $queryCon = false;
        $queryall = false;
        foreach ($fieldArr as $key=>$val) {
           if (isset($val['key']) && !empty($val['key'])) {
               $condition = $val['condition'];
               $entry = $val['entry'];
               $noentry = $val['noentry'];
               $entryArr = explode(',', $entry);
               $noentryArr = explode(',', $noentry);
               $field = $val['key'];
               if (in_array($val['key'], 
                  ['organisation', 'schoollowerage', 'schoolhigherage', 'schoolURN'])) {
                  if($val['key'] == 'organisation') {
                     $field = 'name';
                  }
                  $this->setWhere($field, $entryArr, $noentryArr, $condition, $handle2);
                //   dump($val['key']);
                  $queryOrg = true;
               } elseif (in_array($val['key'], 
                   ['professionalinterests', 'country', 'region', 'notes'])) {
                  $this->setWhere($field, $entryArr, $noentryArr, $condition, $handle);
                  $this->setWhere($field, $entryArr, $noentryArr, $condition, $handle2);
                //   dump($val['key']);
                  $queryall = true;
               } else {
                  $this->setWhere($field, $entryArr, $noentryArr, $condition, $handle);
                //   dump($val['key']);
                  $queryCon = true;
               }
            }
       }
    
       $results = $results2 = [];
       if ($queryall) {
          $results =  $handle->get();
          $results2 =  $handle2->get();
       } 
       if ($queryOrg) {
          $results2 =  $handle2->get();
       } 
       if ($queryCon) {
          $results =  $handle->get();
       }

    //    dump($results);die;
      if (!empty($results)) {
        return view('searchreturn',[
            'fieldArr' => $fieldArr,
            'results' => $results,
            'name' =>$this->getUserName()
        ]);
      } 

      if (!empty($results2)) {
        return view('searchreturn_org',[
            'fieldArr' => $fieldArr,
            'results2' => $results2,
            'name' =>$this->getUserName()
        ]);
      } 
       
    }

    public function search_flush(){
        $res = DB::table('organisation')
        ->paginate(20);
        return view('searchreturn_org',[
                    'table' =>'organisation',
                    'results2' => $res,
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
        $fieldStr = trim($request->get('fieldStr'));
        $fieldArr = json_decode($fieldStr, true);
        $handle = DB::table('user');
        foreach ($fieldArr as $key=>$val) {
           if (isset($val['key']) && !empty($val['key'])) {
               $condition = $val['condition'];
               $entry = $val['entry'];
               $noentry = $val['noentry'];
               $entryArr = explode(',', $entry);
               $noentryArr = explode(',', $noentry);
               $field = $val['key'];
               $this->setWhere($field, $entryArr, $noentryArr, $condition, $handle);
            }
       }
    
       $results =  [];
       $results =  $handle->get();
        return view('search_admin_return',[
            'fieldArr' => $fieldArr,
            'results' => $results,
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
