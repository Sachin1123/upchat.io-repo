@extends('customer.layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Reports</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content ReportsForm ">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Reports</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form class="form-horizontal" id="user-add-edit" action="#" method="POST" enctype="multipart/form-data">
              @csrf
              <!-- <h4>Reports</h4> -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group">
                          <label for="inputEmail3" class="col-form-label">Sites: </label>
                          <select name="company_name" id="company_name" class= "form-control">
                            @if(isset($lead))
                            <option value="all_lead">All Leads</option>
                            @foreach($lead as $leads)
                            <option value="{{$leads->companyName}}"> {{$leads->companyName}}</option>
                            @endforeach
                            @endif
                          </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group">
                        <label for="inputEmail3" class="col-form-label">Date and time range:</label>
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
                  </div>

                  <div class="row TopSpace">
                      <div class="col-6 form-group">
                        <div class="input-group">
                            <div class="input-group input-group-sm">
                              <input type="text" value="Click Here For Csv Download" readOnly class="form-control DownloadInput">
                              <span class="input-group-append DownloadSelect">
                                <button type="button" class="btn btn-info btn-flat" id="csvDownload">Download</button>
                              </span>
                          </div>
                      </div>
                      </div>

                      <div class="col-6 form-group">
                      <div class="input-group">
                          <div class="input-group input-group-sm">
                            <input type="text" value="Click Here For Pdf Download" readOnly class="form-control DownloadInput">
                            <span class="input-group-append DownloadSelect">
                              <button type="button" class="btn btn-info btn-flat" id="pdfDownload">Download</button>
                            </span>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->

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

<script>
  $(document).ready(function () {
      $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      });
      $("#csvDownload").click(function(e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "{{route('customer-reports.store')}}",
        data: {
            date_range: $('#reportrange span').text(),
            sites: $('#company_name').children("option:selected").val(),
        },
        cache: false,
        xhrFields:{
            responseType: 'blob'
        },
        success: function(data) {
          var link = document.createElement('a');
          link.href = window.URL.createObjectURL(data);
          link.download = `ExportLead.csv`;
          link.click();
        },

    });
});


$("#pdfDownload").click(function(e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "{{route('customerPdfDownload')}}",
        data: {
            date_range: $('#reportrange span').text(),
            sites: $('#company_name').children("option:selected").val(),
        },
        cache: false,
        xhrFields:{
            responseType: 'blob'
        },
        success: function(data) {
          console.log(data);
          var link = document.createElement('a');
          link.href = window.URL.createObjectURL(data);
          link.download = `ExportLead.pdf`;
          link.click();
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
</script>

@endsection