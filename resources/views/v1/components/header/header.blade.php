<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
    </li>

    @php
        use \App\Model\SchoolYear, \App\Model\Semester, \App\Model\EvaluationSetting;
        $activeSY = SchoolYear::whereIsActive(true)->first();
        $activeSem = Semester::whereIsActive(true)->first();
        $evaluationSettings = EvaluationSetting::first();
        $startDate = date('M d, Y', strtotime($evaluationSettings->start_date));
        $endDate = date('M d, Y', strtotime($evaluationSettings->end_date));
    @endphp

    <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link">School Year:
            <i><b>{{$activeSY->start}} - {{$activeSY->end}}</b></i>
        </a>
    </li>

    <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link">Semester:
            <i><b>{{$activeSem->name}}</b></i>
        </a>
    </li>

    <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link">Evaluation Period:
            <i><b>{{$startDate}} - {{$endDate}}</b></i>
        </a>
    </li>

  </ul>

  <!-- SEARCH FORM -->
  <!-- <form class="form-inline ml-3">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fa fa-search"></i>
        </button>
      </div>
    </div>
  </form> -->

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fa fa-align-justify"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        {{-- <a href="#" class="dropdown-item">
            <i class="fas fa-user-circle" style="margin-right:10px;"></i>
            My Account *
        </a>
        <div class="dropdown-divider"></div> --}}
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault();"
            id="logoutBtn"
            class="dropdown-item">
            <i class="fas fa-sign-out-alt" style="margin-right:10px;"></i>
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </div>
    </li>
  </ul>
</nav>
