@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Monthly/Yearly Profit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Monthly/Yearly Profit</li>
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
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header bg-primary">
                <h3>
                  <i class="fas fa-users mr-1"></i>
                  Select Criteria
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-4">
                            <label for="date">Start Date <font style="color:red">*</font> </label>
                            <input type="text" id="start_date" name="start_date" class="form-control form-control-sm singledatepicker" placeholder="Enter Your Join Date" autocomplete="off" autofill="off">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="date">End Date <font style="color:red">*</font> </label>
                            <input type="text" id="end_date" name="end_date" class="form-control form-control-sm singledatepicker" placeholder="Enter Your Join Date" autocomplete="off" autofill="off">
                           
                        </div>
                        <div class="form-group col-md-4" style="padding-top:32px">
                                <a  id="search" class="btn btn-primary btn-sm" name="search">Search</a>
                            </div>
                </div>
              </div><!-- /.card-body -->
              <div class="card-body">
                  <div id="DocumentResults"></div>
                  <script id="document-template" type="text/x-handlebars-template">
                            <table class="table-sm table-bodered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        @{{{thsource}}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @{{{tdsource}}}
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-sm btn-success" style="margin-top:10px">Submit</button>
                  </script>

              </div>
            </div>
          </section>
          <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <script type="text/javascript">
     $(document).on('click','#search',function(){

         var start_date = $('#start_date').val();
         var end_date = $('#end_date').val();

         $('.notifyjs-corner').html('');
         if(start_date == ''){
             //$(.notify("Start Date Required", {globslPosition: 'top right',className: 'error'}));
            $.notify("Please Select Start Date!", {color: "#fff", background: "#D44950"});
             return false;
         }
         if(end_date == ''){
             //$(.notify("End Date Required", {globslPosition: 'top right',className: 'error'}));
            $.notify("Please Select End Date!", {color: "#fff", background: "#D44950"});
             return false;
         }

         $.ajax({
             url: "{{route('report.profit.datewise.get')}}",
             type: "GET",
             data: {'start_date':start_date,'end_date':end_date},
             beforeSend: function(){


             },
             success:function(data){
                 var source = $("#document-template").html();
                 var template = Handlebars.compile(source);
                 var html = template(data);
                 $('#DocumentResults').html(html);
                 $('[data-toggle="tooltip"]').tooltip();

             }
         });
     });
  </script>
  <!-- Datepicker -->
<script>
$(function() {
  $('input[name="start_date"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10)
  }, function(start, end, label) {
    var years = moment().diff(start, 'years');
  });
});
$(function() {
  $('input[name="end_date"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10)
  }, function(start, end, label) {
    var years = moment().diff(start, 'years');
  });
});
</script>
@endsection