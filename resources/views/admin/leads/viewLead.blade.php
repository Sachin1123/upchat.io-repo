@extends('admin.layouts.app')

@section('content')

 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lead Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Lead Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
       


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> {{$lead->companyName}}
                    <small class="float-right">Date: {{$lead->created_at}}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
              
                  <address>
                    <strong>{{$lead->name}}</strong><br>
                    Phone: {{$lead->phone}}<br>
                    Email: {{$lead->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                 
                
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>LeadId </b>{{$lead->leadId}}<br>
              
                  <b>Domain:</b> {{$lead->domain}}<br>
                  <b>IP Address:</b> {{$lead->ipAddress}}<br>
                 
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Notes</th>
                     
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>{{$lead->reason}}</td>
                     
                    </tr>
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
       <!-- Table row -->
       <div class="row">
                <div class="col-12 table-responsive">
                  <h5>Chats Details</h5>
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>UserName</th>
                      <th>Message</th>

                     
                    </tr>
                    </thead>
                    <tbody>
                      @if($chat->count())
                      @foreach($chat as $chats)
                    <tr>
                      
                    <td>{{$chats->username}}</td>
                    <td>{{$chats->chat}}</td>
                     
                    </tr>
                    @endforeach
                   @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
          

           
            
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection

