@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student</li>
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
                  Update Student
                  <a href="{{route('students.registration.view')}}" class="btn btn-success float-right"><i class="fas fa-list mr-1"></i> Student List </a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('students.registration.update',$data->student_id)}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf 
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="form-row">
                        
                        <div class="form-group col-md-4">
                            <label for="name">Student Name <font style="color:red">*</font> </label>
                            <input type="text" id="name" name="name" class="form-control form-control-sm" value="{{$data->student->name}}">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fname">Father's Name <font style="color:red">*</font> </label>
                            <input type="text" id="fname" name="fname" class="form-control form-control-sm" value="{{$data->student->fname}}">
                            @error('fname')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mname">Mother's Name <font style="color:red">*</font> </label>
                            <input type="text" id="mname" name="mname" class="form-control form-control-sm" value="{{$data->student->mname}}">
                            @error('mname')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mobile">Mobile Number <font style="color:red">*</font> </label>
                            <input type="text" id="mobile" name="mobile" class="form-control form-control-sm" value="{{$data->student->mobile}}">
                            @error('mobile')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="address">Address <font style="color:red">*</font> </label>
                            <input type="text" id="address" name="address" class="form-control form-control-sm" value="{{$data->student->address}}">
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="gender">Gender <font style="color:red">*</font> </label>
                            <select name="gender"  id="gender" class="form-control form-control-sm">
                                <option value="">Select Gender</option>
                                <option value="Male" {{$data->student->gender=='Male'?"selected":""}}>Male</option>
                                <option value="Female" {{$data->student->gender=='Female'?"selected":""}}>Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="religion">Religion <font style="color:red">*</font> </label>
                            <select name="religion"  id="religion" class="form-control form-control-sm">
                                <option value="">Select Religion</option>
                                <option value="Islam" {{$data->student->religion=='Islam'?"selected":""}}>Islam</option>
                                <option value="Hindu" {{$data->student->religion=='Hindu'?"selected":""}}>Hindu</option>
                                <option value="Khistan" {{$data->student->religion=='Khistan'?"selected":""}}>Khistan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="dob">Date of Birth <font style="color:red">*</font> </label>
                            <input type="text" id="dob" name="dob" class="form-control form-control-sm singledatepicker"  autocomplete="off">
                            @error('dob')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="discount">Discount <font style="color:red">*</font> </label>
                            <input type="text" id="discount" name="discount" class="form-control form-control-sm" value="{{$data->discount->discount}}">
                            @error('discount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="years">Year <font style="color:red">*</font> </label>
                            <select name="year_id"  id="years" class="form-control form-control-sm">
                                <option value="">Select Year</option>
                                @foreach($year as $years)
                                <option value="{{$years->id}}" {{$data->studentYear->id==$years->id?"selected":""}}>{{$years->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="group">Group</label>
                            <select name="group_id"  id="group" class="form-control form-control-sm">
                                <option value="">Select Group</option>
                                @foreach($group as $groups)
                                <option value="{{$groups->id}}" {{$data->group->id==$groups->id?"selected":""}}>{{$groups->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="class">Class <font style="color:red">*</font> </label>
                            <select name="class_id"  id="classes" class="form-control form-control-sm">
                                <option value="">Select Class</option>
                                @foreach($class as $classes)
                                <option value="{{$classes->id}}" {{$data->studentClass->id==$classes->id?"selected":""}}>{{$classes->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="shift">Shift</label>
                            <select name="shift_id"  id="shift" class="form-control form-control-sm">
                                <option value="">Select Shift</option>
                                @foreach($shift as $shifts)
                                <option value="{{$shifts->id}}" {{$data->studentShift->id==$shifts->id?"selected":""}}>{{$shifts->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="image">Image <font style="color:red">*</font> </label>
                            <input type="file" name="image" id="image" class="form-control form-control-sm">
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                           <img id="showImage" src="{{(!empty($data->student->image))?url('public/upload/student_images/'.$data->student->image):url('public/upload/noimage.jpg')}}" alt="" style="width:100px; height:100px; border:1px solid #000">
                            
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
      discount: {
        required: true,
        number: true,
      },
      year_id: {
        required: true,
      },
      class_id: {
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
      Mobile: {
        required: "Please Provide Your Mobile Number",
        
        number: "Please Provide a Valid Digit",
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
      discount: {
        required: "Please Provide Your Discount",
      },
      year_id: {
        required: "Please Provide Your Year",
      },
     class_id: {
        required: "Please Provide Your Class",
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
@endsection