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
                  <i class="fas fa-users mr-1"></i>
                  Fee Amount List
                  <a href="{{route('setups.fee.amount.add')}}" class="btn btn-success float-right"><i class="fas fa-plus-circle mr-1"></i> Add Fee Amount</a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                   <th>Sl</th>
                    <th>Fee Category</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $key =>$row)
                  <tr>
                    <th>{{$key+1}}</th>
                    <th>{{$row->fee_category->name}}</th>
                    <th>
                        <a href="{{route('setups.fee.amount.edit',$row->fee_category_id)}}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                        <a href="{{route('setups.fee.amount.details',$row->fee_category_id)}}" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i></a>
                        <a href="{{route('setups.fee.amount.delete',$row->fee_category_id)}}" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></a>
                    </th>
                  </tr>
                  @endforeach
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
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