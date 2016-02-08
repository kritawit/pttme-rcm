<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>PTTME RCM Software</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      {!! HTML::style('public/bootstrap/css/bootstrap.min.css') !!}
      {!! HTML::style('public/css/font-awesome.min.css') !!}
      {!! HTML::style('public/css/css/ionicons.min.css') !!}
      {!! HTML::style('public/plugins/select2/select2.min.css') !!}
      {!! HTML::style('public/plugins/datatables/jquery.dataTables.min.css') !!}
      {!! HTML::style('public/dist/css/AdminLTE.css') !!}
      {!! HTML::style('public/dist/css/skins/_all-skins.css') !!}
      {!! HTML::style('public/plugins/iCheck/flat/blue.css') !!}
      {!! HTML::style('public/plugins/morris/morris.css') !!}
      {!! HTML::style('public/plugins/jvectormap/jquery-jvectormap-1.2.2.css') !!}
      {!! HTML::style('public/plugins/datepicker/datepicker3.css') !!}
      {!! HTML::style('public/plugins/daterangepicker/daterangepicker-bs3.css') !!}
      {!! HTML::style('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') !!}
      {!! HTML::style('public/easyui/themes/default/easyui.css') !!}
      {!! HTML::style('public/plugins/colorpicker/bootstrap-colorpicker.min.css') !!}

     <!--[if lt IE 9]>
      <script type="text/javascript" src="{{ asset('public/js/html5shiv.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('public/js/respond.min.js') }}"></script>
      <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-collapse sidebar-mini fixed">
    <div class="wrapper">
    @include('include.menu_top')
    @if(Session::has('project_id'))
        @include('include.menu_left')
    @else
        @include('include.menu_default')
    @endif
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        @yield('content')
      </div>
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
          <strong>Copyright &copy; 2015 <a href="http://www.smartoneinnovation.com">Smartone Innovation Solutions Co.,LTD</a>.</strong> All rights reserved.
      </footer>
    @include('include.menu_sidebar')
    </div><!-- ./wrapper -->
    <script type="text/javascript">
    $(function() {
        $(".select2").select2();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    </script>
  </body>
</html>
