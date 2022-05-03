@extends('customer.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ServiceTicket</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a  class="btn btn-primary" href="{{ route('customer-service-tickets.index') }}">View Services</a></li> 
              
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
                <h3 class="card-title">{{isset($serviceTicket) ? 'Update # '.$serviceTicket->id : 'Add New' }} </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form class="form-horizontal" id="user-add-edit" action="{{isset($serviceTicket) ? route('customer-service-tickets.update',$serviceTicket->id) : route('customer-service-tickets.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              {{ isset($serviceTicket) ? method_field('PUT'):'' }}
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ticket Number</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="ticket_number"  placeholder="Enter your ticket number" type="text" value="{{isset($serviceTicket) ? $serviceTicket->ticket_number : '' }}">
                    </div>
                  </div>
             
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                    <select name="status" class= "form-control">
                      <option value="">Select Below</option>
                      <option value="Opened"{{(isset($serviceTicket) && $serviceTicket->status == 'Opened')  ? 'Selected' : '' }} >Opened</option>
                      <option value="Closed"{{(isset($serviceTicket) && $serviceTicket->status == 'Closed')  ? 'Selected' : '' }}>Closed</option>
                    </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Group Name</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="group_name"  placeholder="Enter your group name" type="text" value="{{isset($serviceTicket) ? $serviceTicket->group_name : '' }}">
                    </div>
                  </div>  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">User</label>
                    <div class="col-sm-10">
                    <input class="form-control" name="user"  placeholder="Enter your name" type="text" value="{{isset($serviceTicket) ? $serviceTicket->user : '' }}">
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                   <input type="email" name="email" id="" class="form-control" placeholder="Enter your email"value="{{isset($serviceTicket) ? $serviceTicket->email : '' }}" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Subjected</label>
                    <div class="col-sm-10">
                   <input type="text" name="subject" id="" class="form-control" placeholder="Enter your subject"value="{{isset($serviceTicket) ? $serviceTicket->subject : '' }}" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sites</label>
                    <div class="col-sm-10">
                   <input type="text" name="sites"  class="form-control" placeholder="Enter your sites"value="{{isset($serviceTicket) ? $serviceTicket->sites : '' }}" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                 <textarea name="description" id="" cols="30" class="form-control" rows="10">{{isset($serviceTicket) ? $serviceTicket->description : '' }}</textarea>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">{{isset($serviceTicket) ? 'Update' : 'Save' }}</button>
             
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
@if(isset($serviceTicket))
{!! JsValidator::formRequest('App\Http\Requests\Admin\ServiceTicket\UpdateServiceTicketRequest','#user-add-edit') !!}
@else
{!! JsValidator::formRequest('App\Http\Requests\Admin\ServiceTicket\StoreServiceTicketRequest','#user-add-edit') !!}
@endif

@endsection

