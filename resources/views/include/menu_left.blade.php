<aside class="main-sidebar">
        <section class="sidebar">
          <div class="user-panel">
              <div class="pull-left image">
                  {!! HTML::image('public/login/assets/img/photo.png', 'User Image', array('class' => 'img-circle')) !!}
              </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->name }}</p>
              <a href="{{ url('dash-board/home') }}"><i class="fa fa-circle text-success"></i> {{ Session::get('project') }}</a>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="header">File</li>
            <li><a href="{{ url('project') }}"><i class="fa fa-circle-o text-red"></i> <span>New / Open Project</span></a></li>
            <li class="header">MAIN NAVIGATION</li>
            <li>
              <a href="{{ url('asset-register/l8detail') }}">
                <i class="fa fa-dashboard"></i> <span>Asset Register</span>
              </a>
            </li>
            <li>
              <a href="{{ url('package-assumption') }}">
                <i class="fa fa-cubes"></i> <span>Package and assumption</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-database"></i> <span>Basic data setup</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('basic-data-setup/equipment') }}"><i class="fa fa-circle-o"></i> Equipment</a></li>
                <li><a href="{{ url('basic-data-setup/failure') }}"><i class="fa fa-circle-o"></i> Failure</a></li>
                <li><a href="{{ url('basic-data-setup/task') }}"><i class="fa fa-circle-o"></i> Task</a></li>
              </ul>
            </li>
              <li>
                  <a href="{{ url('asset-register/l8detail') }}">
                      <i class="fa fa-eyedropper"></i> <span>FMECA</span>
                  </a>
              </li>
              <li>
                  <a href="{{ url('asset-register/l8detail') }}">
                      <i class="fa fa-tasks"></i> <span>Task Selection</span>
                  </a>
              </li>
              <li class="treeview">
                  <a href="#">
                      <i class="fa fa-cogs"></i> <span>Reference Data</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                      <li><a href="{{ url('reference-data/equipment/category') }}"><i class="fa fa-circle-o"></i> Equipment Category</a></li>
                      <li><a href="{{ url('reference-data/equipment/type') }}"><i class="fa fa-circle-o"></i> Equipment Type</a></li>
                      <li><a href="{{ url('reference-data/equipment/part') }}"><i class="fa fa-circle-o"></i> Equipment Part</a></li>
                      <li><a href="{{ url('reference-data/failure/mode') }}"><i class="fa fa-circle-o"></i> Failure Mode</a></li>
                      <li><a href="{{ url('reference-data/failure/cause') }}"><i class="fa fa-circle-o"></i> Failure Cause</a></li>
                      <li><a href="{{ url('reference-data/task/type') }}"><i class="fa fa-circle-o"></i> Task Type</a></li>
                      <li><a href="{{ url('reference-data/task/list') }}"><i class="fa fa-circle-o"></i> Task List</a></li>
                      <li><a href="{{ url('reference-data/task/interval') }}"><i class="fa fa-circle-o"></i> Task Interval Unit</a></li>
                  </ul>
              </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-clipboard"></i> <span>Reporting</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('report/equipment') }}"><i class="fa fa-circle-o"></i> Equipment</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i> Failure</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i> Task</a></li>
              </ul>
            </li>
          </ul>
        </section>
      </aside>