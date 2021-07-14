@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Assign Subject</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Assign Subject</li>
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
                  Add Assign Subject
                  <a href="{{route('setups.assign.subject.view')}}" class="btn btn-success float-right"><i class="fas fa-list mr-1"></i> Assign Subject List </a>
                </h3>
              </div><!-- /.card-header -->
               <div class="card-body">
                    
                    <form action="{{route('setups.assign.subject.store')}}" method="post" id="myForm">  
                    @csrf 
                        <div class="add_item">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                        <label for="fee_category">Class</label>
                                        <select name="class_id"  id="fee_category" class="form-control">
                                            <option value="">Select Class</option>
                                            @foreach($class as $classes)
                                            <option value="{{$classes->id}}">{{$classes->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                        <label for="class">Subject</label>
                                        <select name="subject_id[]"  id="class" class="form-control">
                                            <option value="">Select Subject</option>
                                            @foreach($subject as $subjects)
                                            <option value="{{$subjects->id}}">{{$subjects->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group col-md-2">
                                        <label for="amount">Full Mark</label>
                                        <input type="text" id="amount" name="full_mark[]" class="form-control" placeholder="Enter Mark">
                                        @error('full_mark')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                </div>
                                <div class="form-group col-md-2">
                                        <label for="amount">Pass Mark</label>
                                        <input type="text" id="amount" name="pass_mark[]" class="form-control" placeholder="Enter Mark">
                                        @error('pass_mark')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                </div>
                                <div class="form-group col-md-2">
                                        <label for="amount">Subjective Mark</label>
                                        <input type="text" id="amount" name="get_mark[]" class="form-control" placeholder="Enter Mark">
                                        @error('get_mark')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                </div>
                                

                                <div class="form-group col-md-2" style="padding-top:31px">
                                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                                </div>
                                
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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


  <div style="visibility:hidden;" >
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="form-row">
                                <div class="form-group col-md-4">
                                        <label for="class">Subject</label>
                                        <select name="subject_id[]"  id="class" class="form-control">
                                            <option value="">Select Subject</option>
                                            @foreach($subject as $subjects)
                                            <option value="{{$subjects->id}}">{{$subjects->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group col-md-2">
                                        <label for="amount">Full Mark</label>
                                        <input type="text" id="amount" name="full_mark[]" class="form-control" placeholder="Enter Mark">
                                        @error('full_mark')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                </div>
                                <div class="form-group col-md-2">
                                        <label for="amount">Pass Mark</label>
                                        <input type="text" id="amount" name="pass_mark[]" class="form-control" placeholder="Enter Mark">
                                        @error('pass_mark')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                </div>
                                <div class="form-group col-md-2">
                                        <label for="amount">Subjective Mark</label>
                                        <input type="text" id="amount" name="get_mark[]" class="form-control" placeholder="Enter Mark">
                                        @error('get_mark')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                </div>
                                

                                <div class="form-group col-md-2" style="padding-top:31px">
                                    <div class="form-row">
                                        <span class="btn btn-success addeventmore mr-2"><i class="fa fa-plus-circle"></i></span>
                                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                                    </div>
                        
                                </div>
                                
                            </div>
        </div>
    </div>

  </div>

<script type="text/javascript">
    $(document).ready(function(){
        var counter = 0;
        $(document).on("click",".addeventmore", function(){
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        $(document).on("click",".removeeventmore", function(event){
            
            $(this).closest(".delete_whole_extra_item_add").remove();
            counter -= 1;
        });

    });
</script>
<script>
$(function () {
  $('#myForm').validate({
    rules: {
      "class_id": {
        required: true,
      },
      "subject_id[]":{
        required: true,
      },
      "full_mark[]":{
        required: true,
        number: true,
      },
      "pass_mark[]":{
        required: true,
        number: true,
      },
      "get_mark[]":{
        required: true,
        number: true,
      },
    },
    messages: {
      "class_id": {
        required: "Please Select a Class",
      },
      "subject_id[]": {
        required: "Please Select a Subject",
      },
      "full_mark[]": {
        required: "Please Provide Full Mark",
        number: "Please Provide a Digit Mark",
      },
      "pass_mark[]": {
        required: "Please Provide Pass Mark",
        number: "Please Provide a Digit Mark",
      },
      "get_mark[]": {
        required: "Please Provide Subjective Mark",
        number: "Please Provide a Digit Mark",
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