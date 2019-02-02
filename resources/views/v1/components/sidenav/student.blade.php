<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('checkAuth')}}" class="brand-link">
    <img src="https://laracasts.com/images/series/2018/solid-principles-in-php.svg" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">CFES | V1</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ !file_exists( public_path() . '/images/user_icons/' . Auth::user()->image) ?
          asset('images/user_icons/default.png') : asset('images/user_icons').'/'.Auth::user()->image }}"
          class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->firstname.' '.Auth::user()->lastname}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        {{-- <li class="nav-item
            {{ Request::is('/')
            ? 'has-treeview menu-open' : '' }}">
          <a href="{{route('checkAuth')}}" class="nav-link
            {{ Request::is('/')
            ? 'active' : '' }}">
            <i class="nav-icon fa fa-dashboard"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-calendar"></i>
            <p>My Schedule</p>
          </a>
        </li> --}}
        <li class="nav-item">
          <a href="{{ url('evaluateTeacherSelection') }}" class="nav-link
            {{ Request::is('evaluateTeacherSelection*') || Request::is('evaluateTeacher*')
            ? 'active' : '' }}">
            <i class="nav-icon fa fa-edit"></i>
            <p>Teacher Evaluation</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('studentComments.index') }}" class="nav-link
            {{ Request::is('studentComments*') ? 'active' : '' }}">
            <i class="nav-icon fa fa-comment"></i>
            <p>Comments</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
