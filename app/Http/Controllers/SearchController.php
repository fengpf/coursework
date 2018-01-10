<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
    
    
class SearchController extends Controller
{

    private function setWhere($field, $entry, $noentry, $condition, $handle){
        $entryArr = explode(',', $entry);
        $noentryArr = explode(',', $noentry);
        // $entryArr = array_filter($entryArr);
        // $noentryArr= array_filter($noentryArr);
        // dump($field, $entryArr, $noentryArr);die;
        if ($condition=='exact'){
            $handle->whereIn($field, $entryArr);
            $handle->whereNotIn($field, $noentryArr);
        }
        if ($condition=='like'){
            foreach ($entryArr as $v) {
                // dump($v,empty($v));
                if (empty($v)) {
                    $v = ' ';
                }
                $handle->orwhere($field, 'like', '%' . $v . '%');
            }
            foreach ($noentryArr as $v) {
                if (empty($v)) {
                    $v = ' ';
                }
                $handle->where($field, 'not like', '%' . $v . '%');
            }
        }
    }

    public function search(Request $request){
        // key entry noentry condition
        // $checkStr = trim($request->get('checkStr'));
        $fieldStr = trim($request->get('fieldStr'));
        $type = trim($request->get('type'));
        $fieldArr = json_decode($fieldStr, true);
        // dump($fieldArr, $type, ($type == 1) && empty($fieldArr));die;
        if (($type == 0) && empty($fieldArr)) {
            return redirect()->action('ContactController@data_search');
        }
        if (($type == 1) && empty($fieldArr)) {
            return redirect()->action('UserController@admin_search');
        }
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
    
               $field = $val['key'];
               if (in_array($val['key'], 
                  ['orgType', 'organisation', 'schoollowerage', 'schoolhigherage', 'schoolURN'])) {
                  if($val['key'] == 'organisation') {
                     $field = 'name';
                  }
                  $this->setWhere($field, $entry, $noentry, $condition, $handle2);
                //   dump($val['key']);
                  $queryOrg = true;
               } elseif (in_array($val['key'], 
                   ['professionalInterest', 'country', 'region', 'notes'])) {
                  $this->setWhere($field, $entry, $noentry, $condition, $handle);
                  $this->setWhere($field, $entry, $noentry, $condition, $handle2);
                //   dump($val['key']);
                  $queryall = true;
               } else {
                  $this->setWhere($field, $entry, $noentry, $condition, $handle);
                //   dump($val['key']);
                  $queryCon = true;
               }
            }
       }
       $results = $results2 = [];
       if ($queryall) {
          $results =  $handle->paginate(10);
          $results2 =  $handle2->paginate(10);
       } 
       if ($queryOrg) {
          $results2 =  $handle2->paginate(10);
       } 
       if ($queryCon) {
          $results =  $handle->paginate(10);
       }

    //   dump($results, $results2,!empty($results),!empty($results2));die;
      if (!empty($results)) {
        return view('searchreturn',[
            'fieldStr' => $fieldStr,
            'fieldArr' => $fieldArr,
            'results' => $results,
            'name' =>$this->getUserName()
        ]);
      } 

      if (!empty($results2)) {
        return view('searchreturn_org',[
            'fieldStr' => $fieldStr,
            'fieldArr' => $fieldArr,
            'results2' => $results2,
            'name' =>$this->getUserName()
        ]);
      } 
       
    }
   
}
