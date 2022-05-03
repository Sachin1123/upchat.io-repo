@extends('customer.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a  class="btn btn-primary" href="{{ route('users.index') }}">View Users</a></li> 
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{isset($user) ? 'Update # '.$user->id : 'Add New' }} </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form class="form-horizontal" id="user-add-edit" action="{{isset($user) ? route('users.update',$user->id) : route('users.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              {{ isset($user) ? method_field('PUT'):'' }}
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="name"  placeholder="Enter your name" type="text" value="{{isset($user) ? $user->name : '' }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="email"  placeholder="Enter your email" type="email" value="{{isset($user) ? $user->email : '' }}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="password"  placeholder="Enter your password" type="password" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                    <select name="role"  class="form-control">
                                      <option value="">Choose Below..</option>
                                      @foreach($role as $roles)
                                      <option value="{{$roles->name}}" {{ (isset($user) && $roles->name == @$user->roles[0]->name) ? 'selected' : '' }}>{{$roles->name}}</option>
                                      @endforeach
                    </select>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">{{isset($user) ? 'Update' : 'Save' }}</button>
             
                </div>
                <!-- /.card-footer -->
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

 
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
@if(isset($user))
{!! JsValidator::formRequest('App\Http\Requests\Admin\User\UpdateUserRequest','#user-add-edit') !!}
@else
{!! JsValidator::formRequest('App\Http\Requests\Admin\User\StoreUserRequest','#user-add-edit') !!}
@endif

@endsection
