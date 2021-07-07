@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
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
              <div class="card-header bg-success">
                <h3>
                  <i class="fas fa-key mr-1"></i>
                  Edit Password
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('profiles.password.update')}}" method="post" id="myForm">
                    @csrf 
                    <div class="form-row">
                        
                        <div class="form-group col-md-4">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="again_new_password">Again New Password</label>
                            <input type="password" name="again_new_password" id="again_new_password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="submit" value="Update"  class="btn btn-success" >
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
      current_password: {
        required: true,
      },
      new_password: {
        required: true,
        minlength: 6
      },
      again_new_password: {
        required: true,
        equalTo: '#new_password'
      },
    },
    messages: {
      
      current_password: {
        required: "Please Provide Your Current Password",
      },
      new_password: {
        required: "Please provide a new password",
        minlength: "Your password must be at least 6 characters or Numbers"
        
      },
      again_new_password: {
        required: "Please provide again new password",
        equalTo: "confirm password does not match"
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