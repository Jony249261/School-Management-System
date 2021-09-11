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
              <li class="breadcrumb-item active">Employee Attendence</li>
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
                  Add Employee Attendence
                  <a href="{{route('employee.attendence.view')}}" class="btn btn-success float-right"><i class="fas fa-list mr-1"></i> Attendence List </a>
                </h3>
              </div><!-- /.card-header -->
              <form action="{{route('employee.attendence.store')}}" method="post" id="myForm">
                    @csrf 
              <div class="card-body">
                
                    <div class="form-group col-md-4">
                             <label class="controll-lebel" for="date">Attendence Date <font style="color:red">*</font> </label>
                            <input type="text" id="date" name="date" class="form-control form-control-sm singledatepicker" placeholder="Enter Your Join Date" autocomplete="off">
                            @error('date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <table class="table-sm table-bordered table-striped dt-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center" style="vertical-align:middle">SL.</th>
                                    <th rowspan="2" class="text-center" style="vertical-align:middle">Employee Name</th>
                                    <th colspan="3" class="text-center" style="vertical-align:middle; width:25%" >Attendence Status</th>
                                </tr>
                                <tr>
                                    <th class="text-center btn present_all" style="display:table-cell;color:white; background-color:#114190">Present</th>
                                    <th class="text-center btn leave_all" style="display:table-cell;color:white; background-color:#114190">Leave</th>
                                    <th class="text-center btn absent_all" style="display:table-cell;color:white; background-color:#114190">Absent</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($employees as $key => $employee)
                                <tr id="div{{$employee->id}}" class="text-center">
                                    <input type="hidden" name="employee_id[]" value="{{$employee->id}}" class="employe_id">
                                    <td>{{$key+1}}</td>
                                    <td>{{$employee->name}}</td>
                                    <td colspan="3">
                                        <div class="switch-toogle switch-3 switch-candy">
                                            <input class="present" checked="checked" type="radio" name="attend_status{{$key}}" id="present{{$key}}" value="present" />
                                            <label for="present{{$key}}">Present</label>
                                            <input class="leave"  type="radio" name="attend_status{{$key}}" id="leave{{$key}}" value="leave" />
                                            <label for="present{{$key}}">Leave</label>
                                            <input class="absent" type="radio" name="attend_status{{$key}}" id="absent{{$key}}" value="absent" />
                                            <label for="present{{$key}}">Absent</label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                
              </div><!-- /.card-body -->
              </form>
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
      employee_id: {
        required: true,
      },
      leave_purpose_id:{
        required: true,
      }
    },
    messages: {
      
      employee_id: {
        required: "Please Select Employee Name",
      },
      leave_purpose_id: {
        required: "Please Select Leave Purpose",
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