<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Http\Requests\Admin\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        return view('admin.profile.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contacts.addEdit');
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
        return redirect('admin/profile')->with('success', 'Profile Updated successfully!'); 
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
    public function passwordChange(ChangePasswordRequest $request){

      
      $user= User::find(auth::user()->id)->update([ 'password' => Hash::make($request['password'])]);

      return back()->with('success', 'Password Update successfully!');
    }
 
}
