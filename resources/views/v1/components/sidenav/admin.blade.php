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
        <li class="nav-item {{ Request::is('/') ? 'has-treeview menu-open' : '' }}">
          <a href="{{route('checkAuth')}}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
            <i class="nav-icon fa fa-dashboard"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item has-treeview
            {{ Request::is('gradelevels*') || Request::is('sections*') ||
            Request::is('subjects*') || Request::is('sy*')
            || Request::is('questions*') ? 'has-treeview menu-open' : '' }}">
          <a href="#" class="nav-link
            {{ Request::is('gradelevels*') || Request::is('sections*') ||
            Request::is('subjects*') || Request::is('sy*')
            || Request::is('questions*') ? 'active' : '' }}">
            <i class="nav-icon fa fa-th"></i>
            <p>Core Modules<i class="right fa fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher nav-icon"></i>
                <p>Faculty *</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('gradelevels.index')}}" class="nav-link {{ Request::is('gradelevels*') ? 'active' : '' }}">
                <i class="fas fa-graduation-cap nav-icon"></i>
                <p>Gradelevels</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link {{ Request::is('schedules*') ? 'active' : '' }}">
                <i class="fas fa-calendar-week nav-icon"></i>
                <p>Schedules *</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                <i class="fas fa-users nav-icon"></i>
                <p>Users *</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('sections.index')}}" class="nav-link {{ Request::is('sections*') ? 'active' : '' }}">
                <i class="fas fa-school nav-icon"></i>
                <p>Sections</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link {{ Request::is('students*') ? 'active' : '' }}">
                <i class="fas fa-user-graduate nav-icon"></i>
                <p>Students *</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('subjects.index')}}" class="nav-link {{ Request::is('subjects*') ? 'active' : '' }}">
                <i class="fas fa-book-open nav-icon"></i>
                <p>Subjects</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('sy.index')}}" class="nav-link {{ Request::is('sy*') ? 'active' : '' }}">
                <i class="fas fa-university nav-icon"></i>
                <p>Schoolyear</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{route('questions.index')}}" class="nav-link {{ Request::is('questions*') ? 'active' : '' }}">
            <i class="nav-icon fa fa-question"></i>
            <p>Questions</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-file-contract nav-icon"></i>
            <p>Reports *</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
