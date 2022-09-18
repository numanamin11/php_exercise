@extends('layouts.app')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="container-fluid px-4">
   <h1 class="mt-4">View Stocks</h1>
   <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Back</a></li>
   </ol>
   @if ($message = Session::get('success'))
   <div class="alert alert-success alert-block">
      <strong>{{ $message }}</strong>
   </div>
   @endif
   <div class="card mb-4">
      <div class="card-body">
         <div id = "container" ></div>
      </div>
   </div>
   <div class="card mb-4">
      <div class="card-header">
         <i class="fas fa-table me-1"></i>
         Stock Prices
      </div>
      <div class="card-body">
         <table id="data_view">
            <thead>
               <tr>
                  <th>Date</th>
                  <th>Open</th>
                  <th>High</th>
                  <th>Low</th>
                  <th>Close</th>
                  <th>Volume</th>
               </tr>
            </thead>
         </table>
      </div>
   </div>
</div>
@endsection
@section("scripts")
<script src = "https://code.highcharts.com/highcharts.js"></script> 
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
   $(document).ready(function() {
    var datajs='{!! json_encode($data) !!}';
    
    datajs=JSON.parse(datajs);
    
       var title = {
          text: 'Stock Prices'   
       };
      
       var xAxis = {
          categories:datajs.dates
       };
       var yAxis = {
          title: {
             text: 'Prices'
          },
          plotLines: [{
             value: 0,
             width: 1,
             color: '#808080'
          }]
       };   
       var legend = {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle',
          borderWidth: 0
       };
       var series =  [{
             name: 'open',
             data:datajs.open
          }, 
          {
             name: 'close',
             data: datajs.close
          }
       ];
       var json = {};
       json.title = title;
       json.xAxis = xAxis;
       json.yAxis = yAxis;
       json.legend = legend;
       json.series = series;
       $('#container').highcharts(json);
       console.log(datajs.all_data);
       $('#data_view').DataTable( {
         data:datajs.all_data,
         columns: [
           { data: 'date' },
           { data: 'open' },
           { data: 'high' },
           { data: 'low' },
           { data:'close'},
           { data:'volume'}
       ]
    });
    });
</script>
@endsection