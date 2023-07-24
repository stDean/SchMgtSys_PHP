<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="/assets/imgs/logo.png" alt="School Logo" style="width: 50px" />
      <b>My School</b>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">DASHBOARD</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/users">USERS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/classes">CLASSES</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/tests">TESTS</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            USER
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/profile">Profile</a></li>
            <li><a class="dropdown-item" href="/">Dashboard</a></li>
            <div class="dropdown-divider"></div>
            <li><a class="dropdown-item" href="/logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>