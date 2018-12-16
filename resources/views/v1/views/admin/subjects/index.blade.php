@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/subjects/content_header')

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      @include('v1/components/errors/flash_message')
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List of Subjects
            <span class="pull-right">
              <a href="{{route('subjects.create')}}" class="btn btn-md btn-success">Add Subject</a>
            </span>
          </h3>
        </div>
        <div class="card-body">
          <table id="subject-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Gradelevel</th>
                <th>Code</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($subjects as $subject)
              <tr>
                <td>{{$subject->gradelevel}}</td>
                <td>{{$subject->code}}</td>
                <td>{{$subject->name}}</td>
                <td>{{$subject->created_at}}</td>
                <td>
                  <form method="POST" action="{{route('subjects.destroy', ['id' => $subject->id])}}">
                    <a href="{{route('subjects.edit', ['id' => $subject->id])}}" class="btn btn-sm btn-primary">Edit</a>
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this subject?');"
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