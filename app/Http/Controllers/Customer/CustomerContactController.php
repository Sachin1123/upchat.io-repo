<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use DataTables;
use App\Http\Requests\Admin\Contact\StoreContactRequest;
use App\Http\Requests\Admin\Contact\UpdateContactRequest;
use Auth;

class CustomerContactController extends Controller
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
            $query =  Contact::where('user_id', Auth::user()->id);
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
                $query->whereBetween('created_at', [$StartDate, $endDate]);
            $data= $query->get(); 
         

            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function ($row)
                            {
                                $action = '
                                <a  href="' . route("customer-contacts.edit", $row) . '" class="btn btn-sm btn-info btn-b"><i class="las la-pen"></i>
                                Edit
                                 </a>
                                <a href="' . route("customer-contacts.destroy", $row) . '"
                                class="btn btn-sm btn-danger remove_us"
                                title="Delete Contact"
                                data-toggle="tooltip"
                                data-placement="top"
                                data-method="DELETE"
                                data-confirm-title="Please Confirm"
                                data-confirm-text="Are you sure that you want to delete this Contact?"
                                data-confirm-delete="Yes, delete it!">
                                Delete
                                <i class="las la-trash"></i>
                            </a>     
                                ';
                                return $action;
                            })
                          
                           
                            ->rawColumns(['action'])
                            ->make(true);
        }
        return view('customer.contacts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.contacts.addEdit');
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id']= Auth::user()->id;
        Contact::create($inputs);
       
        return redirect('customer/customer-contacts')->with('success', 'Contact Create successfully!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
 
    $contact= Contact::find($id);
        return view('customer.contacts.addEdit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request,$id)
    {
        $contact= Contact::find($id);
        $inputs = $request->all();
        $inputs['user_id']= Auth::user()->id;
        $contact->update($inputs);
       
        return redirect('customer/customer-contacts')->with('success', 'Contact updated successfully!'); 
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Contact::find($id)->delete();

        return back()->with('success', 'Contact deleted successfully!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 
}
