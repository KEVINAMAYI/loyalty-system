<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-house p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="/staff-dashboard" target="_blank">
      <span style="margin-right:5px;" class="login100-form-logo">
      <img src="staff/assets/img/logo.jpg" style="border-radius:100%;" width="70" height="70">
      </span>
            <span class="ms-1 font-weight-bold">OLA</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-150 h-120" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link  "href="/users">
                    <i class="fa-solid fa-users"></i>
                    <span class="nav-link-text ms-1">Staff</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  "href="/customers">
                    <i class="fa-solid fa-person"></i>
                    <span class="nav-link-text ms-1">Customers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  "href="/vehicles">
                    <i class="fa-solid fa-car"></i>
                    <span class="nav-link-text ms-1">Vehicles</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  "href="/corporates">
                    <i class="fa-solid fa-city"></i>
                    <span class="nav-link-text ms-1">Registered Corporates</span>
                </a>
            </li>
            @if(auth()->user()->major_role == 'Admin')
            <li class="nav-item">
                <a class="nav-link  "href="/organizations">
                    <i class="fa-solid fa-city"></i>
                    <span class="nav-link-text ms-1">Organizations</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link  "href="/authorized-purchases">
                    <i class="fa-solid fa-building"></i>
                    <span class="nav-link-text ms-1">Authorized Purchases</span>
                </a>
            </li>
            @if(auth()->user()->major_role == 'Admin' || auth()->user()->major_role == 'Admin')
            <li class="nav-item">
                <a class="nav-link  "href="/sales">
                    <i class="fa-solid fa-dollar"></i>
                    <span class="nav-link-text ms-1">Sales</span>
                </a>
            </li>
            @endif
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link  "href="/redeem-discount">--}}
{{--                    <i class="fa-solid fa-money-bill-wave"></i>--}}
{{--                    <span class="nav-link-text ms-1">Redeem Discount</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="nav-item">
                <a class="nav-link" href="/discounts">
                    <i class="fa-solid fa-money-bill"></i>
                    <span class="nav-link-text ms-1">Manual Discounts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/automatic-discounts">
                    <i class="fa-solid fa-credit-card"></i>
                    <span class="nav-link-text ms-1">Automatic Discounts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  "href="/rewards">
                    <i class="fa-solid fa-trophy"></i>
                    <span class="nav-link-text ms-1">Rewards & Products</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link  "href="/reports">
                    <i class="fa-solid fa-file"></i>
                    <span class="nav-link-text ms-1">Reports</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link  " href="/choose-option">
                    <i class="fa-solid fa-hand"></i>
                    <span class="nav-link-text ms-1">Choose Option</span>
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
        </ul>
    </div>
</aside>
