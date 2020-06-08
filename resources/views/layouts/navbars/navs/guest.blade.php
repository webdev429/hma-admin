<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('material') }}/img/logo.png" alt="HMA" style="margin-top:-15px;" /></a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item{{ $activePage == 'deal_list' ? ' active' : '' }} ">
          <a href="{{ route('welcome') }}" class="nav-link">
            <i class="material-icons">home</i> {{ __('Home') }}
          </a>
        </li>
        @auth()
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link">
            <i class="material-icons">dashboard</i> {{ __('Dashboard') }}
          </a>
        </li>
        @endauth
        <li class="nav-item{{ $activePage == 'publish' ? ' active' : '' }} ">
          <a href="" class="nav-link">
            <i class="material-icons">publish</i> {{ __('Publish your Offer') }}
          </a>
        </li>
        <!-- <li class="nav-item{{ $activePage == 'pricing' ? ' active' : '' }} ">
          <a href="{{ route('page.pricing') }}" class="nav-link">
            <i class="material-icons">shopping_basket</i> {{ __('Pricing') }}
          </a>
        </li> -->
        @if (!auth()->user())
        <li class="nav-item{{ $activePage == 'register' ? ' active' : '' }}">
          <a href="{{ route('register') }}" class="nav-link">
            <i class="material-icons">person_add</i> {{ __('Register') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'login' ? ' active' : '' }}">
          <a href="{{ route('login') }}" class="nav-link">
            <i class="material-icons">fingerprint</i> {{ __('Login') }}
          </a>
        </li>
        @endif
        <!-- <li class="nav-item{{ $activePage == 'lock' ? ' active' : '' }} ">
          <a href="{{ route('page.lock') }}" class="nav-link">
            <i class="material-icons">lock_open</i> {{ __('Lock') }}
          </a>
        </li> -->
        @auth()
          <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                  <i class="material-icons">directions_run</i>
                  <span>{{ __('Logout') }}</span>
              </a>
          </li>
        @endauth
        <li class="nav-item">
          <a href="" class="nav-link dropdown-toggle" id="dropdownW" data-toggle="dropdown" ara-haspopup="true" aria-expanded="false">
            {{ __('ENG/USD/IMP') }}
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownW">
            <div class="dropdown-item">
              <select class="selectpicker" name="language" id="language" data-style="select-with-transition">
                <option value="United States">United States</option>
                <option value="Canada">Canada</option>
                <option value="Mexico">Mexico</option>
              </select>
            </div>
            <div class="dropdown-item">
              <select class="selectpicker" name="currency" id="currency" data-style="select-with-transition">
                <option value="USD">USD</option>
                <option value="CAD">CAD</option>
                <option value="MXN">MXN</option>
              </select>
            </div>
            <div class="dropdown-item">
              <select class="selectpicker" name="etc" id="etc" data-style="select-with-transition">
                <option value="Imperial">Imperial</option>
                <option value="Imperial1">Imperial1</option>
                <option value="Imperial2">Imperial2</option>
              </select>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
<style>
  .dropdown-menu {
    top: 80%;
    left: calc(100% - 300px);
  }

  .dropdown-item .dropdown:hover .dropdown-content {
    display:block !important;
  }
</style>
<script>
  $(document).ready(function() {
    $(".selectpicker").selectpicker();
  });
</script>