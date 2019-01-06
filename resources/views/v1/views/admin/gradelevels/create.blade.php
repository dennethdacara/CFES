@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/gradelevels/content_header')

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        @include('v1/components/errors/flash_message')

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add Gradelevel</h3>

          </div>
          <form method="POST" action="{{ route('gradelevels.store') }}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="card-body">
              <div class="form-group">
                <label>Name*</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Ex: Grade 11" value="{{old('name')}}">
                @if ($errors->has('name'))
                <span class="help-block align-left" style="color:red;">{{ $errors->first('name') }}</span>
                @endif
              </div>

              <div class="form-group">
                <label>Sort Order (1-{{$count}})</label>
                <input type="number" min="0" class="form-control" name="sort_order" id="sort_order" placeholder="{{$count}}"
                  value="{{$count}}">
              </div>

              <div class="form-check">
                <input type="checkbox" class="form-check-input" name="is_active" id="is_active" checked>
                <label class="form-check-label" for="exampleCheck1">Set as active</label>
              </div>

            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@stop
