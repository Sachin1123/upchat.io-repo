
@extends('admin.layouts.app')

@section('content')
<style>
  .adjust{left: -28px !important;}
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Chats</h1>
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
                <h3 class="card-title">Chats Listing</h3>
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

                    <th>Id</th>
                    <th>Company Name</th>
                    <th>Company Key</th>
                    <th>Date/Time</th>
                    <th>Lead</th>
                    <th>View</th>



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

@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function () {
      $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });

        var Table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            // order: [ 0, 'desc' ],
            ajax: {
                    url: "{{ route('chats.index') }}",
                        data: function(d) {
                            d.timeInterval = $('#reportrange span').text();
                            d.companies = $("#companies option:selected").val();

                        }
                    },
            columns: [
              {data: 'chatId', name: 'chatId'},
              {data: 'companyKey', name: 'companyKey'},
              {data: 'companyName', name: 'companyName'},
              {data: 'created_at', name: 'created_at'},
              {data: 'lead_type', name: 'lead_type'},
              {data: 'view', name: 'view', orderable: false, searchable: false},


            ]
        });

        Table.draw();
        $('#dateSearch').on('click', function() {
            Table.draw();
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


</script>
@endsection