@extends('v1.master.master_app')

@section('content')

@include('v1/views/shared/sy/content_header')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            @include('v1/components/errors/flash_message')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of SY
                        <span class="pull-right">
                            <a href="{{route('sy.create')}}" class="btn btn-md btn-success">Add SY</a>
                        </span>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="sy-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Schoolyear</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sy as $sy1)
                            <tr>
                                <td>{{$sy1->start}} - {{$sy1->end}}</td>
                                <td>{{$sy1->created_at}}</td>
                                <td>
                                    <form method="POST" action="{{route('sy.destroy', ['id' => $sy1->id])}}">
                                        @if(!$sy1->is_active)
                                            <a href="{{route('sy.setAsActive', ['id' => $sy1->id])}}"
                                                class="btn btn-sm btn-success"
                                                onclick="return confirm('Are you sure you want to set this as the active schoolyear?');">
                                                Set As Active
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-sm btn-default"><i>Currently Active</i></a>
                                        @endif
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        @if(!$sy1->is_active)
                                            <button
                                                type="submit"
                                                onclick="return confirm('Are you sure you want to delete this schoolyear?');"
                                                class="btn btn-sm btn-danger">
                                                Delete
                                            </button>
                                        @endif
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
