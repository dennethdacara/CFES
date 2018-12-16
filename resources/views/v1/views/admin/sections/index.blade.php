@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/sections/content_header')

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      @include('v1/components/errors/flash_message')
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List of Sections
            <span class="pull-right">
              <a href="{{route('sections.create')}}" class="btn btn-md btn-success">Add Section</a>
            </span>
          </h3>
        </div>
        <div class="card-body">
          <table id="section-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Schoolyear</th>
                <th>Gradelevel</th>
                <th>Adviser</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($sections as $section)
              <tr>
                <td>{{$section->sy}}</td>
                <td>{{$section->gradelevel}}</td>
                <td>{{$section->adviser}}</td>
                <td>{{$section->name}}</td>
                <td>{{$section->created_at}}</td>
                <td>
                  <form method="POST" action="{{route('sections.destroy', ['id' => $section->id])}}">
                    <a href="{{route('sections.edit', ['id' => $section->id])}}" class="btn btn-sm btn-primary">Edit</a>
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this section?');"
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