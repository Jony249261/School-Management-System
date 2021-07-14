@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Exam Type</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Exam Type</li>
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
                  Add Exam Type
                  <a href="{{route('setups.exam.type.view')}}" class="btn btn-success float-right"><i class="fas fa-list mr-1"></i> Exam Type List </a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('setups.exam.type.store')}}" method="post" id="myForm">
                    @csrf 
                    <div class="form-row">
                        
                        <div class="form-group col-md-4">
                            <label for="name">Exam Type Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Exam Type Name">
                            @error('name')
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
        required: "Please Provide Exam Type Name",
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