
@extends('customer.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header HeaderSet">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="https://upchat.io/" target="_blank">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li> -->
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
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row BottomSpace threebox">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$leads }}</h3>

                <p>All Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{route('customer-leads.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- <div class="col-lg-4 col-6">

            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$contact}}</h3>

                <p>All Contacts</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{route('contacts.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$serviceTicket}}</h3>

                <p>All Service Tickets</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{route('customer-service-tickets.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">

          <div id="container"></div>


            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">



          <div class="vaild_invaild">
              <div class="vaild_invaild_inner">
                  <div class="vaild">Sales <span class="bluecolor">&nbsp;</span></div>
                <div class="invaild">Service <span class="greycolor">&nbsp;</span></div>
                <div class="invaild">Other <span class="grencolor" >&nbsp;</span></div>

              </div>
              <div id="pie-chart"></div>
            </div>



          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 @endsection
 @section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
$(document).ready(function () {
  $.ajaxSetup({
  headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
  });

function chart(){
  $.ajax({
        type: "POST",
        url: "{{route('customerAjaxDashboard')}}",
        data: {
            interval: $('#reportrange span').text(),
        },

        success: function(data) {

        loadChart(data)
        },

    });
}
chart();

// $('#interval').on('change', function() {
//             chart();
//         });



function barChart(){
  $.ajax({
        type: "POST",
        url: "{{route('customerAjaxBar')}}",
        data: {
            interval: $('#reportrange span').text(),
        },

        success: function(data) {

          loadBarChart(data)
        },

    });
}
barChart();
$('#dateSearch').on('click', function() {
           barChart();
           chart();
 });
});
function loadChart(data) {
const obj = JSON.parse(data);


  chart = new Highcharts.chart('pie-chart', {

        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Leads Data'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',

                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y} '
                }
            }
        },
        series: [{
            name: 'Lead',
            colorByPoint: true,
            data: obj
        }]
    });
}
function loadBarChart(data) {

const success=JSON.parse(data);;
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Leads'
    },

    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Leads'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Leads: <b>{point.y} Leads</b>'
    },
    series: [{
        name: 'Leads',
        data: success,
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
}
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
