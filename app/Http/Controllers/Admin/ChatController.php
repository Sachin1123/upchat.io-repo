<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\ChatDetail;
use App\Models\Chat;
use DataTables;
use Carbon\Carbon;
use Response;
class ChatController extends Controller
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
        $query =  Chat::with('users');
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
                      
                            ->addColumn('view', function ($row)
                            {
                                $view = '<span class="action-buttons">
                                <a  href="' . route("chats.show", $row->chatId) . '" class="btn btn-sm btn-info btn-b"><i class="fa fa-eye" aria-hidden="true"></i>

                                </a> ';
                                return $view;
                            })
                       
                            ->addColumn('lead_type', function ($row)
                            {
                              if($row->leadType == 0){
                                $lead_type = 'No';
                              }else{
                                $lead_type = 'Yes';
                              }
                                
                                return $lead_type;
                            })
                           
                            ->rawColumns(['view','lead_type'])
                            ->make(true);
        }
        $company = Chat::select('companyName')->distinct()->get();
        return view('admin.chats.index',compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
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
    public function show($id)
    {
      $chat= Chat::where('chatId',$id)->first();
     $users=Company::where('status','=','Active')->where('apex_username','!=',null)->where('apex_company','!=',null)->where('apex_password','!=',null)->get();


      $chatReply= ChatDetail::where('chat_id',$id)->get();
      return view('admin.chats.viewChat', compact('chatReply','chat'));
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
