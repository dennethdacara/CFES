@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/subjects/content_header')

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        @include('v1/components/errors/flash_message')

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add Subject</h3>

          </div>
          <form method="POST" action="{{ route('subjects.store') }}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="card-body">

              <div class="form-group">
                <label>Gradelevel*</label>
                <select name="gradelevel_id" id="gradelevel_id" class="form-control">
                  <option value="" selected disabled>Select Gradelevel</option>
                  @forelse($gradelevels as $gradelevel)
                  <option value="{{$gradelevel->id}}" {{$gradelevel->id == old('gradelevel_id') ? 'selected' : ''}}>
                    {{$gradelevel->name}}
                  </option>
                  @empty
                  <option value="" selected>You need to add a gradelevel first.</option>
                  @endforelse
                </select>
                @if ($errors->has('gradelevel_id'))
                <span class="help-block align-left" style="color:red;">{{ $errors->first('gradelevel_id') }}</span>
                @endif
              </div>

              <div class="form-group">
                <label>Code*</label>
                <input type="text" class="form-control" name="code" id="code" placeholder="Enter subject code" value="{{old('code')}}">
                @if ($errors->has('code'))
                <span class="help-block align-left" style="color:red;">{{ $errors->first('code') }}</span>
                @endif
              </div>

              <div class="form-group">
                <label>Name*</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter subject name" value="{{old('name')}}">
                @if ($errors->has('name'))
                <span class="help-block align-left" style="color:red;">{{ $errors->first('name') }}</span>
                @endif
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
