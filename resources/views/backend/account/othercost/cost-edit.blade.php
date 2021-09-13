@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Other Cost</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Other Cost</li>
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
                  Edit Other Cost
                  <a href="{{route('accounts.cost.view')}}" class="btn btn-success float-right"><i class="fas fa-list mr-1"></i> Other Cost List </a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('accounts.cost.update',$data->id)}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf 
                    <div class="form-row">
                        
                        <div class="form-group col-md-3">
                            <label for="date">Date <font style="color:red">*</font> </label>
                            <input type="text" id="date" name="date" class="form-control form-control-sm singledatepicker" value="{{date('m-d-Y',strtotime($data->date))}}" autocomplete="off" autofill="off">
                            @error('date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                    <div class="form-group col-md-3">
                            <label for="name">Amount</label>
                            <input type="text" id="name" name="amount" class="form-control form-control-sm" value="{{$data->amount}}">
                            @error('amount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="image">Image <font style="color:red">*</font> </label>
                        <input type="file" name="image" id="image" class="form-control form-control-sm">
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                            <img id="showImage" src="{{(!empty($data->image))?url('public/upload/cost_images/'.$data->image):url('public/upload/noimage.jpg')}}" alt="" style="height:160px; width:150px; border:1px solid #000">
                        </div> 
                    <label>Description</label>
                    <div class="form-group col-md-12">
                            
                            <textarea name="description" class="form-controll" placeholder="Enter Description" rows="4" cols="150">{{$data->description}}</textarea>
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
$(function () {
  $('#myForm').validate({
    rules: {
      amount: {
        required: true,
        number:true,
      },
      description: {
        required: true,
      },
    },
    messages: {
      
      amount: {
        required: "Please Provide Amount",
        number: "Please Enter a valid Amount",
      },
      description: {
        required: "Please Provide Description",
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