@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/gradelevels/content_header')

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      @include('v1/components/errors/flash_message')
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List of Gradelevels
            <span class="pull-right">
              <a href="{{route('gradelevels.create')}}" class="btn btn-md btn-success">Add Gradelevel</a>
            </span>
          </h3>
        </div>
        <div class="card-body">
          <table id="gradelevel-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Sort Order</th>
                <th>Is Active</th>
                <th>Created At</th>
                {{-- <th>Actions</th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach($gradelevels as $gradelevel)
              <tr>
                <td>{{$gradelevel->name}}</td>
                <td>{{$gradelevel->sort_order}}</td>
                <td>{{$gradelevel->is_active ? 'Yes' : 'No'}}</td>
                <td>{{$gradelevel->created_at}}</td>
                {{-- <td>
                  <form method="POST" action="{{route('gradelevels.destroy', ['id' => $gradelevel->id])}}">
                    <a href="{{route('gradelevels.edit', ['id' => $gradelevel->id])}}" class="btn btn-sm btn-primary">Edit</a>
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this gradelevel?');"
                      class="btn btn-sm btn-danger">Delete</button>
                  </form>
                </td> --}}
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
