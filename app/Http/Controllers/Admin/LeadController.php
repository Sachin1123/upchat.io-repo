<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lead;
use App\Models\ChatDetail;

use DataTables;
use Carbon\Carbon;
use Response;
class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        if ($request->ajax())
        {

        
        $date_range=$request->timeInterval;   
        $query =  Lead::with('users');
        if ($date_range) {
            $date_range= explode('-',$date_range);
            $start_date=$date_range[0];
            $end_date=$date_range[1];
            $start_date = date("Y-m-d", strtotime($start_date));
            $end_date = date("Y-m-d", strtotime($end_date));
            $StartDate = $start_date.' 00:00:00';
            $endDate = $end_date.' 23:59:59';
          }else{
            $StartDate = date("Y-m-d h:m:s", strtotime('-30 days'));
            $endDate = date("Y-m-d h:m:s");
          }
          if(!empty($request->companies)){
            $query->where('companyName', $request->companies);
          }
            $query->whereBetween('created_at', [$StartDate, $endDate]);
        
            $data= $query->orderBy('created_at', 'desc');
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function ($row)
                            {
                                $action = '
                            <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="nav-icon fas fa-ellipsis-h"></i><span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu adjust">
                                <li><a href="#" class="btn btn-default">Email Transcript</a></li>
                                <li><a  id="'.$row->id.'" class="btn  btn-default resolved">Mark As Resolved</a></li>
                                <li><a href="' . route("contacts.create") . '"  class="btn btn-default">Add To Contact</a></li>
                  
                            </ul>
                        </div>
                    ';
                                return $action;
                            })
                            ->addColumn('view', function ($row)
                            {
                                $view = '<span class="action-buttons">
                                <a  href="' . route("leads.show", $row) . '" class="btn btn-sm btn-info btn-b"><i class="fa fa-eye" aria-hidden="true"></i>

                                </a> ';
                                return $view;
                            })
                            ->addColumn('status', function ($row)
                            {
                              if($row->leadStatus == 'Valid'){
                                $status = '
                               <i  id="'.$row->id.'" class="fa fa-check edit" ></i>
                                ';
                              }elseif($row->leadStatus == 'Invalid'){
                                $status = '
                                <i class="fa fa-times" ></i> 
                                ';
                              }else{
                                $status = '
                                <i class="fa" >Resolved</i> 
                                ';  
                              }
                                
                                return $status;
                            })
                            ->addColumn('lead_type', function ($row)
                            {
                              if($row->leadType == 1){
                                $lead_type = 'Sales';
                              }elseif($row->leadType == 2){
                                $lead_type = 'Service';
                              }else{
                                $lead_type = 'Other';
                              }
                                
                                return $lead_type;
                            })
                           
                            ->rawColumns(['action','status','view','lead_type'])
                            ->make(true);
        }
        $company = Lead::select('companyName')->distinct()->get();
        return view('admin.leads.index',compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
     
      $lead=Lead::find($request->id);
      if($lead){
          $lead->leadStatus= 'Resolve';
          $lead->save();
          return json_encode(array('success'=>true));
      }
      return json_encode(array('success'=>false));
    }

    public function ajaxEdit(Request $request)
    {
     
      $lead=Lead::find($request->id);
      if($lead){
          
        return Response::json($lead);
      }
      
    }
    public function invalidStatus(Request $request)
    {
     
      $lead=Lead::find($request->lead_id);
      if($lead){
          $lead->leadStatus = "Invalid";
          $lead->rejectReason =$request->rejectReason;
          $lead->save();
        return Response::json($lead);
      }
      
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
    
      $chat= ChatDetail::where('chat_id',$lead->chatId)->get();
      
      return view('admin.leads.viewLead', compact('lead','chat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
 

        return view('admin.leads.addEdit', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Lead $lead)
    {

        $inputs = $request->all();
        
        $lead->update($inputs);
       
        return redirect('admin/leads')->with('success', 'lead updated successfully!'); 
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        
        $lead->delete();

        return back()->with('success', 'Lead deleted successfully!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 
}
