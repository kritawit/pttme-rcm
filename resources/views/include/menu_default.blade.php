<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
              <div class="pull-left image">
                  {!! HTML::image('public/login/assets/img/photo.png', 'User Image', array('class' => 'img-circle')) !!}
              </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->name }}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
          <li><a href="{{ url('dash-board') }}"><i class="fa fa-circle-o text-red"></i> <span>New / Open Project</span></a></li>
          </ul>
    </section>
        <!-- /.sidebar -->
</aside>