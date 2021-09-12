@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Student Fee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Fee</li>
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
                  Add Student Fee
                  <a href="{{route('accounts.fee.view')}}" class="btn btn-success float-right"><i class="fas fa-list mr-1"></i> Student Fee List </a>
                </h3>
              </div><!-- /.card-header -->

               <div class="card-body">
                        <div class="form-row">
                        
                            <div class="form-group col-md-3">
                                <label for="year_id">Year <font style="color:red">*</font> </label>
                                <select name="year_id"  id="year_id" class="form-control form-control-sm">
                                    <option value="">Select Year</option>
                                    @foreach($years as $year)
                                    <option value="{{$year->id}}">{{$year->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="class_id">Class <font style="color:red">*</font> </label>
                                <select name="class_id"  id="class_id" class="form-control form-control-sm">
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="class_id">Select Fee Type <font style="color:red">*</font> </label>
                                <select name="fee_category_id"  id="fee_category_id" class="form-control form-control-sm">
                                    <option value="">Select Fee Category</option>
                                    @foreach($fee_categories as $feecat)
                                    <option value="{{$feecat->id}}">{{$feecat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                             <label class="controll-lebel" for="date">Date <font style="color:red">*</font> </label>
                            <input type="text" id="date" name="date" class="form-control form-control-sm singledatepicker" placeholder="Enter Your Join Date" autocomplete="off">
                            @error('date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div
                            
                            <div class="form-group col-md-4" style="padding-top:32px">
                                <a  id="search" class="btn btn-primary btn-sm" name="search">Search</a>
                            </div>
                            <br>
                            
                            
                        </div>
                        <div class="row d-none" id="marks-entry">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped dt-responsive" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID No</th>
                                                <th>Roll</th>
                                                <th>Student Name</th>
                                                <th>Father's Name</th>
                                                <th>Gender</th>
                                                <th>Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody id="marks-entry-tr">

                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-success btn-sm">Marks Entry</button>
                                </div>
                                
                            </div>
                         

              </div><!-- /.card-body -->

              <div class="card-body">
                  <div id="DocumentResults"></div>
                  <script id="document-template" type="text/x-handlebars-template">
                    <form action="{{route('accounts.fee.store')}}" method="post">
                        @csrf
                            <table class="table-sm table-bodered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        @{{{thsource}}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @{{#each this}}
                                    <tr>
                                        @{{{tdsource}}}
                                    </tr>
                                    @{{/each}}
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-sm btn-success" style="margin-top:10px">Submit</button>
                        </form>
                  </script>

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

  <script type="text/javascript">
     $(document).on('click','#search',function(){
         var year_id = $('#year_id').val();
         var class_id = $('#class_id').val();
         var date = $('#date').val();
         var fee_category_id = $('#fee_category_id').val();
         $('.notifyjs-corner').html('');
         if(year_id == ''){
           $.notify("Please Select Year!", {color: "#fff", background: "#D44950"});
            // $(.notify("Year Required", {globslPosition: 'top right',className: 'error'}));
             
             return false;
         }
         if(class_id == ''){
             //$(.notify("Class Required", {globslPosition: 'top right',className: 'error'}));
            $.notify("Please Select Class!", {color: "#fff", background: "#D44950"});
             return false;
         }
         if(date == ''){
             //$(.notify("Class Required", {globslPosition: 'top right',className: 'error'}));
            $.notify("Please Select Date!", {color: "#fff", background: "#D44950"});
             return false;
         }
         if(fee_category_id == ''){
             //$(.notify("Class Required", {globslPosition: 'top right',className: 'error'}));
            $.notify("Please Select Subject!", {color: "#fff", background: "#D44950"});
             return false;
         }
         $.ajax({
             url: "{{route('accounts.fee.getstudent')}}",
             type: "GET",
             data: {'year_id': year_id,'class_id':class_id,'fee_category_id':fee_category_id,'date':date},
             beforeSend: function(){


             },
             success:function(data){
                 var source = $("#document-template").html();
                 var template = Handlebars.compile(source);
                 var html = template(data);
                 $('#DocumentResults').html(html);
                 $('[data-toggle="tooltip"]').tooltip();

             }
         });
     });
  </script>


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