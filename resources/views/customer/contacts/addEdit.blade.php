@extends('customer.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Contacts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a  class="btn btn-primary" href="{{ route('customer-contacts.index') }}">View Contacts</a></li> 
              
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
                <h3 class="card-title">{{isset($contact) ? 'Update # '.$contact->id : 'Add New' }} </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form class="form-horizontal" id="user-add-edit" action="{{isset($contact) ? route('customer-contacts.update',$contact->id) : route('customer-contacts.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              {{ isset($contact) ? method_field('PUT'):'' }}
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="first_name"  placeholder="Enter your first name" type="text" value="{{isset($contact) ? $contact->first_name : '' }}">
                    </div>
                  </div>
             
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="last_name"  placeholder="Enter your last name" type="text" value="{{isset($contact) ? $contact->last_name : '' }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="email"  placeholder="Enter your email" type="email" value="{{isset($contact) ? $contact->email : '' }}">
                    </div>
                  </div>  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="phone"  placeholder="Enter your phone" type="number" value="{{isset($contact) ? $contact->phone : '' }}">
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                   <textarea name="address" class="form-control" id="" cols="30" rows="10">
                   {{isset($contact) ? $contact->address : '' }}
                   </textarea>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">{{isset($contact) ? 'Update' : 'Save' }}</button>
             
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
{!! JsValidator::formRequest('App\Http\Requests\Admin\Contact\UpdateContactRequest','#user-add-edit') !!}
@else
{!! JsValidator::formRequest('App\Http\Requests\Admin\Contact\StoreContactRequest','#user-add-edit') !!}
@endif

@endsection
