@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/schedules/content_header')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            @include('v1/components/errors/flash_message')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Schedules
                        <span class="pull-right">
                            <a href="{{route('schedules.create')}}" class="btn btn-md btn-success">Add Schedule</a>
                        </span>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="schedules-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Section</th>
                                <th>Subject</th>
                                <th>Faculty</th>
                                <th>Room</th>
                                <th>Days</th>
                                <th>Time</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                            <tr>
                                <td>{{$schedule->section}}</td>
                                <td>{{$schedule->subject}}</td>
                                <td>{{$schedule->faculty}}</td>
                                <td>{{$schedule->room}}</td>
                                <td>{{ str_replace( array('[','"','"',']') , '' , $schedule->days ) }}</td>
                                <td>{{$schedule->time}}</td>
                                <td>{{$schedule->created_at}}</td>
                                <td>
                                    <form method="POST" action="{{route('schedules.destroy', ['id' => $schedule->id])}}">
                                        <a href="{{route('schedules.edit', ['id' => $schedule->id])}}" class="btn btn-sm btn-primary">Edit</a>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this schedule?');"
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
