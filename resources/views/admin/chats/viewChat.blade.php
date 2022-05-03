@extends('admin.layouts.app')

@section('content')

 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Chat Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Chat Details</li>
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
                    <i class="fas fa-globe"></i> 
                    <small class="float-right">Created Date: {{$chat->created_at}}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <b>Picked Up On: </b> {{$chat->pickedUpOn}}<br>
                  <b>Ended: </b> {{$chat->endedOn}}<br>
                  <b>Referrer:</b><input type="text" class="form-control" value="{{$chat->referrer}}"readOnly> <br>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                 
                
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Location: </b> {{$chat->location}}<br>
                  <b>IP Address:</b> {{$chat->ipAddress}} <br>
                 
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
                      <th>Name</th>
                      <th>Message</th>

                     
                    </tr>
                    </thead>
                    <tbody>
                    @if($chatReply->count())
                      @foreach($chatReply as $chats)
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

