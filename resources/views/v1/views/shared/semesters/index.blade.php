@extends('v1.master.master_app')

@section('content')

@include('v1/views/shared/semesters/content_header')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            @include('v1/components/errors/flash_message')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Semesters</h3>
                </div>
                <div class="card-body">
                    <table id="sy-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Semester</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($semesters as $semester)
                            <tr>
                                <td>{{$semester->name}}</td>
                                <td>Active</td>
                                <td>{{$semester->created_at}}</td>
                                <td>
                                    @if($semester->is_active)
                                        <a href="#" class="btn btn-sm btn-default"><i>Currently Active</i></a>
                                    @else
                                        <a href="{{route('semesters.setAsActive', ['id' => $semester->id])}}"
                                            class="btn btn-sm btn-success"
                                            onclick="return confirm('Are you sure you want to set this as the active semester?');">
                                            Set As Active
                                        </a>
                                    @endif
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
