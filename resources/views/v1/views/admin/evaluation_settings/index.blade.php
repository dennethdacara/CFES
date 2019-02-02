@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/evaluation_settings/content_header')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @include('v1/components/errors/flash_message')

                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Modify Evaluation Settings</h3>
                        <small>Note: Set the time period wherein the students will be able to access the faculty evaluation module.</small>
                    </div>
                    <form method="POST" action="{{route('evaluationSettings.update', ['id' => $evaluationSettings->id])}}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="question_id" value="{{ $evaluationSettings->id }}">
                        {{csrf_field()}}

                        <div class="card-body">

                            <div class="form-group">
                                <label>From*</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" value="{{$evaluationSettings->start_date}}">
                                @if ($errors->has('start_date'))
                                <span class="help-block align-left" style="color:red;">{{ $errors->first('start_date') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>To*</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" value="{{$evaluationSettings->end_date}}">
                                @if ($errors->has('end_date'))
                                <span class="help-block align-left" style="color:red;">{{ $errors->first('end_date') }}</span>
                                @endif
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary pull-right">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
