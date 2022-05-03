@extends('customer.layouts.app')

@section('content')
<style>
  .adjust{left: -28px !important;}
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Leads</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item active"><a class="btn btn-primary" href="{{ route('users.create') }}" >Add User</a></li> -->

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
                <h3 class="card-title">Leads Listing</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <div class="form-group" >
                      <div class="input-group ">
                        <div id="reportrange" style="display:none" ><span></span></div>
                          <button type="button" class="btn btn-default float-right" id="daterange-btn">
                          <i class="far fa-calendar-alt"></i>
                          <div class="staticDays">Last 30 days</div>
                          <div id="dynamicDate" ></div>
                          <i class="fas fa-caret-down"></i>
                          </button>
                          <select name="companies" class="form-control" id="companies" style="max-width: 225px;">
                            <option value="">All</option>
                            @if(!empty($company))
                              @foreach($company as $companies)
                              <option value="{{$companies['companyName']}}">{{$companies['companyName']}}</option>
                              @endforeach
                            @endif
                          </select>
                          <button type="button" id="dateSearch" class="btn btn-sm btn-primary">Filter</button>
                      </div>
                   </div>






                <table id="datatable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                  <th>Date/Time</th>

                    <th>Name</th>
                    <th>Lead Type</th>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>View</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>

                  </tbody>

                </table>
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
    <div class="modal fade" id="edit-model">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Mark Lead As Invalid</h4>

            </div>
            <div class="modal-body">

            <form class="form-horizontal" id="updatelead" action="{{route('customerInvalidStatus')}}" method="POST" enctype="multipart/form-data">
              @csrf

                <div class="card-body">

                  <input type="hidden" name="lead_id" id="lead_id">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Reason For Rejection</label>
                    <div class="col-sm-10">
                      <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" value="out_of_geographic_area" id="customRadio1" name="rejectReason" >
                      <label for="customRadio1" class="custom-control-label">Out Of Geographic Area</label>
                      </div>
                      <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" value="out_of_practice_area" id="customRadio2" name="rejectReason">
                      <label for="customRadio2" class="custom-control-label">Out Of Practice Area</label>
                      </div>
                      <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" value="existing_client" id="customRadio3" name="rejectReason"  >
                      <label for="customRadio3" class="custom-control-label">Existing Contact Or Client</label>
                      </div>
                      <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" value="spam" id="customRadio4" name="rejectReason" >
                      <label for="customRadio4" class="custom-control-label">Spam</label>
                      </div>
                      <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" value="other" id="other" name="rejectReason" >
                      <label for="other" class="custom-control-label">Other</label>

                      </div>
                    </div>
                    <div class="form-group row" id="invalid_reason">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Other Reason</label>
                      <div class="col-sm-10">
                      <textarea name="invalid_reason" class="form-control"   cols="30" rows="10"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                  <button type="submit" class="btn btn-info">Save</button>

                </div>
                <!-- /.card-footer -->
              </form>


            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function () {
        $("#invalid_reason").hide();

        $("input[name=rejectReason]").bind("change",function() {
          var checkValue = $('input[name=rejectReason]:checked').val()
          if(checkValue == "other"){
            $("#invalid_reason").show();

          }else{
            $("#invalid_reason").hide();
          }
          });
        var Table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                    url: "{{ route('customer-leads.index') }}",
                        data: function(d) {
                            d.timeInterval = $('#reportrange span').text();
                            d.companies = $("#companies option:selected").val();
                        }
                    },
            columns: [
              {data: 'created_at', name: 'created_at'},
              {data: 'name', name: 'name'},
              {data: 'lead_type', name: 'lead_type'},
              {data: 'companyName', name: 'companyName'},
              {data: 'email', name: 'email'},
              {data: 'phone', name: 'phone'},
              {data: 'status', name: 'status'},
              {data: 'view', name: 'view', orderable: false, searchable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });


        $('#dateSearch').on('click', function() {
            Table.draw();
        });

    });
    $(document).on("click",".resolved",function() {

    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      $.ajax({
        type: "POST",
        url: "{{route('customerChangeStatus')}}",
        data: {
            id: $(this).attr("id"),
        },
        success: function(data) {
          $('#datatable').DataTable().ajax.reload();
        },

      });

});
$(document).on("click",".edit",function() {
      $.ajax({

        url: "{{route('customerAjaxEdit')}}",
        data: {
            id: $(this).attr("id"),
        },
        success: function(data) {

          $('#edit-model').modal('show');
          $('#lead_id').val(data.id);
        },

});

});


  $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end,range) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      $('#dynamicDate').html(range)
      $('.staticDays').hide();
    }
  )
  $("#updatelead").validate({

 submitHandler: function(form) {
   var form_action = $("#updatelead").attr("action");
   $.ajax({
   data: $('#updatelead').serialize(),
   url: form_action,
   type: "POST",
   dataType: 'json',
   success: function (data) {
   console.log(data)

   $('#edit-model').modal('hide');
   $('#datatable').DataTable().ajax.reload();
   },

   });
 }
 });

</script>
@endsection