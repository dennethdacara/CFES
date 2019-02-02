@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/reports/content_header')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @include('v1/components/errors/flash_message')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    @if($reportType == 'listOfStudentsEvaluated')
                        <form method="GET" action="{{ route('reports.displayReports') }}">
                            <input type="hidden" name="report_type" value="{{$reportType}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>From</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{$oldStartDate}}">
                                        @if ($errors->has('start_date'))
                                        <span class="help-block align-left" style="color:red;">{{
                                            $errors->first('start_date') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>To</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{$oldEndDate}}">
                                        @if ($errors->has('end_date'))
                                        <span class="help-block align-left" style="color:red;">{{
                                            $errors->first('end_date') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success pull-right">Filter By Date</button>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                @foreach($tableHeaders as $tableHeader)
                                    <th>{{$tableHeader}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $data1)
                                <tr>
                                    @foreach($data1 as $data11)
                                        <td>{{ $data11 }}</td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{count($tableHeaders)}}"><center>No data to display.</center></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
