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
                  <i class="fas fa-users mr-1"></i>
                  Student List
                  <a href="{{route('students.registration.add')}}" class="btn btn-success float-right"><i class="fas fa-plus-circle mr-1"></i> Add Student</a>
                </h3>
              </div><!-- /.card-header -->

              <div class="card-body">
                  <form id="myForm" method="GET" action="{{route('students.registration.seach')}}">
                    <div class="form-row">
                    
                    <div class="form-group col-md-4">
                        <label for="years">Year <font style="color:red">*</font> </label>
                        <select name="year_id"  id="years" class="form-control form-control-sm">
                            <option value="">Select Year</option>
                            @foreach($year as $years)
                            <option value="{{$years->id}}" {{(@$year_id == $years->id)?"selected":""}}>{{$years->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="class">Class <font style="color:red">*</font> </label>
                        <select name="class_id"  id="classes" class="form-control form-control-sm">
                            <option value="">Select Class</option>
                            @foreach($class as $classes)
                            <option value="{{$classes->id}}" {{@$class_id==$classes->id?"selected":""}}>{{$classes->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4" style="padding-top:32px">
                        <button type="submit" class="btn btn-primary btn-sm" name="search">Search</button>
                    </div>
                  </div>
                </form>

              </div>

              <div class="card-body">
                @if(!@$search)
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                   <th width="7%">Sl</th>
                   <th width="10%">Name</th>
                   <th width="9%">ID</th>
                   <th width="7%">Roll</th>
                   <th width="7%">Class</th>
                    <th width="7%">Year</th>
                    <th width="10%">Image</th>
                     @if(Auth::user()->role=='Admin')
                    <th width="7%">Code</th>
                    @endif
              
                    <th width="12%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $key =>$row)
                  <tr>
                    <th>{{$key+1}}</th>
                    <th>{{$row->student->name}}</th>
                    <th>{{$row->student->id_no}}</th>
                    <th>{{$row->roll}}</th>
                    <th>{{$row->studentClass->name}}</th>
                    <th>{{$row->studentYear->name}}</th>
                    <th>
                      <img class="profile-user-img img-fluid"
                       src="{{(!empty($row->student->image))?url('public/upload/student_images/'.$row->student->image):url('public/upload/noimage.jpg')}}"
                       alt="User profile picture">
                  </th>
                    @if(Auth::user()->role=='Admin')
                    <th>{{$row->student->code}}</th>
                    @endif
                    
                    <th>
                        <a href="{{route('students.registration.edit',$row->student_id)}}" class="btn btn-info btn-sm"> <i class="fa fa-edit"></i></a>
                        <a href="{{route('students.registration.delete',$row->student_id)}}" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></a>
                        
                        <a href="{{route('students.registration.promotion',$row->student_id)}}" class="btn btn-success btn-sm"> <i class="fas fa-check-double"></i></a>
                        <a target="_blank" href="{{route('students.registration.details',$row->student_id)}}" class="btn btn-primary btn-sm"> <i class="far fa-address-card"></i></a>
                    </th>
                  </tr>
                  @endforeach
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th width="7%">Sl</th>
                   <th width="10%">Name</th>
                   <th width="9%">ID</th>
                   <th width="7%">Roll</th>
                   <th width="7%">Class</th>
                    <th width="7%">Year</th>
                    <th width="10%">Image</th>
                    @if(Auth::user()->role=='Admin')
                    <th width="7%">Code</th>
                    @endif
                    
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                @else
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                   <th width="7%">Sl</th>
                   <th>Name</th>
                   <th>ID</th>
                   <th width="7%">Roll</th>
                   <th width="7%">Class</th>
                    <th width="7%">Year</th>
                    <th>Image</th>
                    <th width="7%">Code</th>
                    <th width="12%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $key =>$row)
                  <tr>
                    <th>{{$key+1}}</th>
                    <th>{{$row->student->name}}</th>
                    <th>{{$row->student->id_no}}</th>
                    <th>{{$row->roll}}</th>
                    <th>{{$row->studentClass->name}}</th>
                    <th>{{$row->studentYear->name}}</th>
                    
                    <th>
                      <img class="profile-user-img img-fluid"
                       src="{{(!empty($row->student->image))?url('public/upload/student_images/'.$row->student->image):url('public/upload/noimage.jpg')}}"
                       alt="User profile picture">
                  </th
                    @if(Auth::user()->role=='Admin')
                    <th>{{$row->student->code}}</th>
                    @endif>
                    <th>
                        <a href="{{route('students.registration.edit',$row->student_id)}}" class="btn btn-info btn-sm"> <i class="fa fa-edit"></i></a>
                        <a href="{{route('students.registration.delete',$row->student_id)}}" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></a>
                        <a href="{{route('students.registration.promotion',$row->student_id)}}" class="btn btn-success btn-sm"> <i class="fas fa-check-double"></i></a>
                        <a target="_blank" href="{{route('students.registration.promotion',$row->student_id)}}" class="btn btn-primary btn-sm"> <i class="far fa-address-card"></i></a>
                    </th>
                  </tr>
                  @endforeach
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th width="7%">Sl</th>
                   <th>Name</th>
                   <th>ID</th>
                   <th>Roll</th>
                   <th>Class</th>
                    <th>Year</th>
                    <th>Image</th>
                    <th>Code</th>
                    
                    <th width="12%">Action</th>
                  </tr>
                  </tfoot>
                </table>
                @endif
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
      
      year_id: {
        required: true,
      },
      class_id: {
        required: true,
      },
      
    },
    messages: {
      
      
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
@endsection