@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/users/content_header')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @include('v1/components/errors/flash_message')

                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Add User</h3>
                    </div>
                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card-body">

                            <div class="form-group">
                                <label>Role*</label>
                                <select name="role_id" id="role_id" class="form-control">
                                    <option value="" selected disabled>Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}"
                                            {{$role->id == old('role_id') ? 'selected' : ''}}>
                                            {{$role->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role_id'))
                                <span class="help-block align-left" style="color:red;">{{
                                    $errors->first('role_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>First Name*</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter firstname"
                                    value="{{old('firstname')}}">
                                @if ($errors->has('firstname'))
                                <span class="help-block align-left" style="color:red;">{{ $errors->first('firstname') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Middle Name/Initial(Optional)</label>
                                <input type="text" class="form-control" name="middlename" id="middlename" placeholder="Enter middlename" value="{{old('middlename')}}">
                                @if ($errors->has('middlename'))
                                <span class="help-block align-left" style="color:red;">{{ $errors->first('middlename') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Last Name*</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter lastname" value="{{old('lastname')}}">
                                @if ($errors->has('lastname'))
                                <span class="help-block align-left" style="color:red;">{{ $errors->first('lastname') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Gender*</label><br>
                                <label class="radio-inline" style="margin-right:15px;font-weight:normal;">
                                    <input type="radio" name="gender" value="1" checked>Male
                                </label>
                                <label class="radio-inline" style="margin-right:15px;font-weight:normal;">
                                    <input type="radio" name="gender" value="0">Female
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Username*</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="{{old('username')}}">
                                @if ($errors->has('username'))
                                <span class="help-block align-left" style="color:red;">{{ $errors->first('username') }}</span>
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

<script type="text/javascript">
    $('#role_id').on('change', function () {
        var roleVal = $(this).val();
        console.log(roleVal)
    });
</script>

@stop
