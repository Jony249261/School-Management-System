@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Exam Fee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Fee</li>
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
                  Search Criteria
                  
                </h3>
              </div><!-- /.card-header -->

              <div class="card-body">
                  
                        <div class="form-row">
                        
                            <div class="form-group col-md-3">
                                <label for="year_id">Year <font style="color:red">*</font> </label>
                                <select name="year_id"  id="year_id" class="form-control form-control-sm">
                                    <option value="">Select Year</option>
                                    @foreach($year as $years)
                                    <option value="{{$years->id}}">{{$years->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="class_id">Class <font style="color:red">*</font> </label>
                                <select name="class_id"  id="class_id" class="form-control form-control-sm">
                                    <option value="">Select Class</option>
                                    @foreach($class as $classes)
                                    <option value="{{$classes->id}}">{{$classes->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="class_id">Class <font style="color:red">*</font> </label>
                                <select name="exam_type"  id="exam_type" class="form-control form-control-sm">
                                    <option value="">Select Exam Type</option>
                                    @foreach($exam as $exams)
                                    <option value="{{$exams->id}}">{{$exams->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3" style="padding-top:32px">
                                <a  id="search" class="btn btn-primary btn-sm" name="search">Search</a>
                            </div>
                            <br>
                            
                            
                        </div>

              </div><!-- /.card-body -->

              <div class="card-body">
                  <div id="DocumentResults"></div>
                  <script id="document-template" type="text/x-handlebars-template">
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
         var exam_type = $('#exam_type').val();
         $('.notifyjs-corner').html('');
         if(year_id == ''){
           //alert("Select Year");
            // $(.notify("Year Required", {globslPosition: 'top right',className: 'error'}));
             $.notify("Please Select Year!", {color: "#fff", background: "#D44950"});

             return false;
         }
         if(class_id == ''){
             //$(.notify("Class Required", {globslPosition: 'top right',className: 'error'}));
             //alert("Select Class");
             $.notify("Please Select Class!", {color: "#fff", background: "#D44950"});
             return false;
         }
         if(exam_type == ''){
             //$(.notify("Class Required", {globslPosition: 'top right',className: 'error'}));
             //alert("Select Class");
             $.notify("Please Select Exam Type!", {color: "#fff", background: "#D44950"});
             return false;
         }
         $.ajax({
             url: "{{route('students.exam.fee.get-student')}}",
             type: "GET",
             data: {'year_id': year_id,'class_id':class_id,'exam_type':exam_type},
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

  <!-- Validation -->
  <!-- Validation -->


@endsection