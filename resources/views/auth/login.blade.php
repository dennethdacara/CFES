@extends('v1.master.master_login')

@section('content')

<form class="form-signin" method="POST" action="{{ route('login') }}">
    @csrf

    <img class="mb-4" src="https://laracasts.com/images/series/2018/solid-principles-in-php.svg" alt="" width="120" height="120">
    <h1 class="h3 mb-3 font-weight-normal">CFES | v1.0</h1>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email address" required autofocus>

    <label for="inputPassword" class="sr-only">Password</label>
    <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>

    @if ($errors->has('email'))
        <small>
            <p style="color:red;font-weight:bold;">{{ $errors->first('email') }}</p>
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
    <button class="btn btn-lg btn-success btn-block" type="submit">Faculty Evaluation</button>
    <p class="mt-5 mb-3 text-muted">&copy; {{ \Carbon\Carbon::now()->year }} - {{ \Carbon\Carbon::now()->format('Y')+1 }}</p>
</form>


@endsection
