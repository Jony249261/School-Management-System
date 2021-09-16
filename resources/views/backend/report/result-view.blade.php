@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Result</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Result</li>
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
                  <form id="myForm" method="get" action="{{route('report.result.get')}}">
                      @csrf
                        <div class="form-row">
                        
                            <div class="form-group col-md-3">
                                <label for="year_id">Year <font style="color:red">*</font> </label>
                                <select name="year_id"  id="year_id" class="form-control form-control-sm">
                                    <option value="">Select Year</option>
                                    @foreach($years as $year)
                                    <option value="{{$year->id}}">{{$year->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="class_id">Class <font style="color:red">*</font> </label>
                                <select name="class_id"  id="class_id" class="form-control form-control-sm">
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="class_id">Exam Type <font style="color:red">*</font> </label>
                                <select name="exam_id"  id="exam_id" class="form-control form-control-sm">
                                    <option value="">Select Exam Type</option>
                                    @foreach($exams as $exam)
                                    <option value="{{$exam->id}}">{{$exam->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3" style="padding-top:32px">
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
      class_id: {
        required: true,
      },
      year_id: {
        required: true,
      },
      exam_id: {
        required: true,
      },
      id_no: {
        required: true,
        number: true,
      },
      
      
    },
    messages: {
      class_id: {
        required: "Please Select Class",
      },
      year_id: {
        required: "Please Select Year",
      },
      exam_id: {
        required: "Please Select Exam Type",
      },
      id_no: {
        required: "Please Enter Student Id",
        Number: "Please Enter Valid Student Id",
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
@endsection