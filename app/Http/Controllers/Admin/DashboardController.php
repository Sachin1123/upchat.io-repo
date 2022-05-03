<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\User;
use App\Models\Contact;
use App\Models\ServiceTicket;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * dashboard view
     * @return type
     */
    public function index()
    {
        
       $leads = Lead::count();
       $user=User::count();
       $contact=Contact::count();
       $serviceTicket=ServiceTicket::count();
       return view("admin.dashboard",compact('leads','user','serviceTicket','contact'));
    }

    public function ajaxDashboard(Request $request)
    {
       
        $date_range=$request->interval; 
     
    
        if ($date_range) {
           
           $date_range= explode('-',$date_range);
           $start_date=$date_range[0];
           $end_date=$date_range[1];
           $start_date = date("Y-m-d", strtotime($start_date));
           $end_date = date("Y-m-d", strtotime($end_date));
           $StartDate = $start_date.' 00:00:00';
           $endDate = $end_date.' 23:59:59';
  
           $sales = Lead::where(['leadType'=>1])->whereBetween('created_at', [$StartDate,$endDate])->count();
       $services=Lead::where(['leadType'=>2])->whereBetween('created_at', [$StartDate,$endDate])->count();
       $other=Lead::where(['leadType'=>3])->whereBetween('created_at', [$StartDate,$endDate])->count();
       $dataPoints = [];

       $dataPoints[0] = [
           "name" => 'Sales',
           "y" => $sales
       ];
       $dataPoints[1] = [
           "name" => 'Service',
           "y" => $services
       ];
       $dataPoints[2] = [
        "name" => 'Other',
        "y" => $other
    ];
         

               $data=json_encode($dataPoints);
               return response()->json($data);
  
       }
 
       $StartDate = date("Y-m-d h:m:s", strtotime('-30 days'));
       $endDate = date("Y-m-d h:m:s");
       $sales = Lead::where(['leadType'=>1])->whereBetween('created_at', [$StartDate,$endDate])->count();
       $services=Lead::where(['leadType'=>2])->whereBetween('created_at', [$StartDate,$endDate])->count();
       $other=Lead::where(['leadType'=>3])->whereBetween('created_at', [$StartDate,$endDate])->count();
       $dataPoints = [];

       $dataPoints[0] = [
           "name" => 'Sales',
           "y" => $sales
       ];
       $dataPoints[1] = [
           "name" => 'Service',
           "y" => $services
       ];
       $dataPoints[2] = [
        "name" => 'Other',
        "y" => $other
    ];
      $data=json_encode($dataPoints);
     
      return response()->json($data);
 
    }
    public function ajaxBar(Request $request){

        $date_range=$request->interval;  
        $lables =[];
        if ($date_range) {
           
           $date_range= explode('-',$date_range);
           $start_date=$date_range[0];
           $end_date=$date_range[1];
           $start_date = date("Y-m-d", strtotime($start_date));
           $end_date = date("Y-m-d", strtotime($end_date));
           $StartDate = $start_date.' 00:00:00';
           $endDate = $end_date.' 23:59:59';
           $period = new CarbonPeriod($StartDate, '1 day', $endDate);
       
        if(count($period)<32)
        {    
        
            foreach ($period as $dt) {
             $startdate =  $dt->format("Y-m-d");
             $start = $startdate.' 00:00:00';
             $end = $startdate.' 23:59:59';
             $saleLeadsCountt = Lead::whereBetween('created_at', [$start, $end])->count();
             $data[0]=$dt->format("dM");
             $data[1]=$saleLeadsCountt;
             array_push($lables,$data);           
            }
            $data=json_encode($lables);
            return response()->json($data);
        }
        
          
        $saleLeads = Lead::select('id', 'created_at')->whereBetween('created_at', [$StartDate, $endDate])->get()->groupBy(function($date) {
           return Carbon::parse($date->created_at)->format('m'); // grouping by months
       });
      
       $saleLeadsMonCount = [];
   
       $saleLeadsArr = [];
     
       foreach ($saleLeads as $key => $value) {
           $saleLeadsMonCount[(int)$key] = count($value);

       }
       for($i = 1; $i <= 12; $i++){
           if(!empty($saleLeadsMonCount[$i])){
               $saleLeadsArr[$i] = $saleLeadsMonCount[$i];    
           }else{
               $saleLeadsArr[$i] = 0;    
           }
       }
      
     
       foreach ($saleLeadsArr as $key => $value) {
         
           ($key == 1) ? ($data[0]='jan') : '';
           ($key == 2) ? ($data[0]='feb') : '';
           ($key == 3) ? ($data[0]='march') : '';
           ($key == 4) ? ($data[0]='april') : '';
           ($key == 5) ? ($data[0]='may') : '';
           ($key == 6) ? ($data[0]='june') : '';
           ($key == 7) ? ($data[0]='july') : '';
           ($key == 8) ? ($data[0]='aug') : '';
           ($key == 9) ? ($data[0]='sep') : '';
           ($key == 10) ? ($data[0]='oct') : '';
           ($key == 11) ? ($data[0]='nov') : '';
           ($key == 12) ? ($data[0]='dec') : '';
           $data[1]=$value;  
           array_push($lables,$data);  
       }
       $data=json_encode($lables);
            return response()->json($data);

     
       
       }
       
      
       $StartDate = date("Y-m-d h:m:s", strtotime('-30 days'));
       $endDate = date("Y-m-d h:m:s");
       $period = new CarbonPeriod($StartDate, '1 day', $endDate);
       
       foreach ($period as $dt) {
           $startdate =  $dt->format("Y-m-d");
           $start = $startdate.' 00:00:00';
           $end = $startdate.' 23:59:59';
           $saleLeadsCountt = Lead::whereBetween('created_at', [$start, $end])->count();
           $data[0]=$dt->format("dM");
           $data[1]=$saleLeadsCountt;
           array_push($lables,$data);           
          }
          $data=json_encode($lables);
          return response()->json($data);
   }
}
