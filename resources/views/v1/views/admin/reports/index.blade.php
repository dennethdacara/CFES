@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/reports/content_header')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @include('v1/components/errors/flash_message')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Select Report Type</h3>
                </div>
                <form method="GET" action="{{ route('reports.displayReports') }}">
                    <div class="card-body">

                        <div class="form-group">
                            <label>Report Type*</label>
                            <select name="report_type" id="report_type" class="form-control">
                                <option value="" disabled selected>Select One</option>
                                <option value="listOfEvaluators">List of evaluators</option>
                                <option value="listOfActiveInactiveTeachers">List of active/inactive teachers</option>
                            </select>
                            @if ($errors->has('report_type'))
                            <span class="help-block align-left" style="color:red;">{{
                                $errors->first('report_type') }}</span>
                            @endif
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success pull-right">Filter Reports</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@stop
