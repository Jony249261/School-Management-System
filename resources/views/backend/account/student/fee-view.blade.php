@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Student Fees</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Fees</li>
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
                  Student Fee List
                  <a href="{{route('accounts.fee.add')}}" class="btn btn-success float-right"><i class="fas fa-plus-circle mr-1"></i> Add Student Fee</a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Id No</th>
                    <th>Name </th>
                    <th>Class</th>
                    <th>Year</th>
                    <th>Fee Type</th>
                    <th>Ammount</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $key =>$row)
                  <tr class="{{$row->id}}">
                    <th>{{$key+1}}</th>
                    <th>{{$row->student->id_no}}</th>
                    <th>{{$row->student->name}}</th>
                    <th>{{$row->studentClass->name}}</th>
                    <th>{{$row->studentYear->name}}</th>
                    <th>{{$row->feeCategory->name}}</th>
                    <th>{{$row->amount}} Tk</th>
                    <th>{{date('M Y',strtotime($row->date))}}</th>
                    
                  </tr>
                  @endforeach
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Sl</th>
                    <th>Id No</th>
                    <th>Name </th>
                    <th>Class</th>
                    <th>Year</th>
                    <th>Fee Type</th>
                    <th>Ammount</th>
                    <th>Date</th>
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