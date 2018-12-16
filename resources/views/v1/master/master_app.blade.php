<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>CFES | V1</title>
  @include('v1/components/scripts/css')
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    @include('v1/components/header/header')

    @switch(Auth::user()->role_id)
      @case(App\Model\Role::_ADMIN)
        @include('v1/components/sidenav/admin') @break
      @case(App\Model\Role::_FACULTY)
        @include('v1/components/sidenav/faculty') @break
      @case(App\Model\Role::_STUDENT)
        @include('v1/components/sidenav/student') @break
      @default
        @include('v1/components/sidenav/admin')
    @endswitch

    <!-- main content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    <!-- /.main content -->

    @include('v1/components/footer/footer')
  </div>

  @include('v1/components/scripts/js')
</body>

</html>