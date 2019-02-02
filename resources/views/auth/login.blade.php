@extends('v1.master.master_login')

@section('content')

<form class="form-signin" method="POST" action="{{ route('login') }}">
    @csrf

    <img class="mb-4" src="https://laracasts.com/images/series/2018/solid-principles-in-php.svg" alt="" width="120" height="120">

    <h1 class="h3 mb-3 font-weight-normal">CFES | v1.0</h1>
    @include('v1/components/errors/flash_message')
    <label class="sr-only">Username</label>
    <input id="username" type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="Username" required autofocus>

    <label class="sr-only">Password</label>
    <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>

    @if ($errors->has('username'))
        <small>
            <p style="color:red;font-weight:bold;">{{ $errors->first('username') }}</p>
        </small>
    @endif

    @if ($errors->has('password'))
        <strong>{{ $errors->first('password') }}</strong>
    @endif

    <div class="checkbox mb-3">
        <label>
            <a href="{{ route('password.request') }}">Forgot password?</a>
        </label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
    {{-- <button class="btn btn-lg btn-success btn-block" type="submit">Faculty Evaluation</button> --}}
    <p class="mt-5 mb-3 text-muted">&copy; {{ \Carbon\Carbon::now()->year }} - {{ \Carbon\Carbon::now()->format('Y')+1 }}</p>
</form>


@endsection
