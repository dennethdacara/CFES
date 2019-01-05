@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/questions/content_header')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('v1/components/errors/flash_message')

                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Add Question</h3>

                    </div>
                    <form method="POST" action="{{ route('questions.store') }}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card-body">

                            <div class="form-group">
                                <label>Section*</label>
                                <select name="section_id" id="section_id" class="form-control multiSel" data-live-search="true" title="Select a section">
                                    @foreach($sections as $section)
                                    <option value="{{$section->id}}" {{$section->id == old('section_id') ? 'selected' : ''}}>
                                        {{$section->name}}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('section_id'))
                                <span class="help-block align-left" style="color:red;">{{
                                    $errors->first('section_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Subject*</label>
                                <select name="subject_id"
                                    id="subject_id"
                                    class="form-control multiSel"
                                    data-live-search="true"
                                    title="Select a subject">
                                        @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}"
                                            {{$subject->id == old('subject_id') ? 'selected' : ''}}>
                                            {{$subject->name}}
                                        </option>
                                        @endforeach
                                </select>
                                @if ($errors->has('subject_id'))
                                <span class="help-block align-left" style="color:red;">{{
                                    $errors->first('subject_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Question Type*</label><br>

                                <label class="radio-inline" style="margin-right:15px;font-weight:normal;">
                                    <input type="radio" name="type" value="multiple_choice" checked>Multiple Choice
                                </label>
                                <label class="radio-inline" style="margin-right:15px;font-weight:normal;">
                                    <input type="radio" name="type" value="fill_in_the_blanks">Fill-in the blanks
                                </label>
                                <label class="radio-inline" style="margin-right:15px;font-weight:normal;">
                                    <input type="radio" name="type" value="true_or_false">True or False
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Question*</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Question Description"
                                    value="{{old('name')}}">
                                @if ($errors->has('name'))
                                <span class="help-block align-left" style="color:red;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Choices*</label>
                                <select name="choice_id[]"
                                    id="choice_id"
                                    class="form-control multiSel"
                                    multiple="multiple"
                                    data-live-search="true"
                                    title="Select possible choices">
                                        @foreach($choices as $choice)
                                        <option value="{{$choice->id}}"
                                            {{ (collect(old('choice_id'))->contains($choice->id)) ? 'selected':'' }}>
                                            {{$choice->name}}
                                        </option>
                                        @endforeach
                                </select>
                                @if ($errors->has('choice_id'))
                                <span class="help-block align-left" style="color:red;">{{
                                    $errors->first('choice_id') }}</span>
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
