<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;

use Auth;
class CustomerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $company= Company::where('user_id',  Auth::user()->id)->first();
        return view('customer.profile.profile',compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function companyDetails(Request $request)
    {
      $inputs = $request->all();

      Company::where('user_id', Auth::user()->id)->update([
        'apex_company' => $inputs['apex_company'],
        'apex_username' => $inputs['apex_username'],
        'apex_password' => $inputs['apex_password'],

        ]);
      return redirect('customer/customer-profile')->with('success', 'Company Details Updated successfully!'); 
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        if(!empty($inputs['profile'])){
          $imageName = time().'.'.$request->profile->extension();  
          $request->profile->move(public_path('images/profile'), $imageName);
          $inputs['profile']=$imageName;
        }
        if(!empty($inputs['email_signature'])){
          $imageName = time().'.'.$request->email_signature->extension();  
          $request->email_signature->move(public_path('images/profile'), $imageName);
          $inputs['email_signature']=$imageName;
        }
       
      $user=  User::find(Auth::user()->id);
      if(!empty($user)){
        $user->update($inputs);
      } 
        return redirect('customer/customer-profile')->with('success', 'Profile Updated successfully!'); 
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

       
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        
      
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 
}
