@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Company</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item active"><a class="btn btn-primary" href="{{ route('company.create') }}" >Add Company</a></li> -->

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
                <h3 class="card-title">Company Listing</h3>
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
                          <button type="button" id="dateSearch" class="btn btn-sm btn-primary">Filter</button>
                      </div>
                   </div>
                <table id="datatable" class="table table-bordered table-hover">
                  <thead>
                  <tr>


                    <th>UserName</th>
                    <th>CompanyName</th>
                    <th>Company UserName</th>
                    <th>Company Password</th>
                    <th>Status</th>
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


@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function () {

      var Table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('company.index') }}",
                    data: function(d) {
                        d.timeInterval = $('#reportrange span').text();
                    }
                    },
            columns: [

              {data: 'users.name', name: 'users.name'},
              {data: 'apex_company', name: 'apex_company'},
              {data: 'apex_username', name: 'apex_username'},
              {data: 'apex_password', name: 'apex_password'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
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