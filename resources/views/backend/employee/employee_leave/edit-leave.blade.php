@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Employee Leave</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee Leave</li>
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
                  <i class="fas fa-user-circle mr-1"></i>
                  Edit Employee Leave
                  <a href="{{route('employee.leave.view')}}" class="btn btn-success float-right"><i class="fas fa-list mr-1"></i> Leave List </a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('employee.leave.update',$data->id)}}" method="post" id="myForm">
                    @csrf 
                    <div class="form-row">
                        
                        <div class="form-group col-md-3">
                            <label for="employee_id">Employee Name <font style="color:red">*</font></label>
                            <select name="employee_id"  id="employee_id" class="form-control form-control-sm">
                                <option value="">Select Employee</option>
                                @foreach($employees as $employee)
                                <option value="{{$employee->id}}" {{$employee->id==$data->employee_id?"selected":""}}>{{$employee->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="leave_purpose_id">Leave Purpose <font style="color:red">*</font></label>
                            <select name="leave_purpose_id"  id="leave_purpose_id" class="form-control form-control-sm">
                                <option value="">Select Purpose</option>
                                @foreach($leaves as $leave)
                                <option value="{{$leave->id}}" {{$leave->id==$data->leave_purpose_id?"selected":""}}>{{$leave->name}}</option>
                                @endforeach
                                <option value="0">New Purpose</option>
                            </select>
                            <input type="text" id="add_others" style="display:none; margin-top:10px" name="name" class="form-control form-control-sm" placeholder="Write Your Purpose">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="join_date">Start Date <font style="color:red">*</font> </label>
                            <input type="text" id="join_date" name="start_date" class="form-control form-control-sm singledatepicker" placeholder="Enter Your Join Date" autocomplete="off" value="{{date('m-d-Y',strtotime($data->start_date))}}">
                            @error('start_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="join_date">End Date <font style="color:red">*</font> </label>
                            <input type="text" id="join_date" name="end_date" class="form-control form-control-sm singledatepicker" placeholder="Enter Your Join Date" autocomplete="off" value="{{date('m-d-Y',strtotime($data->end_date))}}">
                            @error('end_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit"  class="btn btn-primary" >
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
      name: {
        required: true,
      },
    },
    messages: {
      
      name: {
        required: "Please Provide Group Name",
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
</script>


<script>
    $(document).ready(function(){
        $(document).on('change','#leave_purpose_id',function(){
            var leave_purpose_id = $(this).val();
            if(leave_purpose_id == '0'){
                $('#add_others').show();
            }else{
                $('#add_others').hide();
            }
        });
    });
</script>
@endsection