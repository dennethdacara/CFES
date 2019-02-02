@extends('v1.master.master_app')

@section('content')

<style>
    .quiz-table {
        color: #FFFF;
        background-color: #3C8DBC;
    }
</style>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">Teacher: {{$teacherFullName}} | Subject: {{ $subject->name }}</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <form method="POST" action="{{ route('studentEvaluation.store') }}" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="row">
                @foreach($questions as $key => $question)
                    <table class="table table-bordered">
                        <thead>
                            <th class="text-left quiz-table" width="20%"><strong>Question #{{$key+1}}</strong></th>
                            <th class="text-left quiz-table">
                                <strong>{{$question->name}}</strong>
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">Please select your answer</td>
                                <td class="text-left">
                                    <select name="choice_id[]" id="choice_id" class="form-control" required>
                                        <option value="">- Choose One -</option>
                                        @foreach($choices as $choice)
                                            @if($choice->question_id == $question->id)
                                                <option value="{{$choice->id}}">{{$choice->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                        <input name="question_id[]" type="hidden" value="{{$question->id}}">
                    </table>
                @endforeach

                <input name="section_id" type="hidden" value="{{ $sectionID }}">
                <input name="subject_id" type="hidden" value="{{ $subject->id }}">
                <input name="faculty_id" type="hidden" value="{{ $teacher->id }}">
                <input name="student_id" type="hidden" value="{{ $studentInfo->student_id }}">

                {{-- <p><div class="g-recaptcha" data-sitekey="6Lf-HYsUAAAAABCJA1ba0WRbvEHBIibpWtHufAWq" data-callback="enableSubmit"></div></p> --}}

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
            </div>

            <br>
            <div class="box-footer" style="margin-bottom:10px;">
                <button class="btn btn-md btn-success" id="submitBtn" onclick="return confirm('Are you sure you want to submit your evaluation?');">Submit Evaluation</button>
            </div><br><br>

        </form>
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->

<script>
    // $(function () {
    //     document.getElementById("submitBtn").disabled = true;
    // });

    // function enableSubmit(){
    //     document.getElementById("submitBtn").disabled = false;
    // }
</script>

@stop
