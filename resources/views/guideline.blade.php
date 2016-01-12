<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PTTME RCM Software</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{ asset('public/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/css/ionicons.min.css') }}">
    <link href="{{ asset('public/dist/css/AdminLTE.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/iCheck/square/blue.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/login/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/login/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('public/fonts/stylesheet.css') }}">
    {!! HTML::style('public/plugins/datatables/jquery.dataTables.min.css') !!}
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{ asset('public/js/html5shiv.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/respond.min.js') }}"></script>
    <![endif]-->
    <script type="text/javascript" src="{{ asset('public/jwplayer/jwplayer.js') }}"></script>
    <script>jwplayer.key="EPIeSUw9/bYTKh/ygXf+GztqGf6Bujr4bh2IAg==";</script>
    <style type="text/css">
        .navbar-inverse.navbar{
            background-color:#03A9F4;
        }
        .profile-img
        {
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }
        .error {
            color: #ff0000;
            position:block;
        }

        html, body {
            height: 100%;
            font-size:16px;
        }
        .navbar-inverse .navbar-nav>li>a {
            color:#fff;
        }
        .navbar-inverse .navbar-brand {
            color:#fff;
        }

        .jwplayer {
            font-size:0.75em;
        }
    </style>

</head>
<body class="image-background">
<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./" >PTTME RCM Software</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse navbar-right">
                    <ul class="nav navbar-nav">

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="guideline">Guideline</a></li>
                        <li><a href="about">About</a></li>
                        <li><a href="contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<section>
    <div class="container" style="margin-top:70px;">
        <div class="panel panel-primary">
            <div class="panel-heading">
                VIDEO GUIDELINE
            </div>
            <div class="panel-body">
                <p>&nbsp;</p>
                <table class="table table-bordered" id="tb-video">
                    <thead>
                    <tr>
                        <th class="text-center">Guidelines</th>
                        <th class="text-center">VDO</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1. RCM Login</td>
                        <td>
                            <div id="rcm_login">Loading the player...</div>
                            <script type="text/javascript">
                                var playerInstance = jwplayer("rcm_login")
                                playerInstance.setup({
                                    file: "public/media/RCM_Login.mov",
                                    width: "400px",
                                    height: "225px",
                                    aspectratio: "16:9",
                                    title:'RCM Login',
                                    skin: {
                                        name: "stormtrooper"
                                    }
                                });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>2. RCM NEW PROJECT</td>
                        <td>
                            <div id="new_project">Loading the player...</div>
                            <script type="text/javascript">
                                var playerInstance = jwplayer("new_project")
                                playerInstance.setup({
                                    file: "public/media/RCM_New_Project.mov",
                                    width: "400px",
                                    height: "225px",
                                    aspectratio: "16:9",
                                    title:'RCM NEW PROJECT',
                                    skin: {
                                        name: "stormtrooper"
                                    }
                                });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>3. REFERENCE DATA -  EQUIPMENT CATEGORY</td>
                        <td>
                            <div id="equipment_category">Loading the player...</div>
                            <script type="text/javascript">
                                var playerInstance = jwplayer("equipment_category")
                                playerInstance.setup({
                                    file: "public/media/RCM_Reference_Data_Equipment_Category.mov",
                                    width: "400px",
                                    height: "225px",
                                    aspectratio: "16:9",
                                    title:'RCM REFERENCE DATA - EQUIPMENT CATEGORY',
                                    skin: {
                                        name: "stormtrooper"
                                    }
                                });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>4. REFERENCE DATA - EQUIPMENT TYPE</td>
                        <td>
                            <div id="equipment_type">Loading the player...</div>
                            <script type="text/javascript">
                                var playerInstance = jwplayer("equipment_type")
                                playerInstance.setup({
                                    file: "public/media/RCM_Reference_Data_Equipment_Type.mov",
                                    width: "400px",
                                    height: "225px",
                                    aspectratio: "16:9",
                                    title:'RCM REFERENCE DATA - EQUIPMENT TYPE',
                                    skin: {
                                        name: "stormtrooper"
                                    }
                                });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>5. REFERENCE DATA - EQUIPMENT PART</td>
                        <td>
                            <div id="equipment_part">Loading the player...</div>
                            <script type="text/javascript">
                                var playerInstance = jwplayer("equipment_part")
                                playerInstance.setup({
                                    file: "public/media/RCM_Reference_Data_Equipment_Part.mov",
                                    width: "400px",
                                    height: "225px",
                                    aspectratio: "16:9",
                                    title:'RCM REFERENCE DATA - EQUIPMENT PART',
                                    skin: {
                                        name: "stormtrooper"
                                    }
                                });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>6. REFERENCE DATA - FAILURE MODE</td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>7. REFERENCE DATA - FAILURE CAUSE</td>
                        <td>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="{{ asset('public/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/bootstrap/js/bootstrap.min.js') }}"></script>
{!! HTML::script('public/plugins/datatables/jquery.dataTables.min.js') !!}
<script type="text/javascript" src="{{ asset('public/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $("#tb-video").DataTable();
    });
</script>
</body>
</html>