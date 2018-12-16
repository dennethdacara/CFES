@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/sections/content_header')

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        @include('v1/components/errors/flash_message')

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Edit Section: <i>{{$section->name}}</i></h3>

          </div>
          <form method="POST" action="{{route('sections.update', ['id' => $section->id])}}" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="section_id" value="{{ $section->id }}">
            {{csrf_field()}}

            <div class="card-body">

              <div class="form-group">
                <label>Schoolyear*</label>
                <select name="sy_id" id="sy_id" class="form-control">
                  @forelse($schoolyears as $sy)
                    <option value="{{$sy->id}}" {{$sy->id == $section->sy_id ? 'selected' : ''}}>
                      {{$sy->start}}-{{$sy->end}}
                    </option>
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
                  <option value="{{$gradelevel->id}}" {{$gradelevel->id == $section->gradelevel_id ? 'selected' : ''}}>
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
                  <option value="{{$adviser->id}}" {{$adviser->id == $section->adviser_id ? 'selected' : ''}}>
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
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Section Name" value="{{$section->name}}">
                @if ($errors->has('name'))
                <span class="help-block align-left" style="color:red;">{{ $errors->first('name') }}</span>
                @endif
              </div>

            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary pull-right">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@stop