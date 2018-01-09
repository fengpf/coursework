<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dataupload;
use App\Organisation;
use DB;
use Session;
use Illuminate\Support\Collection;

class DatauploadController extends Controller
{    
    public function dataupload_form(Request $request){
        if(!$this->check_permission($request)){
           $request->session()->flash('message', "Session expired, login required");
            return redirect()->action('HomeController@index');
        }
        $title = "Dataupload";
        $products = DB::table('dataupload')
        ->where('id', '!=', 1)
        ->orderBy('id', 'desc')
        ->paginate(10);
        $all_products = DB::table('dataupload')
        ->where('id', '!=', 1)
        ->get();
        return view('dataupload.dataupload_form', [
                    'title' => $title,
//                    'dataupload' => $dataupload,
//                    'all_dataupload' => $all_dataupload
                    ]);
    }
    
    public  function  Index(){
        return view('dataupload',['name' =>$this->getUserName()]);
    }

    public  function DailyReport(Request $request){
        $report = DB::table('report')
            ->orderBy('id', 'desc')
            ->get();
        // dump($report);die;
        foreach($report as $k=>$v) {
            $entryTime = strtotime($v->entry_time);
            $createdAtTime = strtotime($v->created_at);
            $updatedAtTime = strtotime($v->updated_at);
            $entryTimeStr = date('Y-m-d', $entryTime);
            $createdAtTimeStr = date('Y-m-d', $createdAtTime);
            $updatedAtTimeStr = date('Y-m-d', $updatedAtTime);
            $v->entry_time =  $entryTimeStr;
            $v->created_at =  $createdAtTimeStr;
            $v->updated_at =  $updatedAtTimeStr;
            $report[$k] =  $v;
        }
        // dump($report->items());
        $temp = [];
        foreach($report as $k=>$v) {
            $temp[$v->entry_time][$k] = $v;
        }
        $temp2 = [];
        foreach($temp as $k=>$v) {
            $new = $up = $del= 0;
            foreach($v as $kk=>$vv) {
                $new+=$vv->new;
                $up+=$vv->up;
                $del+=$vv->del;
            }
            $temp2[$k]['new']=$new;
            $temp2[$k]['up']=$up;
            $temp2[$k]['del']=$del;
            $temp2[$k]['sub']=$new + $up - $del;
        }
        // dump($temp2);die;
        return view('dailyreport',[
            'report' => $temp2,
            'name' =>$this->getUserName()
        ]);
    }

    public  function DailyReportList(Request $request){
        $sub = trim($request->sub);
        $date = trim($request->date);
        $start = strtotime($date);
        $end = strtotime($date) + 86400;  
        $startStr=date('Y-m-d H:i:s', $start);
        $endStr=date('Y-m-d H:i:s', $end);
        // dump($date,$startStr, $endStr);die;
        $report = DB::table('report')
        ->where('entry_time', '>=', $startStr)
        ->where('entry_time', '<=', $endStr)
        ->paginate(10);
        foreach($report->items() as $k=>$v) {
            $entryTime = strtotime($v->entry_time);
            $createdAtTime = strtotime($v->created_at);
            $updatedAtTime = strtotime($v->updated_at);
            $entryTimeStr = date('Y-m-d', $entryTime);
            $createdAtTimeStr = date('Y-m-d', $createdAtTime);
            $updatedAtTimeStr = date('Y-m-d', $updatedAtTime);
            $v->entry_time =  $entryTimeStr;
            $v->created_at =  $createdAtTimeStr;
            $v->updated_at =  $updatedAtTimeStr;
            $report->items()[$k] =  $v;
        }
        // dump($report);die;
        return view('dailyreportlist',[
            'date' => $date,
            'report' => $report,
            'sub' => $sub,
            'name' =>$this->getUserName()
        ]);
    }

    public  function TargetReport(){
        $user = DB::table('user')
        ->orderBy('id', 'desc')
        ->get();
        return view('targetreport',[
            'users'=>$user,
            'name' =>$this->getUserName()
        ]);
    }

    public  function Targetreportreturn(Request $request){
        $start = trim($request->start);
        $end = trim($request->end);
        $startStr=date('Y-m-d H:i:s', strtotime($start));
        $endStr=date('Y-m-d H:i:s', strtotime($end) + 86400);
        $name = trim($request->name);
        $user = DB::table('user')->where('fname', $name)->first();
        $report = DB::table('report')
            ->where('mid', '=', $user->id)
            ->where('entry_time', '>=', $startStr)
            ->where('entry_time', '<=', $endStr)
            ->get();

        foreach($report as $k=>$v) {
            $entryTime = strtotime($v->entry_time);
            $createdAtTime = strtotime($v->created_at);
            $updatedAtTime = strtotime($v->updated_at);
            $entryTimeStr = date('Y-m-d', $entryTime);
            $createdAtTimeStr = date('Y-m-d', $createdAtTime);
            $updatedAtTimeStr = date('Y-m-d', $updatedAtTime);
            $v->entry_time =  $entryTimeStr;
            $v->created_at =  $createdAtTimeStr;
            $v->updated_at =  $updatedAtTimeStr;
            $report[$k] =  $v;
        }
        $temp = [];
        foreach($report as $k=>$v) {
            $temp[$v->entry_time][$k] = $v;
        }
        $temp2 = [];
        foreach($temp as $k=>$v) {
            $new = $up = $del= 0;
            foreach($v as $kk=>$vv) {
                $new+=$vv->new;
                $up+=$vv->up;
                $del+=$vv->del;
            }
            $temp2[$k]['new']=$new;
            $temp2[$k]['up']=$up;
            $temp2[$k]['del']=$del;
            $temp2[$k]['sub']=$new + $up - $del;
        }
        return view('dailyreport',[
            'report' => $temp2,
            'name' =>$this->getUserName()
        ]);
    }

