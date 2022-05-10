<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html" target="_blank">
        <span style="margin-right:5px;" class="login100-form-logo">
          <img src="/images/{{ Auth::user()->logo_url;}}" style="border-radius:100%;" width="50" height="50">
        </span>
        <span class="ms-1 font-weight-bold">{{ Auth::user()->name; }}</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/cooperate-customer-dashboard">
            <i class="fa-solid fa-house"></i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/company-info">
            <i class="fa-solid fa-building"></i>
            <span class="nav-link-text ms-1">Company's Info</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="/cooperate-customer-employees">
            <i class="fa-solid fa-person"></i>
            <span class="nav-link-text ms-1">Employees</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="/cooperate-customer-vehicles">
            <i class="fa-solid fa-car"></i>
            <span class="nav-link-text ms-1">Vehicle</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="/cooperate-customer-authorizepurchase">
            <i class="fa-solid fa-lock-open"></i>
            <span class="nav-link-text ms-1">Authorize Fuel Purchase</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="/my-account">
            <i class="fa-solid fa-gear"></i>
            <span class="nav-link-text ms-1">My Account</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"  onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						@csrf
						</form>
        </li>
  </aside>
