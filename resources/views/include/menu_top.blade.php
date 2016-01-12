<header class="main-header">
  <!-- Logo -->
  <a href="{{url('/project')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>R</b>CM</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img src="{{ asset('public/login/assets/img/pttme.png') }}" alt="" style="height:50px;"/> <b>PTTME</b> RCM</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset('public/login/assets/img/photo.png') }}" alt="" class="img-circle" style="width:25px;" />
            <span class="hidden-xs">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{ asset('public/login/assets/img/photo.png') }}" alt=""  />
              <p>
                {{ Auth::user()->name }}
                <small>Last Login:</small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="{{ url('\logout') }}" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>