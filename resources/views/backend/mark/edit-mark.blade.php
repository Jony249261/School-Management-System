@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Student Marks Edit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Mark</li>
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
                  <form id="myForm" method="POST" action="{{route('marks.update')}}">
                      @csrf
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
                                <label for="class_id">Subject <font style="color:red">*</font> </label>
                                <select name="assign_subject_id"  id="assign_subject_id" class="form-control form-control-sm">
                                    <option value="">Select Subject</option>
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="class_id">Exam Type <font style="color:red">*</font> </label>
                                <select name="exam_id"  id="exam_id" class="form-control form-control-sm">
                                    <option value="">Select Exam Type</option>
                                    @foreach($exams as $exam)
                                    <option value="{{$exam->id}}">{{$exam->name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
                                                <th>Student Name</th>
                                                <th>Father's Name</th>
                                                <th>Gender</th>
                                                <th>Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody id="marks-entry-tr">

                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-success btn-sm">Update</button>
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
$(document).ready(function () {
  $('#myForm').validate({
    rules: {
      "marks[]": {
        required: true,
        number:true
      }
      
    },
    messages: {
      marks: {
        required: "Please Provide Subject Marks",
        number:"Please Provide Subject Marks",
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


  <script type="text/javascript">
     $(document).on('click','#search',function(){
         var year_id = $('#year_id').val();
         var class_id = $('#class_id').val();
         var exam_id = $('#exam_id').val();
         var assign_subject_id = $('#assign_subject_id').val();
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
         if(exam_id == ''){
             //$(.notify("Class Required", {globslPosition: 'top right',className: 'error'}));
            $.notify("Please Select Exam Type!", {color: "#fff", background: "#D44950"});
             return false;
         }
         if(assign_subject_id == ''){
             //$(.notify("Class Required", {globslPosition: 'top right',className: 'error'}));
            $.notify("Please Select Subject!", {color: "#fff", background: "#D44950"});
             return false;
         }
         $.ajax({
             url: "{{route('get.student.marks')}}",
             type: "GET",
             data: {'year_id': year_id,'class_id':class_id,'exam_id':exam_id,'assign_subject_id':assign_subject_id},
             success: function (data) {
                 $('#marks-entry').removeClass('d-none');
                 var html = '';
                 $.each(data, function(key, v){
                     html +=
                     '<tr>'+
                     '<td>'+v.student.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"><input type="hidden" name="id_no[]" value="'+v.student.id_no+'"></td>'+
                     
                     '<td>'+v.student.name+'</td>'+
                     '<td>'+v.student.fname+'</td>'+
                     '<td>'+v.student.gender+'</td>'+
                     '<td><input type="text" class="form-controll form-controll-sm" name="marks[]" value="'+v.marks+'"></td>'+
                     '</tr>'
                 });
                 html = $('#marks-entry-tr').html(html);
             }
         });
     });
  </script>

  <script>
      $(function(){
          $(document).on('change','#class_id',function(){
            var class_id = $('#class_id').val();
            $.ajax({
             url: "{{route('marks.getSubject')}}",
             type: "GET",
             data: {'class_id':class_id},
             success: function (data) {
                 
                 var html = '<option value="">Select Subject</option>';

                 $.each(data, function(key, v){
                     html += '<option value="'+v.id+'">'+v.subject.name+'</option>';

                 
                    });
                    $('#assign_subject_id').html(html);
                     }
                });
          });
      });
  </script>

  <!-- Validation -->
  <!-- Validation -->


@endsection