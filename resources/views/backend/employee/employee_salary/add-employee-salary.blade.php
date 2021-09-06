@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Employee Salary</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee Salary</li>
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
                  <i class="fas fa-hryvnia mr-1"></i>
                  Employee Salary Increment
                  <a href="{{route('employee.salary.view')}}" class="btn btn-success float-right"><i class="fas fa-list mr-1"></i> Employee List</a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('employee.salary.store',$data->id)}}" method="post" id="myForm">
                    @csrf 
                    <div class="form-row">
                        
                        <div class="form-group col-md-4">
                            <label for="increment_salary">Salary Amount</label>
                            <input type="text" id="increment_salary" name="increment_salary" class="form-control" placeholder="Enter Increment Salary">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                  @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="effected_date">Effected Date</label>
                            <input type="text" id="effected_date" name="effected_date" class="form-control" >
                            @error('effected_date')
                            <span class="text-danger">{{$message}}</span>
                  @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" value="Update" class="btn btn-primary" >
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
$(function () {
  $('#myForm').validate({
    rules: {
      increment_salary: {
        required: true,
        number:true,
      },
    },
    messages: {
      
      name: {
        required: "Please Provide Class Name",
        number: "Please Enter a valid Salary",
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
  $('input[name="effected_date"]').daterangepicker({
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