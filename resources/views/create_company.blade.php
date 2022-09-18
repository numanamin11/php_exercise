@extends('layouts.app')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection
@section('content')
<div class="container-fluid px-4">
   <h1 class="mt-4">Add Details</h1>
   @if ($message = Session::get('success'))
   <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
      <strong>{{ $message }}</strong>
   </div>
   @endif
   <div class="card mb-4">
      <div class="card-body">
         <form class="validate-form" id="company_form" method="post" action="{{ route('store_company') }}">
            @csrf
            <div class="form-group mt-2">
               <label for="symbol">Company Symbol*</label>
               <select class="form-control symbol_select @error('symbol') is-invalid @enderror" name="symbol" id="symbol" required >
                  <option value="">Select Symbol </option>
                  @foreach($symbols['symbols_all'] as $index => $value)
                  <option value="{{ $value['Symbol']}}" {{ (old('symbol') ==  $value['Symbol'] ? 'selected' : null) }} >
                  {{ $value['Symbol']. '-' .$value['Company Name']}} {{ (old('symbol') ==  $value['Symbol'] ?? 'selected') }}
                  </option>
                  @endforeach
               </select>
               @error('symbol')
               <div class="alert alert-danger mt-2">{{ $message }}</div>
               @enderror
            </div>
            <div class="form-group mt-2">
               <label for="start-date">Start Date*</label>
               <input type="text" id="start-date" name="start_date" class="form-control datepicker @error('start_date') is-invalid @enderror" placeholder="Enter start date" required value="{{ old('start_date') }}" autocomplete="off" />
               @error('start_date')
               <div class="alert alert-danger mt-2">{{ $message }}</div>
               @enderror
            </div>
            <div class="form-group mt-2">
               <label for="end-date">End Date*</label>
               <input type="text" id="end-date" name="end_date" class="form-control datepicker" placeholder="Enter end date"  value="{{ old('end_date') }}" autocomplete="off" required />
               @error('end_date')
               <div class="alert alert-danger mt-2">{{ $message }}</div>
               @enderror
            </div>
            <div class="form-group mt-2">
               <label for="email">Email*</label>
               <input type="email" id="email" name="email" class="form-control" placeholder="Enter email address"   value="{{ old('email') }}" required />
               @error('email')
               <div class="alert alert-danger mt-2">{{ $message }}</div>
               @enderror
            </div>
            <button name="submit" type="submit" class="btn btn-primary mt-2">Submit</button>
         </form>
      </div>
   </div>
</div>
@endsection
@section("scripts")
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>  
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
       $('.symbol_select').select2({
           "width":"100%",
       });
       $("#start-date").datepicker({
       dateFormat: 'yy-mm-dd',
       onSelect: function (selected) {
           var dt = new Date(selected);
           dt.setDate(dt.getDate() + 1);
           $("#end-date").datepicker("option", "minDate", dt);
       }
   });
   $("#end-date").datepicker({
       dateFormat: 'yy-mm-dd',
       onSelect: function (selected) {
           var dt = new Date(selected);
           dt.setDate(dt.getDate() - 1);
           $("#start-date").datepicker("option", "maxDate", dt);
       }
   });

    $("#company_form").validate();
   
   });
</script>
@endsection