<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Requests\Admin\User\UserApexRequest;

class UserController extends Controller
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
  

            $query =  User::with('roles');


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
                        <a  href="' . route("users.edit", $row) . '" class="btn btn-sm btn-info btn-b"><i class="las la-pen"></i>
                       Edit
                        </a>

                        <a href="' . route("users.destroy", $row) . '"
                                class="btn btn-sm btn-danger remove_us"
                                title="Delete User"
                                data-toggle="tooltip"
                                data-placement="top"
                                data-method="DELETE"
                                data-confirm-title="Please Confirm"
                                data-confirm-text="Are you sure that you want to delete this User?"
                                data-confirm-delete="Yes, delete it!">
                                Delete
                                <i class="las la-trash"></i>
                            </a>
                    ';
                                return $action;
                            })
                            
                            ->addColumn('apex', function ($row)
                            {
                               
                                $apex = '<a  href="' . url("admin/apex-detail", $row) . '" class="btn btn-sm btn-success btn-b"><i class="las la-pen"></i>
                                Add
                                 </a>';
                                 if($row->roles[0]->name == 'Customer'){
                                    return $apex;
                                 }
                               
                            })
                            ->rawColumns(['action','apex'])
                            ->make(true);
        }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::where('name', '!=', 'IotAdmin')->get();

        return view('admin.users.addEdit', compact('role'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $inputs = $request->all();

        $inputs['password'] = bcrypt($request->password);
        $user =User::create([
                'name' => $inputs['name'],
                'email' => $inputs['email'],
                'password' => $inputs['password'],
               
            ]);
            $company =Company::create([
                'apex_company' => $inputs['apex_company'],
                'apex_username' => $inputs['apex_username'],
                'apex_password' => $inputs['apex_password'],
                'user_id' => $user['id'],
                'status' => 'Active',
 
            ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $role = Role::updateOrCreate(['name' => $request->role]);
        $user->assignRole($role);
        return redirect('admin/users')->with('success', 'User addded successfully!');
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
        $user = User::with('company')->where('id', $id)->first();
        $role = Role::where('name', '!=', 'IotAdmin')->get();
       
        return view('admin.users.addEdit', compact('user', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
  
        $inputs = $request->all();
        $inputs['password'] = bcrypt($request->password) ?? $user->paasword ;

        $user->update([
                'name' => $inputs['name'],
                'email' => $inputs['email'],
                'password' => $inputs['password'],
               
            ]);
            $company=Company::where('user_id',$user->id)->first();
            if(!empty($company)){
                $company->update([
                    'apex_company' => $inputs['apex_company'],
                    'apex_username' => $inputs['apex_username'],
                    'apex_password' => $inputs['apex_password'],
                    'user_id' => $user['id'],
                    'status' => 'Active',
     
                ]);
            }else{
                Company::create([
                    'apex_company' => $inputs['apex_company'],
                    'apex_username' => $inputs['apex_username'],
                    'apex_password' => $inputs['apex_password'],
                    'user_id' => $user['id'],
                    'status' => 'Active',
     
                ]);
            }
            
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $role = Role::updateOrCreate(['name' => $request->role]);
        $user->syncRoles([$role]);

        return back()->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apexDetails($id)
    {
     
        $user = User::find($id);
        return view('admin.users.apexDetail', compact('user'));
    }
    public function apexUpdate(UserApexRequest $request,$id)
    {

        $inputs = $request->all();
        User::find($id)->update($inputs);
        return back()->with('success', 'Apex Details updated successfully!');
    }
}
