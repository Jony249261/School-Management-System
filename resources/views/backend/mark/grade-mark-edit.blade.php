@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Grade Point</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Grade Point</li>
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
                  Edit Grade Point
                  <a href="{{route('marks.grade.view')}}" class="btn btn-success float-right"><i class="fas fa-list mr-1"></i> Grade Point List </a>
                </h3>
              </div><!-- /.card-header -->
                <div class="card-body">
                    <form action="{{route('marks.grade.update',$data->id)}}" method="post" id="myForm">
                            @csrf 
                            <div class="form-row">
                                
                                <div class="form-group col-md-4">
                                    <label for="grade_name">Grade Name</label>
                                    <input type="text" id="grade_name" name="grade_name" class="form-control" placeholder="Enter Grade Name" value="{{$data->grade_name}}">
                                    @error('grade_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="grade_point">Grade Point</label>
                                    <input type="text" id="grade_point" name="grade_point" class="form-control"  value="{{$data->grade_point}}">
                                    @error('grade_point')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="start_mark">Start Marks</label>
                                    <input type="text" id="start_mark" name="start_mark" class="form-control" value="{{$data->start_mark}}">
                                    @error('start_mark')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="end_mark">End Marks</label>
                                    <input type="text" id="end_mark" name="end_mark" class="form-control" value="{{$data->end_mark}}">
                                    @error('end_mark')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="start_point">Start Point</label>
                                    <input type="text" id="start_point" name="start_point" class="form-control" value="{{$data->start_point}}">
                                    @error('start_point')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="end_point">End Point</label>
                                    <input type="text" id="end_point" name="end_point" class="form-control" value="{{$data->end_point}}">
                                    @error('end_point')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="remarks">Remarks</label>
                                    <input type="text" id="remarks" name="remarks" class="form-control" value="{{$data->remarks}}">
                                    @error('remarks')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="submit"  class="btn btn-primary" >
                                </div>
                            </div>
                    
                    </form>
                </div>
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
      grade_name: {
        required: true,
        
      },
      grade_point:{
        required: true,
        number:true,
      },
      start_mark:{
        required: true,
        number:true,
      },
      end_mark:{
        required: true,
        number:true,
      },
      start_point:{
        required: true,
        number:true,
      },
      end_point:{
        required: true,
        number:true,
      },
      remarks:{
        required: true,
      }
    },
    messages: {
      
      grade_name: {
        required: "Please Enter Grade Name",
      },
      grade_point: {
        required: "Please Enter Grade Point",
      },
      start_mark: {
        required: "Please Enter Start Marks",
      },
      end_mark: {
        required: "Please Enter End Marks",
      },
      start_point: {
        required: "Please Enter Start Point",
      },
      end_point: {
        required: "Please Enter End Point",
      },
      remarks: {
        required: "Please Enter Remarks",
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