<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lead;
use DataTables;

use App\Exports\LeadExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
       $lead = Lead::select('companyName')->distinct()->get();
      
        return view('admin.reports.index',compact('lead'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    
        $sites  = $request->sites ?? '';
        $date_range  = $request->date_range ?? '';

        return Excel::download(new LeadExport($sites,$date_range), 'LeadsExport.csv');
       
        
    }

    public function pdfDownload(Request $request)
    {
        
    
        $sites  = $request->sites ?? null;
        $date_range  = $request->date_range ?? null;


       
        $query =  Lead::select('*');

        if ($sites != 'all_lead') {
            $query->where('companyName', $sites);
        }

        if ($date_range) {
          
            $date_range= explode('-',$date_range);
            $start_date=$date_range[0];
            $end_date=$date_range[1];
            
            $start_date = date("Y-m-d", strtotime($start_date));
            $end_date = date("Y-m-d", strtotime($end_date));
            $StartDate = $start_date.' 00:00:00';
            $endDate = $end_date.' 23:59:59';
          
            $query->whereBetween('created_at', [$StartDate, $endDate]);
        }
       
        $result= $query->get();
     
        $pdf = PDF::loadView('admin.reports.pdf', ['result' => $result]);
    
        return $pdf->download('invoice.pdf');

       
       
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
 

        return view('admin.contacts.addEdit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request,Contact $contact)
    {

        $inputs = $request->all();
        
        $contact->update($inputs);
       
        return redirect('admin/contacts')->with('success', 'Contact updated successfully!'); 
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        
        $contact->delete();

        return back()->with('success', 'Contact deleted successfully!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 
}
