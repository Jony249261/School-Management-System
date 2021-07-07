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
                  Update Profile
                  <a href="{{route('profiles.view')}}" class="btn btn-success float-right"><i class="fas fa-list mr-1"></i> Your Profile</a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('profiles.update')}}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf 
                    <div class="form-row">
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
                        <div class="form-group col-md-4">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" id="mobile" class="form-control" value="{{$user->mobile}}">
                            @error('mobile')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> 
                        <div class="form-group col-md-4">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{$user->address}}">
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> 
                        <div class="form-group col-md-4">
                            <label for="gender">Gender</label>
                            <select name="gender"  id="gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="Male" {{($user->gender=="Male")?"selected":""}}>Male</option>
                                <option value="Female" {{($user->gender=="Female")?"selected":""}}>Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> 
                        <div class="form-group col-md-2">
                            <img id="showImage" src="{{(!empty($user->image))?url('public/upload/user_images/'.$user->image):url('public/upload/noimage.jpg')}}" alt="" style="height:160px; width:150px; border:1px solid #000">
                        </div> 
                        
                        
                        <div class="form-group col-md-6 mt-5">
                            <input type="submit" value="Update" class="btn btn-primary btn-lg" >
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