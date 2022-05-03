
@extends('admin.layouts.app')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                @if(!empty(Auth::user()->profile))
                <img class="profile-user-img img-fluid img-circle" src="{{asset('images/profile/'.Auth::user()->profile)}}" alt="User profile">
                @else
                <img class="profile-user-img img-fluid img-circle" src="{{URL::asset('dist/img/user4-128x128.jpg')}}" alt="User profile">@endif
                </div>

              @if(isset(Auth::user()->email))
              <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
              <p class="text-muted text-center">{{Auth::user()->email}}</p>
              @else
              <h3 class="profile-username text-center">Nina Mcintire</h3>
              <p class="text-muted text-center">demo@gmail.com</p>
              @endif
            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2" style="display: block !important;">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Email</a></li>

                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Update Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Change Password</a></li>

                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                      @if(!empty(Auth::user()->profile))
                      <img class="img-circle img-bordered-sm" src="{{asset('images/profile/'.Auth::user()->profile)}}" alt="User profile">
                      @else
                      <img class="img-circle img-bordered-sm" src="{{URL::asset('dist/img/user6-128x128.jpg')}}" alt="User Image">
                      @endif
                        <span class="username">
                        Email Signature
                        </span>
                      </div>
                      <!-- /.user-block -->
                      <div class="row mb-3">
                        <div class="col-sm-12">
                        @if(!empty(Auth::user()->email_signature))
                        <img class="img-fluid" src="{{asset('images/profile/'.Auth::user()->email_signature)}}" alt="Photo">
                        @else
                        <img class="img-fluid" src="{{URL::asset('dist/img/photo1.png')}}" alt="Photo">
                        @endif

                        </div>
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.post -->
                  </div>


                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" id="user-add-edit" action="{{route('profile.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" id="inputName" placeholder="Name" value="{{!empty(Auth::user()->name) ? Auth::user()->name : '' }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="email" value="{{!empty(Auth::user()->email) ? Auth::user()->email : '' }}" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Profile</label>
                        <div class="col-sm-10">
                          <input type="file" class="dropify" name="profile" data-default-file="{{!empty(Auth::user()->profile) ? asset('images/profile/'.Auth::user()->profile) : '' }}"  class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email Signature</label>
                        <div class="col-sm-10">
                          <input type="file" class="dropify" name="email_signature"  data-default-file="{{!empty(Auth::user()->email_signature) ? asset('images/profile/'.Auth::user()->email_signature) : '' }}" id="inputEmail" placeholder="Email">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                <div class="tab-pane" id="password">
                    <form class="form-horizontal" id="change-password" action="{{route('passwordChange')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                        <input type="password" class="form-control" name="password_confirmation">

                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Change</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
  @section('scripts')

{!! JsValidator::formRequest('App\Http\Requests\Admin\ChangePasswordRequest','#change-password') !!}


@endsection
