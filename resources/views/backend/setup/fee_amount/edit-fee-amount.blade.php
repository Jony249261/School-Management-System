@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Fee Category Amount</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Fee Amount</li>
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
                  Update Fee Amount
                  <a href="{{route('setups.fee.amount.view')}}" class="btn btn-success float-right"><i class="fas fa-list mr-1"></i> Fee Amount List </a>
                </h3>
              </div><!-- /.card-header -->
               <div class="card-body">
                    
                    <form action="{{route('setups.fee.amount.update',$data[0]->fee_category_id)}}" method="post" id="myForm">  
                    @csrf 
                        <div class="add_item">
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                        <label for="fee_category">Fee Category</label>
                                        <select name="fee_category_id"  id="fee_category" class="form-control">
                                            <option value="">Select Fee Category</option>
                                            @foreach($fee as $fees)
                                            <option value="{{$fees->id}}" {{$data[0]->fee_category_id==$fees->id?"selected":""}}>{{$fees->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('fee_category_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                            </div>
                            @foreach($data as $edata)
                            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                            <label for="class">Class</label>
                                            <select name="class_id[]"  id="class" class="form-control">
                                                <option value="">Select Class</option>
                                                @foreach($class as $classes)
                                                <option value="{{$classes->id}}" {{$edata->class_id==$classes->id?"selected":""}}>{{$classes->name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                            <label for="amount">Amount</label>
                                            <input type="text" id="amount" name="amount[]" class="form-control"value="{{$edata->amount}}">
                                            @error('name')
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
                            @endforeach
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
                <div class="form-group col-md-5">
                        <label for="class">Class</label>
                        <select name="class_id[]"  id="class" class="form-control">
                            <option value="">Select Class</option>
                            @foreach($class as $classes)
                            <option value="{{$classes->id}}">{{$classes->name}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group col-md-5">
                        <label for="amount">Amount</label>
                        <input type="text" id="amount" name="amount[]" class="form-control" placeholder="Enter Amount">
                        @error('amount')
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
      "fee_category_id": {
        required: true,
      },
      "class_id[]":{
        required: true,
      },
      "amount[]":{
        required: true,
        number: true,
      }
    },
    messages: {
      "fee_category_id": {
        required: "Please Select Fee Category",
      },
      "class_id[]": {
        required: "Please Select a Class",
      },
      "amount[]": {
        required: "Please Provide Amount",
        number: "Please Provide a Digit amount",
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