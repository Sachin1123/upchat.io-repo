@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Leads</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a  class="btn btn-primary" href="{{ route('leads.index') }}">View Leads</a></li> 
              
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
                <h3 class="card-title">{{isset($lead) ? 'Update # '.$lead->id : 'Add New' }} </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form class="form-horizontal" id="user-add-edit" action="{{isset($lead) ? route('leads.update',$lead->id) : route('leads.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              {{ isset($lead) ? method_field('PUT'):'' }}
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="name"  placeholder="Enter your name" type="text" value="{{isset($lead) ? $lead->name : '' }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="email"  placeholder="Enter your email" type="email" value="{{isset($lead) ? $lead->email : '' }}">
                    </div>
                  </div> <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Company Name</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="companyName"  placeholder="Enter your company name" type="text" value="{{isset($lead) ? $lead->companyName : '' }}">
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Company Key</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="companyKey"  placeholder="Enter your company key" type="text" value="{{isset($lead) ? $lead->companyKey : '' }}">
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Domain</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="domain"  placeholder="Enter your domain" type="text" value="{{isset($lead) ? $lead->domain : '' }}">
                    </div>
                  </div> <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="phone"  placeholder="Enter your phone" type="number" value="{{isset($lead) ? $lead->phone : '' }}">
                    </div>
                  </div> <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">User Name</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="username"  placeholder="Enter your user name" type="text" value="{{isset($lead) ? $lead->username : '' }}">
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">IpAddress</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="ipAddress"  placeholder="Enter your ipAddress" type="text" value="{{isset($lead) ? $lead->ipAddress : '' }}">
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                    <select name="leadStatus" id="" class="form-control">
                      <option value="Valid" {{$lead->leadStatus == 'Valid'  ? 'Selected' : '' }}>Valid</option>
                      <option value="Invalid" {{$lead->leadStatus == 'Invalid'  ? 'Selected' : '' }}>Invalid</option>
                      <option value="Resolve" {{$lead->leadStatus == 'Resolve'  ? 'Selected' : '' }}>Resolve</option>
                    </select>
                    </div>
                  </div> <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Reason</label>
                    <div class="col-sm-10">
                   <textarea name="reason" class="form-control" id="" cols="30" rows="10">
                   {{isset($lead) ? $lead->reason : '' }}
                   </textarea>
                    </div>
                  </div>
                  </div> <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Reason For Rejection</label>
                    <div class="col-sm-10">
                      <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" value="out_of_geographic_area" id="customRadio1" name="rejectReason" {{$lead->rejectReason == 'out_of_geographic_area'  ? 'Checked' : '' }}>
                      <label for="customRadio1" class="custom-control-label">Out Of Geographic Area</label>
                      </div>
                      <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" value="out_of_practice_area" id="customRadio2" name="rejectReason" {{$lead->rejectReason == 'out_of_practice_area'  ? 'Checked' : '' }}>
                      <label for="customRadio2" class="custom-control-label">Out Of Practice Area</label>
                      </div>
                      <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" value="existing_client" id="customRadio3" name="rejectReason" {{$lead->rejectReason == 'existing_client'  ? 'Checked' : '' }} >
                      <label for="customRadio3" class="custom-control-label">Existing Contact Or Client</label>
                      </div>
                      <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" value="spam" id="customRadio4" name="rejectReason" {{$lead->rejectReason == 'spam'  ? 'Checked' : '' }}>
                      <label for="customRadio4" class="custom-control-label">Spam</label>
                      </div>
                      <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" value="other" id="customRadio5" name="rejectReason" {{$lead->rejectReason == 'other'  ? 'Checked' : '' }}>
                      <label for="customRadio5" class="custom-control-label">Other</label>
                      </div>                
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">{{isset($lead) ? 'Update' : 'Save' }}</button>
             
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
<!-- {!! JsValidator::formRequest('App\Http\Requests\Admin\User\UpdateLeadRequest','#user-add-edit') !!} -->
@else
<!-- {!! JsValidator::formRequest('App\Http\Requests\Admin\User\StoreUserRequest','#user-add-edit') !!} -->
@endif

@endsection
