@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/sections/content_header')

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        @include('v1/components/errors/flash_message')

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add Section</h3>

          </div>
          <form method="POST" action="{{ route('sections.store') }}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="card-body">

              <div class="form-group">
                <label>Schoolyear*</label>
                <select name="sy_id" id="sy_id" class="form-control">

                  @forelse($schoolyears as $sy)
                    <option value="{{$sy->id}}" {{$sy->is_active ? 'selected' : ''}}>{{$sy->start}}-{{$sy->end}}</option>
                  @empty
                    <option value="" selected>You need to add a schoolyear first.</option>
                  @endforelse
                </select>
                @if ($errors->has('sy_id'))
                  <span class="help-block align-left" style="color:red;">{{ $errors->first('sy_id') }}</span>
                @endif
              </div>

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
                <label>Adviser*</label>
                <select name="adviser_id" id="adviser_id" class="form-control">
                  <option value="" selected disabled>Select Adviser</option>
                  @forelse($advisers as $adviser)
                    <option value="{{$adviser->id}}" {{$adviser->id == old('adviser_id') ? 'selected' : ''}}>
                      {{$adviser->fullname}}
                    </option>
                  @empty
                    <option value="" selected>You need to add a faculty member first.</option>
                  @endforelse
                </select>
                @if ($errors->has('adviser_id'))
                  <span class="help-block align-left" style="color:red;">{{ $errors->first('adviser_id') }}</span>
                @endif
              </div>

              <div class="form-group">
                <label>Name*</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Section Name" value="{{old('name')}}">
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
