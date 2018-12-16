@extends('v1.master.master_app')

@section('content')

<h1>{{Auth::user()->role_id}}</h1>

@stop