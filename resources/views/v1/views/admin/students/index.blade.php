@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/students/content_header')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            @include('v1/components/errors/flash_message')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of students
                        <span class="pull-right">
                            <a href="{{route('students.create')}}" class="btn btn-md btn-success">Add Student</a>
                        </span>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="students-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Student No</th>
                                <th>Learner's Reference No</th>
                                <th>Gradelevel</th>
                                <th>Section</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>
                                    <center>
                                        <img src="{{ $student->image == null ? asset('images/user_icons/student.png') : asset('images/user_icons').'/'.$student->image }}"
                                        style="height:50px;width:50px;">
                                    </center>
                                </td>
                                <td>{{$student->fullname}}</td>
                                <td>{{$student->student_no}}</td>
                                <td>{{$student->lrn}}</td>
                                <td>{{$student->gradelevel}}</td>
                                <td>{{$student->section}}</td>
                                <td>{{$student->created_at}}</td>
                                <td>
                                    <form method="POST" action="{{route('students.destroy', ['id' => $student->id])}}">
                                        <a href="{{route('students.edit', ['id' => $student->id])}}" class="btn btn-sm btn-info">Edit</a>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this student?');"
                                            class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
