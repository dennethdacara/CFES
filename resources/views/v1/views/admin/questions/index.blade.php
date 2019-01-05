@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/questions/content_header')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            @include('v1/components/errors/flash_message')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Questions
                        <span class="pull-right">
                            <a href="{{route('questions.create')}}" class="btn btn-md btn-success">Add Question</a>
                        </span>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="questions-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Question</th>
                                <th>Is Active</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $question)
                            <tr>
                                <td>{{$question->subject}}</td>
                                <td>{{$question->name}}</td>
                                <td>{{$question->is_active}}</td>
                                <td>{{$question->created_at}}</td>
                                <td>
                                    <form method="POST" action="{{route('questions.destroy', ['id' => $question->id])}}">
                                        <a href="{{route('questions.edit', ['id' => $question->id])}}" class="btn btn-sm btn-primary">Edit</a>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this question?');"
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
