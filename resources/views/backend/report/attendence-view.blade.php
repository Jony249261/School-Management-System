@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Employee Attendence</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">MarkShett</li>
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
                  <form id="myForm" method="get" action="{{route('report.attendence.get')}}">
                      @csrf
                        <div class="form-row">
                        
                            <div class="form-group col-md-4">
                                <label for="year_id">Employee <font style="color:red">*</font> </label>
                                <select name="employee_id"  id="employee_id" class="form-control form-control-sm">
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                            <label for="date">Date <font style="color:red">*</font> </label>
                            <input type="text" id="start_date" name="date" class="form-control form-control-sm singledatepicker"autocomplete="off" autofill="off">
                            </div>
                            <div class="form-group col-md-4" style="padding-top:32px">
                                <button  type="submit" class="btn btn-primary btn-sm" name="search">Search</button>
                                
                            </div>
                            
                            
                        </div>
                            
                        
                </form>

              </div><!-- /.card-body -->
              
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

<script>
$(document).ready(function () {
  $('#myForm').validate({
    rules: {
      employee_id: {
        required: true,
      },
      
      
    },
    messages: {
      employee_id: {
        required: "Please Select Employee",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>

  <!-- Datepicker -->
<script>
$(function() {
  $('input[name="date"]').daterangepicker({
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