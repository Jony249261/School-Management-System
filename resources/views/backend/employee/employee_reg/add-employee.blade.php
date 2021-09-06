@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Employee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee</li>
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
                  Add Employee
                  <a href="{{route('employee.registration.view')}}" class="btn btn-success float-right"><i class="fas fa-list mr-1"></i> Employee List </a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('employee.registration.store')}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf 
                    <div class="form-row">
                        
                        <div class="form-group col-md-4">
                            <label for="name">Employee Name <font style="color:red">*</font> </label>
                            <input type="text" id="name" name="name" class="form-control form-control-sm" placeholder="Enter Student Name">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fname">Father's Name <font style="color:red">*</font> </label>
                            <input type="text" id="fname" name="fname" class="form-control form-control-sm" placeholder="Enter Your Father's Name">
                            @error('fname')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mname">Mother's Name <font style="color:red">*</font> </label>
                            <input type="text" id="mname" name="mname" class="form-control form-control-sm" placeholder="Enter Your Mother's Name">
                            @error('mname')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mobile">Mobile Number <font style="color:red">*</font> </label>
                            <input type="text" id="mobile" name="mobile" class="form-control form-control-sm" placeholder="Enter Your Mobile Number">
                            @error('mobile')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="address">Address <font style="color:red">*</font> </label>
                            <input type="text" id="address" name="address" class="form-control form-control-sm" placeholder="Enter Your Address">
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="gender">Gender <font style="color:red">*</font> </label>
                            <select name="gender"  id="gender" class="form-control form-control-sm">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="religion">Religion <font style="color:red">*</font> </label>
                            <select name="religion"  id="religion" class="form-control form-control-sm">
                                <option value="">Select Religion</option>
                                <option value="Islam">Islam</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Khistan">Khistan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="dob">Date of Birth <font style="color:red">*</font> </label>
                            <input type="text" id="dob" name="dob" class="form-control form-control-sm singledatepicker" placeholder="Enter Your Date of Birth Number">
                            @error('dob')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="join_date">Join Date <font style="color:red">*</font> </label>
                            <input type="text" id="join_date" name="join_date" class="form-control form-control-sm singledatepicker" placeholder="Enter Your Join Date" autocomplete="off">
                            @error('join_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="dob">Salary <font style="color:red">*</font> </label>
                            <input type="text" id="salary" name="salary" class="form-control form-control-sm singledatepicker" placeholder="Enter Your Salary">
                            @error('salary')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="group">Designation</label>
                            <select name="designation_id"  id="designation_id" class="form-control form-control-sm">
                                <option value="">Select Designation</option>
                                @foreach($designation as $designations)
                                <option value="{{$designations->id}}">{{$designations->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="image">Image <font style="color:red">*</font> </label>
                            <input type="file" name="image" id="image" class="form-control form-control-sm">
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                           <img id="showImage" src="{{url('public/upload/noimage.jpg')}}" alt="" style="width:100px; height:100px; border:1px solid #000">
                            
                        </div> 
                        <div class="form-group col-md-12">
                            <input type="submit"  class="btn btn-primary btn-sm" >
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

<!-- Validation -->
<script>
$(function () {
  $('#myForm').validate({
    rules: {
      name: {
        required: true,
      },
      fname: {
        required: true,
      },
      mname: {
        required: true,
      },
      address: {
        required: true,
      },
      mobile: {
        required: true,
        number: true,
      },
      gender: {
        required: true,
      },
      religion: {
        required: true,
      },
      dob: {
        required: true,
      },
      join_date: {
        required: true,
      },
      salary: {
        required: true,
        number: true,
      },
      designation_id: {
        required: true,
      },
      image: {
        required: true,
      },
      
    },
    messages: {
      
      name: {
        required: "Please Provide Your Name",
      },
      fname: {
        required: "Please Provide Your Father's Name",
      },
      mname: {
        required: "Please Provide Your Mother's Name",
      },
      address: {
        required: "Please Provide Your Address",
      },
      mobile: {
        required: "Please Provide Your Mobile Number",
        number: "Please Provide a Digit Year",
      },
      gender: {
        required: "Please Provide Your Gender",
      },
      religion: {
        required: "Please Provide Your Religion",
      },
      dob: {
        required: "Please Provide Your Date Of Birth",
      },
      dob: {
        required: "Please Provide Your Date Of Join",
      },
      salary: {
        required: "Please Provide Your Salary",
        number: "Please Provide a Valid Digit",
      },
      designation_id: {
        required: "Please Select Your Designation",
      },
     image: {
        required: "Please Provide Your Image",
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
  $('input[name="dob"]').daterangepicker({
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
  $('input[name="join_date"]').daterangepicker({
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