    public function csv(Request $request){
        $action = trim($request->action);
        if ($action == 'import') { //导入CSV   
            $filename = $_FILES['csv_file']['tmp_name'];   
            if(empty($filename))   
            {   
                echo 'select CSV file！';   
                return;   
            }   
            $handle = fopen($filename, 'r');
            $result = $this->input_csv($handle);
            fclose($handle); //关闭指针 
            // var_dump($result);
            $len_result = count($result);   
            if($len_result==0)   
            {   
                echo 'no data';   
                return;   
            }   
            $res = [];
            $count=0;
            for($i = 1; $i < $len_result; $i++) //循环获取各字段值   
            {    
                $table = $result[$i][0];   
                $id = $result[$i][1];   
                $name = $result[$i][2];   
                $orgType = $result[$i][3];  
                $interestSectorAreas = $result[$i][4];  
                $twitter = $result[$i][5];  

                $org = new Organisation;
                $org->id=$id;
                $org->name=$name;
                $org->orgType=$orgType;
                $org->interestSectorAreas=$interestSectorAreas;
                $org->twitter=$twitter;
                
                $res[$i]=$org;
                $count++; 
            }   
            // var_dump($res);
            $title = "Total result found " . $count;
            return view('searchreturn', [
                    'table' =>  $table,
                    'title' => $title,
                    'results' => $res,
                    'name' =>$this->getUserName()
            ]);
            
        }  elseif ($action=='export')  {
            $table = $request->table;
            if ($table == 'admin') {
                $id = $request->id;
                $fname = $request->fname;
                $lname = $request->lname;
                $email = $request->email;
                if(empty($id))   
                {   
                    echo 'no data to export';   
                    return;   
                } 
                $str = "table, id,fname,lname,email".PHP_EOL;   
                // $str = iconv('utf-8','gb2312',$str);  
                foreach  ($id as $k=>$v){
                    $vid = $v;  
                    $vfname = $fname[$k];  
                    $vlname = $lname[$k];
                    $vemail = $email[$k];  
                    $str .= $table ."," . $vid.",".$vfname.",".$vlname.",".$vemail.PHP_EOL; //用引文逗号分开 
                }
            } elseif ($table == 'organisation') {
                $id = $request->id;
                $name = $request->name;
                $orgType = $request->orgType;
                $inSectorAreas = $request->interestSectorAreas;
                $twitter = $request->twitter;
                if(empty($id))   
                {   
                    echo 'no data to export';   
                    return;   
                } 
                $str = "table, id,name,orgType,interestSectorAreas,twitter".PHP_EOL;   
                // $str = iconv('utf-8','gb2312',$str);  
                foreach  ($id as $k=>$v){
                    $vid = $v;  
                    $vname = $name[$k];  
                    $vorgType = $orgType[$k];
                    $vinSectorAreas = $inSectorAreas[$k];  
                    $vtwitter = $twitter[$k];  
                    $str .= $table ."," . $vid.",".$vname.",".$vorgType.",".$vinSectorAreas.",".$vtwitter.PHP_EOL; //用引文逗号分开 
                }
            } elseif ($table == 'contact') {
                $id = $request->id;
                $instruction = $request->instruction;
                $jobtitle = $request->jobtitle;
                $personType = $request->personType;
                $organisation = $request->organisation;
                $region = $request->region;
                $country = $request->country;
                if(empty($id))   
                {   
                    echo 'no data to export';   
                    return;   
                } 
                $str = "table,id,instruction,jobtitle,personType,organisation,region,country".PHP_EOL;   
                // $str = iconv('utf-8','gb2312',$str);  
                foreach  ($id as $k=>$v){
                    $vid = $v;  
                    $vinstruction = $instruction[$k];  
                    $vjobtitle = $jobtitle[$k];
                    $vpersonType = $personType[$k];  
                    $vorganisation = $organisation[$k];  
                    $vregion = $region[$k];  
                    $vcountry = $country[$k];  
                    
                    $str .= $table ."," . $vid.",".$vinstruction.",".$vjobtitle.","
                    .$vpersonType.",".$vorganisation
                    .",".$vregion.",".$vcountry.PHP_EOL; //用引文逗号分开 
                }
            }
            // var_dump($str);
            $filename = date('Y-m-d H:i:s') .'_'. $table .'.csv'; //设置文件名 
            $this->export_csv($filename, $str);
        } 
    }

    private function input_csv($handle)   
    {   
        $out = array ();   
        $n = 0;   
        while ($data = fgetcsv($handle, 10000))   
        {   
            $num = count($data);   
            for ($i = 0; $i < $num; $i++)   
            {   
                $out[$n][$i] = $data[$i];   
            }   
            $n++;   
        }   
        return $out;   
   }  

    private function export_csv($filename,$data)   
    {   
            header("Content-type:text/csv");   
            header("Content-Disposition:attachment;filename=".$filename);   
            header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
            header('Expires:0');   
            header('Pragma:public');   
            echo $data;  
    }  

    
}
