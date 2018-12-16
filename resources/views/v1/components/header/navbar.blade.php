<nav class="navbar navbar-expand-md navbar-dark" style="background-color:#563D7C;">
  <div class="container">
    <a class="navbar-brand" href="{{route('checkAuth')}}">
      <img src="https://laracasts.com/images/series/2018/solid-principles-in-php.svg" width="30" height="30" class="d-inline-block align-top"
        alt="">
      CFES | v1.0
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample07">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{route('checkAuth')}}">Home <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" style="white-space: nowrap;">Core Modules*</a>
          <div class="dropdown-menu" aria-labelledby="dropdown07">
            <a class="dropdown-item" href="#">Faculty*</a>
            <a class="dropdown-item" href="{{route('gradelevels.index')}}">Gradelevels</a>
            <a class="dropdown-item" href="#">Schedules*</a>
            <a class="dropdown-item" href="#">Users Management*</a>
            <a class="dropdown-item" href="#">Sections*</a>
            <a class="dropdown-item" href="#">Students*</a>
            <a class="dropdown-item" href="#">Subjects*</a>
            <a class="dropdown-item" href="#">School Year Setup*</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" style="white-space: nowrap;">Evaluation Settings*</a>
          <div class="dropdown-menu" aria-labelledby="dropdown07">
            <a class="dropdown-item" href="#">Questions*</a>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Reports*</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" style="white-space: nowrap;">Settings*</a>
          <div class="dropdown-menu" aria-labelledby="dropdown07">
            <a class="dropdown-item" href="#">My Profile*</a>
            <a class="dropdown-item" href="#">Account Settings*</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
              Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>

          </div>
        </li>
      </ul>

    </div>
  </div>
</nav>