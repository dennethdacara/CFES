@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/students/content_header')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @include('v1/components/errors/flash_message')

                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Edit Student: {{$student->fullname}}</h3>

                    </div>
                    <form method="POST" action="{{route('students.update', ['id' => $student->id])}}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                        <input type="hidden" name="user_id" value="{{ $student->user_id }}">
                        {{csrf_field()}}

                        <div class="card-body">

                            <div class="form-group">
                                <label>Student No*</label>
                                <input type="text" class="form-control" name="student_no" id="student_no"
                                    value="{{$student->student_no}}">
                                @if ($errors->has('student_no'))
                                <span class="help-block align-left" style="color:red;">{{ $errors->first('student_no')
                                    }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Learner's Reference No*</label>
                                <input type="text" class="form-control" name="lrn" id="lrn" placeholder="Ex. 502716150015"
                                    value="{{$student->lrn}}">
                                @if ($errors->has('lrn'))
                                <span class="help-block align-left" style="color:red;">{{ $errors->first('lrn') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>First Name*</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter Firstname"
                                    value="{{$student->firstname}}" required>
                                @if ($errors->has('firstname'))
                                <span class="help-block align-left" style="color:red;">{{ $errors->first('firstname')
                                    }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Middle Name(Optional)</label>
                                <input type="text" class="form-control" name="middlename" id="middlename" placeholder="Enter Middlename"
                                    value="{{$student->middlename}}">
                                @if ($errors->has('middlename'))
                                <span class="help-block align-left" style="color:red;">{{ $errors->first('middlename')
                                    }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Last Name*</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Lastname"
                                    value="{{$student->lastname}}" required>
                                @if ($errors->has('lastname'))
                                <span class="help-block align-left" style="color:red;">{{ $errors->first('lastname') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Gender*</label><br>
                                <label class="radio-inline" style="margin-right:15px;font-weight:normal;">
                                    <input type="radio" name="gender" value="1" {{$student->gender == 1 ? 'checked' : ''}}>Male
                                </label>
                                <label class="radio-inline" style="margin-right:15px;font-weight:normal;">
                                    <input type="radio" name="gender" value="0" {{$student->gender == 0 ? 'checked' : ''}}>Female
                                </label>
                            </div>

                            {{-- <div class="form-group">
                                <label>Email*</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Ex. student@gmail.com"
                                    value="{{$student->email}}" required>
                                @if ($errors->has('email'))
                                <span class="help-block align-left" style="color:red;">{{ $errors->first('email') }}</span>
                                @endif
                            </div> --}}

                            <div class="form-group">
                                <label>Gradelevel*</label>
                                <select name="gradelevel_id" id="gradelevel_id" class="form-control">
                                    <option value="" selected disabled>Select Gradelevel</option>
                                    @forelse($gradelevels as $gradelevel)
                                    <option value="{{$gradelevel->id}}"
                                        {{$gradelevel->id == $student->gradelevel_id ? 'selected' : ''}}>
                                        {{$gradelevel->name}}
                                    </option>
                                    @empty
                                    <option value="" selected>You need to add a gradelevel first.</option>
                                    @endforelse
                                </select>
                                @if ($errors->has('gradelevel_id'))
                                <span class="help-block align-left" style="color:red;">{{
                                    $errors->first('gradelevel_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Section*</label>
                                <select name="section_id" id="section_id" class="form-control">
                                    <option value="" selected disabled>Select Section</option>
                                    @foreach($sections as $section)
                                    <option value="{{$section->id}}"
                                        {{$section->id == $student->section_id ? 'selected' : ''}}>
                                        {{$section->name}}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('section_id'))
                                <span class="help-block align-left" style="color:red;">{{
                                    $errors->first('section_id') }}</span>
                                @endif
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
