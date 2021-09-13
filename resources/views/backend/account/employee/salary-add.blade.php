@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Employee Salary</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee Salary</li>
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
                  Add Employee Salary
                  <a href="{{route('accounts.salary.view')}}" class="btn btn-success float-right"><i class="fas fa-list mr-1"></i> Employee Salary List </a>
                </h3>
              </div><!-- /.card-header -->

               <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-4">
                            <label for="date">Date <font style="color:red">*</font> </label>
                            <input type="text" id="date" name="date" class="form-control form-control-sm singledatepicker" placeholder="Enter Your Join Date" autocomplete="off" autofill="off">
                            @error('date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4" style="padding-top:32px">
                                <a  id="search" class="btn btn-primary btn-sm" name="search">Search</a>
                            </div>
                </div>
              </div><!-- /.card-body -->

              <div class="card-body">
                  <div id="DocumentResults"></div>
                  <script id="document-template" type="text/x-handlebars-template">
                    <form action="{{route('accounts.salary.store')}}" method="post">
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

         var date = $('#date').val();
         var fee_category_id = $('#fee_category_id').val();

         $('.notifyjs-corner').html('');
         if(date == ''){
             //$(.notify("Class Required", {globslPosition: 'top right',className: 'error'}));
            $.notify("Please Select Date!", {color: "#fff", background: "#D44950"});
             return false;
         }

         $.ajax({
             url: "{{route('accounts.salary.get-employee')}}",
             type: "GET",
             data: {'date':date},
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