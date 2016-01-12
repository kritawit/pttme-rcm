<?php           ob_start();
                session_start();

                $username_login = $_SESSION['username_login'];

                $config_file = "../configuration.php";

                if (file_exists($config_file)) {
                    include_once "../configuration.php";
                }
                else
                {
                    header ('Location:../installation/');
                }

                if ($rcm_database_type=='MySQLi')
                {
                    include_once '../dbconn/mysql.php';
                }

                $username = $dbh->query("SELECT * FROM tbl_login WHERE username='".$username_login."'");
                $username_data = $username->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PTTME RCM Software</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="../css/font-awesome.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="../css/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="../js/html5shiv.min.js"></script>
    <script src="../js/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="../js/jstree/dist/themes/default/style.css" />
    <link href="../js/jquery-ui.css" type="text/css" rel="stylesheet" />

    <style type="text/css">
        .skin-blue .main-header .logo {
            background-color: #03A9F4;
        }
        .skin-blue .main-header .navbar {
            background-color: #039BE5;
        }
        .hasmenu, .hasmenu2 {
            width: 30px;
        }

    </style>
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="./" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>RCM</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>RCM Workflow</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="../css/login/assets/img/photo.png" class="user-image" alt="User Image"/>
                            <span class="hidden-xs"><?=$username_data['fullname'];?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="../css/login/assets/img/photo.png" class="img-circle" alt="User Image" />
                                <p>
                                    <?=$username_data['fullname'];?>
                                    <small>Last Login:</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="../css/login/assets/img/photo.png" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p><?=$username_data['fullname'];?></p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active treeview">
                    <a href="asset_register.php">
                        <i class="fa fa-dashboard"></i> <span>Asset Register</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>Package and Assumption</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-th"></i> <span>Basic data setup</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>FMECA</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>Task Selection</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>Reporting</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Table Report Data</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Graph Report Data</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> RCM Result</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> RCM Data</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>User Management</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cog"></i> <span>Tools</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Import RCM database</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Export RCM database</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Restore to default settings</a></li>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Asset Register
            </h1>
            <ol class="breadcrumb">
                <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Asset Register</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <!-- small box -->
                    <div class="panel panel-default">
                        <div class="panel panel-heading">
                            <h3>ASSET HIERARCHY</h3>
                        </div>
                        <div class="panel-body">
                            <div>
                                <a href="add_new_node_screen.php" class="btn btn-default"><i class="fa fa-plus"></i>&nbsp;Add new node parent</a>
                                <a href="import_asset_hierarchy.php" class="btn btn-default"><i class="fa fa-file-excel-o"></i>&nbsp;Import asset hierarchy</a>
                            </div>
                            <p>&nbsp;</p>
                            <div id="jstree">
                                <ul>
                                    <li>PTT Maintenance and Engineering
                                       <ul>
                                           <?php
                                            $node_parent = $dbh->query("SELECT * FROM tbl_node WHERE node_parent_id IS NULL ORDER BY record_id");
                                            while ($node_parent_data = $node_parent->fetch())
                                            {
                                           ?>
                                                <li><span onClick="javascript:window.location.href='view_node_detail.php?node_id=<?=$node_parent_data['record_id'];?>'"><?=$node_parent_data['node_name'];?></span>
                                                    <ul>
                                                    <?php
                                                        $sub_node_parent_1 = $dbh->query("SELECT * FROM tbl_node WHERE node_parent_id='".$node_parent_data['record_id']."'");
                                                        while ($sub_node_parent_data_1 = $sub_node_parent_1->fetch())
                                                        {
                                                    ?>
                                                        <li><span onClick="javascript:window.location.href='view_node_detail.php?node_id=<?=$sub_node_parent_data_1['record_id'];?>'"><?=$sub_node_parent_data_1['node_name'];?></span>
                                                            <ul>
                                                                <?php
                                                                $sub_node_parent_2 = $dbh->query("SELECT * FROM tbl_node WHERE node_parent_id='".$sub_node_parent_data_1['record_id']."'");
                                                                    while ($sub_node_parent_data_2 = $sub_node_parent_2->fetch())
                                                                    {
                                                                 ?>
                                                                    <li><span onClick="javascript:window.location.href='view_node_detail.php?node_id=<?=$sub_node_parent_data_2['record_id'];?>'"><?=$sub_node_parent_data_2['node_name'];?></span>
                                                                        <ul>
                                                                            <?php
                                                                                $sub_node_parent_3 = $dbh->query("SELECT * FROM tbl_node WHERE node_parent_id='".$sub_node_parent_data_2['record_id']."'");
                                                                                while ($sub_node_parent_data_3 = $sub_node_parent_3->fetch())
                                                                                {
                                                                            ?>
                                                                            <li><span onClick="javascript:window.location.href='view_node_detail.php?node_id=<?=$sub_node_parent_data_3['record_id'];?>'"><?=$sub_node_parent_data_3['node_name'];?></span>
                                                                                <ul>
                                                                                    <?php
                                                                                        $sub_node_parent_4 = $dbh->query("SELECT * FROM tbl_node WHERE node_parent_id='".$sub_node_parent_data_3['record_id']."'");
                                                                                        while ($sub_node_parent_data_4 = $sub_node_parent_4->fetch())
                                                                                        {
                                                                                    ?>
                                                                                    <li><span onClick="javascript:window.location.href='view_node_detail.php?node_id=<?=$sub_node_parent_data_4['record_id'];?>'"><?=$sub_node_parent_data_4['node_name'];?></span>
                                                                                        <ul>
                                                                                            <?php
                                                                                                $sub_node_parent_5 = $dbh->query("SELECT * FROM tbl_node WHERE node_parent_id='".$sub_node_parent_data_4['record_id']."'");
                                                                                               while ($sub_node_parent_data_5 = $sub_node_parent_5->fetch())
                                                                                               {
                                                                                            ?>
                                                                                            <li><span onClick="javascript:window.location.href='view_node_detail.php?node_id=<?=$sub_node_parent_data_5['record_id'];?>'"><?=$sub_node_parent_data_5['node_name'];?></span>
                                                                                                <ul>
                                                                                                    <?php
                                                                                                        $sub_node_parent_6 = $dbh->query("SELECT * FROM tbl_node WHERE node_parent_id='".$sub_node_parent_data_5['record_id']."'");
                                                                                                        while ($sub_node_parent_data_6 = $sub_node_parent_6->fetch())
                                                                                                        {
                                                                                                    ?>
                                                                                                    <li><span onClick="javascript:window.location.href='view_node_detail.php?node_id=<?=$sub_node_parent_data_6['record_id'];?>'"><?=$sub_node_parent_data_6['node_name'];?></span></li>
                                                                                                    <?php
                                                                                                        }
                                                                                                    ?>
                                                                                                </ul>
                                                                                            </li>
                                                                                            <?php
                                                                                               }
                                                                                            ?>
                                                                                        </ul>
                                                                                    </li>
                                                                                    <?php
                                                                                        }
                                                                                    ?>
                                                                                </ul>
                                                                            </li>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </ul>
                                                                    </li>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                    <?php
                                                        }
                                                    ?>
                                                    </ul>
                                                </li>
                                           <?php
                                            }
                                           ?>
                                       </ul>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div><!-- ./col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <div class="modal fade" id="AddNewNode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add New Node Parent</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" action="submit_node_data.php" method="post">
                        <div class="form-group">
                            <label class="col-sm-4 label_content">Node Name:</label>

                            <div class="col-sm-3 input-group">
                                <input type="text" name="node_name" id="node_name" class="form-control" required>
                            </div>
                        </div>
                        <div align="right">
                            <button type="submit" class="btn btn-primary">Save Data</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2015 <a href="http://www.smartoneinnovation.com">Smartone Innovation Solutions Co.,LTD.</a></strong> All rights reserved.
    </footer>

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class='control-sidebar-bg'></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- jQuery UI 1.11.2 -->
<script src="../js/jquery-ui.min.js" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/jstree/dist/jstree.min.js"></script>
<script>
    $(function ()
    {
        //create an instance when the DOM is ready
        $('#jstree').jstree();
        //bind to events triggered on the tree
        $('#jstree').on("changed.jstree", function (e, data) {
            console.log(data.selected);
        });
        //interact with the tree - either way is OK
        $('button').on('click', function () {
            $('#jstree').jstree(true).select_node('child_node_1');
            $('#jstree').jstree('select_node', 'child_node_1');
            $.jstree.reference('#jstree').select_node('child_node_1');
        });
    });
</script>
<script src="../js/contextmenu/jquery.ui-contextmenu.js"></script>
<script>
    $("#jstree").contextmenu({
        delegate: ".hasmenu",
        menu: [
            {title: "Add", cmd: "Add"},
            {title: "----"},
            {title: "Edit", cmd: "Edit"},
            {title: "----"},
            {title: "Remove", cmd: "Remove"},
        ],
        select: function(event, ui) {
            alert("select " + ui.cmd + " on " + ui.target.text());
        }
    });
</script>
<!-- Morris.js charts -->
<script src="../js/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
<script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js" type="text/javascript"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js" type="text/javascript"></script>
</body>
</html>