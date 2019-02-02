@extends('v1.master.master_app')

@section('content')

@include('v1/views/admin/faculties/content_header')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            @include('v1/components/errors/flash_message')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Faculties</h3>
                </div>
                <div class="card-body">
                    <table id="faculty-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Employee #</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faculties as $faculty)
                            <tr>
                                <td>
                                    <center>
                                        <img src="{{ !file_exists( public_path() . '/images/user_icons/' . $faculty->image) ?
                                        asset('images/user_icons/default.png') : asset('images/user_icons').'/'.$faculty->image }}"
                                        class="img-circle elevation-2" style="height:50px;width:50px;" alt="User Image">
                                    </center>
                                </td>
                                <td>{{$faculty->fullname}}</td>
                                <td>{{$faculty->gender}}</td>
                                <td>{{$faculty->employee_no}}</td>
                                <td>{{$faculty->email}}</td>
                                <td>{{$faculty->is_active ? 'Active User' : 'Inactive User'}}</td>
                                <td>{{$faculty->created_at}}</td>
                                <td>
                                    @if($faculty->is_active)
                                        <a href="{{route('faculties.toggle_activation', ['userID' => $faculty->id])}}"
                                            class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">
                                            Deactivate User
                                        </a>
                                    @else
                                        <a href="{{route('faculties.toggle_activation', ['userID' => $faculty->id])}}"
                                            class="btn btn-sm btn-success" onclick="return confirm('Are you sure?');">
                                            Activate User
                                        </a>
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
