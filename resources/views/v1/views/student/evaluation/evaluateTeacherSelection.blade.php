@extends('v1.master.master_app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                @include('v1/components/errors/flash_message')
                <h1 class="m-0 text-dark">Select a Teacher To Evaluate</h1>
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

            @foreach($teachers as $teacher)
                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info-gradient elevation-1">
                            <img src="{{ $teacher->image == null ? asset('images/user_icons/admin.png')
                            : asset('images/user_icons').'/'.Auth::user()->image }}"
                            style="height:50px;width:50px;">
                        </span>
                        <div class="info-box-content">
                            <a href="#" style="color:inherit;">
                                <span class="info-box-text">
                                    {{ $teacher->fullname }} <br>
                                    <small>Subject: <b>{{$teacher->subject}}</b></small><br>
                                    <small>Evaluation Status: <i>{{ $teacher->status == 'disabled' ? 'Already Submitted' : 'Pending' }}</i></small>
                                </span>
                                <span class="info-box-number" style="margin-top:5px;">

                                    <a href="{{ url('evaluateTeacher',
                                    ['sectionID' => $teacher->section_id, 'subjectID' => $teacher->subject_id,
                                    'facultyID' => $teacher->faculty_id]) }}">
                                        <button class="btn btn-sm btn-success" {{ $teacher->status == 'disabled' ? 'disabled' : '' }}>Evaluate</button>
                                    </a>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

        </div>
        <!-- /.row -->
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->

@stop
