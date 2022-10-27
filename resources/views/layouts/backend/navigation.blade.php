<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-flex items-center">
        <x-responsive-nav-link class="text-gray-500" :href="route('admin-dashboard')" :active="request()->routeIs('admin-dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
      </li>

    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <span>{{ Auth::user()->name }}</span>
            <i class="fa fa-chevron-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right m-auto text-center">
          <button type="button" class="btn btn-light w-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
          </button>
        </div>
      </li>
    </ul>
  </nav>
