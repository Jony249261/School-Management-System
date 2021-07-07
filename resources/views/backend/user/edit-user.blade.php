@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
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
                  Update User
                  <a href="{{route('users.view')}}" class="btn btn-success float-right"><i class="fas fa-list mr-1"></i> All User</a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('users.update',$user->id)}}" method="post" id="myForm">
                    @csrf 
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="usertype">User Role</label>
                            <select name="usertype"  id="usertype" class="form-control">
                                <option value="">Select Role</option>
                                <option value="Admin" {{($user->usertype=="Admin")?"selected":""}}>Admin</option>
                                <option value="User" {{($user->usertype=="User")?"selected":""}}>User</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                  @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                  @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="submit" value="Update" class="btn btn-primary" >
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

@endsection