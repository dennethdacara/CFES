@extends('v1.master.master_app')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Welcome back, Admin!</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-warning-gradient elevation-1"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
              <a href="{{route('users.index')}}" style="color:inherit;">
                <span class="info-box-text">
                    Users
                </span>
                <span class="info-box-number">{{ App\User::count() }}</span>
              </a>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning-gradient elevation-1"><i class="fa fa-tasks"></i></span>
            <div class="info-box-content">
                <a href="{{route('faculties.index')}}" style="color:inherit;">
                    <span class="info-box-text">
                        Faculty
                    </span>
                    <span class="info-box-number">{{ App\Model\Faculty::count() }}</span>
                </a>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning-gradient elevation-1"><i class="fa fa-tasks"></i></span>
            <div class="info-box-content">
                <a href="{{route('students.index')}}" style="color:inherit;">
                    <span class="info-box-text">
                        Students
                    </span>
                    <span class="info-box-number">{{ App\Model\Student::count() }}</span>
                </a>
            </div>
          </div>
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

      </div>
      <!-- /.row -->
    </div>
    <!--/. container-fluid -->
  </section>
  <!-- /.content -->

@stop
