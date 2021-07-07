@extends('backend.layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Profile</h1>
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
            <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4 offset-md-4">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{(!empty($user->image))?url('public/upload/user_images/'.$user->image):url('public/upload/noimage.jpg')}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$user->name}}</h3>

                <p class="text-muted text-center">{{$user->address}}</p>

                <table width="100%">
                    <tbody>
                        <tr>
                            <td>Mobile</td>
                            <td>{{$user->mobile}}</td>
                            
                        </tr>
                        <hr>
                        <tr>
                            <td>Email</td>
                            <td>{{$user->email}}</td>
                            
                        </tr>
                        <hr>
                        <tr>
                            <td>Gender</td>
                            <td>{{$user->gender}}</td>
                        </tr>
                    </tbody>
                </table>
<br>
                <a href="{{route('profiles.edit')}}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection