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
                  <i class="fas fa-users mr-1"></i>
                  Grade Point List
                  <a href="{{route('marks.grade.add')}}" class="btn btn-success float-right"><i class="fas fa-plus-circle mr-1"></i> Add Grade Point</a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Grade Name</th>
                    <th>Grade Point</th>
                    <th>Start Marks</th>
                    <th>End Marks</th>
                    <th>Point Range</th>
                    <th>Remarks</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $key =>$row)
                  <tr class="{{$row->id}}">
                    <th>{{$key+1}}</th>
                    <th>{{$row->grade_name}}</th>
                    <th>{{$row->grade_point}}</th>
                    <th>{{$row->start_mark}}</th>
                    <th>{{$row->end_mark}}</th>
                    <th>{{$row->start_point}} - {{$row->end_point}}</th>
                    <th>{{$row->remarks}}</th>
                    <th>
                        <a title="Edit Attendence" href="{{route('marks.grade.edit',$row->id)}}" class="btn btn-info btn-sm"> <i class="fa fa-edit"></i></a>
                        <a title="View Attendence" href="{{route('marks.grade.edit',$row->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i></a>
                    </th>
                  </tr>
                  @endforeach
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Sl</th>
                    <th>Grade Name</th>
                    <th>Grade Point</th>
                    <th>Start Marks</th>
                    <th>End Marks</th>
                    <th>Point Range</th>
                    <th>Remarks</th>
                    <th>Action</th>
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