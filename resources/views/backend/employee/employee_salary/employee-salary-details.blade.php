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
                  <i class="fas fa-users mr-1"></i>
                  Employee Salary Information
                <a href="{{route('employee.salary.view')}}" class="btn btn-success float-right"><i class="fas fa-plus-circle mr-1"></i> Employee Salary List</a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                  <h6><strong>Employee Name:</strong><span style="margin-right:20px !important; margin-left:10px !important">{{$data->name}}</span> <strong>Employee Id:</strong><span style="margin-right:20px !important; margin-left:10px !important">{{$data->id_no}}</span> <strong>Join Date:</strong><span style="margin-right:20px !important; margin-left:10px !important">{{$data->join_date}}</span></h6>
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Previous Salary</th>
                    <th>Present Salary</th>
                    <th>Increment Salary</th>
                    <th>Effected Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($salary_log as $key =>$row)
                  <tr>
                      
                    <th>{{$key+1}}</th>
                    <th>{{$row->previous_salary}}</th>
                    <th>{{$row->present_salary}}</th>
                    <th>{{$row->increment_salary}}</th>
                    <th>{{$row->effected_date}}</th>
                    
                    
                  </tr>
                  @endforeach
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Sl</th>
                    <th>Previous Salary</th>
                    <th>Present Salary</th>
                    <th>Increment Salary</th>
                    <th>Effected Date</th>
                  </tr>
                  </tfoot>
                </table>
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

@endsection