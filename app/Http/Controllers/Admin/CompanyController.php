<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use DataTables;
use App\Http\Requests\Admin\Company\CompanyRequest;
use Auth;

class CompanyController extends Controller
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
            $query =  Company::with('users');
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
                                <a  href="' . route("company.edit", $row) . '" class="btn btn-sm btn-info btn-b"><i class="las la-pen"></i>
                                Edit
                                 </a>
                                <a href="' . route("company.destroy", $row) . '"
                                class="btn btn-sm btn-danger remove_us"
                                title="Delete Contact"
                                data-toggle="tooltip"
                                data-placement="top"
                                data-method="DELETE"
                                data-confirm-title="Please Confirm"
                                data-confirm-text="Are you sure that you want to delete this Company?"
                                data-confirm-delete="Yes, delete it!">
                                Delete
                                <i class="las la-trash"></i>
                            </a>     
                                ';
                                return $action;
                            })
                          
                            ->addColumn('status', function ($row)
                            {
                                if ($row->status == 'Active')
                                {
                                    $status = '<span class="label text-success d-flex">
                                                    <div class="dot-label bg-success me-1"></div>active
                                                </span>';
                                } else
                                {
                                    $status = '<span class="label text-danger d-flex">
                                                    <div class="dot-label bg-danger me-1"></div> inactive
                                                </span>';
                                }

                                return $status;
                            })
                            ->rawColumns(['action', 'status'])
                            ->make(true);
        }
        return view('admin.company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.addEdit');
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
        company::create($inputs);
       
        return redirect('admin/company')->with('success', 'Company Create successfully!'); 
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
    public function edit(Company $company)
    {
 

        return view('admin.company.addEdit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request,Company $company)
    {

        $inputs = $request->all();
  
       
        $company->update($inputs);
       
        return redirect('admin/company')->with('success', 'Company updated successfully!'); 
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        
        $company->delete();

        return back()->with('success', 'Company deleted successfully!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 
}
