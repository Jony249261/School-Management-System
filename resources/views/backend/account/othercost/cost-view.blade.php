@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Other Cost</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Other Cost</li>
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
                  Other Cost List
                  <a href="{{route('accounts.cost.add')}}" class="btn btn-success float-right"><i class="fas fa-plus-circle mr-1"></i> Add Other Cost</a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Date</th>
                    <th>Amount </th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $key =>$row)
                  <tr class="{{$row->id}}">
                    <th>{{$key+1}}</th>
                    <th>{{date('Y-m-d',strtotime($row->date))}}</th>
                    <th>{{$row->amount}}</th>
                    <th>{{$row->description}}</th>
                    <th>
                      <img class="profile-user-img img-fluid"
                       src="{{(!empty($row->image))?url('public/upload/cost_images/'.$row->image):url('public/upload/noimage.jpg')}}"
                       alt="User profile picture">
                    </th>
                    <th>
                        <a href="{{route('accounts.cost.edit',$row->id)}}" class="btn btn-info btn-sm"> <i class="fa fa-edit"></i></a>
                        <a href="{{route('accounts.cost.delete',$row->id)}}" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></a>
                    </th>
                    
                  </tr>
                  @endforeach
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Sl</th>
                    <th>Date</th>
                    <th>Amount </th>
                    <th>Description</th>
                    <th>Image</th>
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