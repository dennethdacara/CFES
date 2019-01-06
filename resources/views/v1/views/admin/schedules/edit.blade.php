@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/schedules/content_header')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @include('v1/components/errors/flash_message')

                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Edit Schedule</h3>
                    </div>
                    <form method="POST" action="{{route('schedules.update', ['id' => $schedule->id])}}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                        {{csrf_field()}}
                        <div class="card-body">

                            <div class="form-group">
                                <label>Section*</label>
                                <select name="section_id" id="section_id" class="form-control multiSel"
                                    data-live-search="true" title="Select section">
                                    @foreach($sections as $section)
                                    <option value="{{$section->id}}"
                                        {{$section->id == $schedule->section_id ? 'selected' : ''}}>
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
                                <select name="subject_id" id="subject_id" class="form-control multiSel"
                                    data-live-search="true" title="Select subject">
                                    @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}"
                                        {{$subject->id == $schedule->subject_id ? 'selected' : ''}}>
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
                                <label>Faculty*</label>
                                <select name="faculty_id" id="faculty_id" class="form-control multiSel"
                                    data-live-search="true" title="Select faculty">
                                    @foreach($faculties as $faculty)
                                    <option value="{{$faculty->id}}"
                                        {{$faculty->id == $schedule->faculty_id ? 'selected' : ''}}>
                                        {{$faculty->fullname}}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('faculty_id'))
                                <span class="help-block align-left" style="color:red;">{{
                                    $errors->first('faculty_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Room*</label>
                                <select name="room_id" id="room_id" class="form-control multiSel" data-live-search="true"
                                    title="Select room">
                                    @foreach($rooms as $room)
                                    <option value="{{$room->id}}" {{$room->id == $schedule->room_id ? 'selected' : ''}}>
                                        {{$room->name}}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('room_id'))
                                <span class="help-block align-left" style="color:red;">{{
                                    $errors->first('room_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <?php $araw = json_decode($schedule->days); ?>
                                <div class="col-md-12">
                                    <p><b>Days:</b></p>
                                    @if ($errors->has('days'))
                                    <span class="help-block align-left" style="color:red;">{{ $errors->first('days') }}
                                    </span>
                                    @endif

                                    <div class="col-md-4">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="days[]" class="uniform" value="M"
                                            {{in_array("M", $araw) ? 'checked' : ''}} />
                                            MONDAY
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="days[]" class="uniform" value="T"
                                            {{in_array("T", $araw) ? 'checked' : ''}} />
                                            TUESDAY
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="days[]" class="uniform" value="W"
                                            {{in_array("W", $araw) ? 'checked' : ''}} />
                                            WEDNESDAY
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="days[]" class="uniform" value="TH"
                                            {{in_array("TH", $araw) ? 'checked' : ''}} />
                                            THURSDAY
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="days[]" class="uniform" value="F"
                                            {{in_array("F", $araw) ? 'checked' : ''}} />
                                            FRIDAY
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Start Time*</label>
                                <input type="time" class="form-control" name="start_time" value="{{$schedule->start_time}}">
                                @if ($errors->has('start_time'))
                                <span class="help-block align-left" style="color:red;">{{
                                    $errors->first('start_time') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>End Time*</label>
                                <input type="time" class="form-control" name="end_time" value="{{$schedule->end_time}}">
                                @if ($errors->has('end_time'))
                                <span class="help-block align-left" style="color:red;">{{
                                    $errors->first('end_time') }}</span>
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
