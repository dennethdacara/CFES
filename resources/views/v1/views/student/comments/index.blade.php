@extends('v1.master.master_app')

@section('content')

@include('v1/views/student/comments/content_header')

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      @include('v1/components/errors/flash_message')
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List of Comments</h3>
        </div>
        <div class="card-body">
          <table id="section-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Schoolyear</th>
                <th>Subject</th>
                <th>Teacher</th>
                <th>Comment</th>
                <th>Created At</th>
              </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->sy }}</td>
                        <td>{{ $comment->subject }}</td>
                        <td>{{ $comment->faculty }}</td>
                        <td>{{ $comment->comment }}</td>
                        <td>{{ $comment->created_at }}</td>
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
