@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/users/content_header')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            @include('v1/components/errors/flash_message')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Users
                        <span class="pull-right">
                            <a href="{{route('users.create')}}" class="btn btn-md btn-success">Add User</a>
                        </span>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="users-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Gender</th>
                                <th>Username</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    <center>
                                        <img src="{{ $user->image == null ? asset('images/user_icons/admin.png') : asset('images/user_icons').'/'.$user->image }}" style="height:50px;width:50px;">
                                    </center>
                                </td>
                                <td>{{$user->fullname}}</td>
                                <td>{{$user->role}}</td>
                                <td>{{$user->gender}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    @if(Auth::user()->id == $user->id)
                                        No action/s available
                                    @else
                                    <form method="POST" action="{{route('users.destroy', ['id' => $user->id])}}">
                                        <a href="{{route('users.edit', ['id' => $user->id])}}" class="btn btn-sm btn-primary">Edit</a>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this user?');"
                                            class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                    @endif
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
