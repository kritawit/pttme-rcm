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
    <link href="{{ asset('public/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/iCheck/square/blue.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/login/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/login/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('public/material/dist/css/roboto.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/material/dist/css/ripples.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/material/dist/css/jquery.dropdown.css') }}">
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{ asset('public/js/html5shiv.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/respond.min.js') }}"></script>
    <![endif]-->
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

        #contact_problem label.error, #contact input.submit { color:red; }
        .get-in-touch
        {
            position: relative;
            margin: 0 auto;
            padding: 30px;
            max-width: 900px;
            border-radius: 2px;
            background: rgb(255, 255, 255) url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAGCAYAAACFIR03AAAAV0lEQVR42tXOMRWAQAwE0RWFDRTg5d47Jeg4Q9gI06RbqlwKil/P6LpXbDCf85AxEBtMGjKG/jyPUHUerfP4nEeoOo/Wedj5pOo8Wudh55Oq82idh51PLxpvled7kLAXAAAAAElFTkSuQmCC) repeat-x;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .get-in-touch input[type=text],.get-in-touch input[type=email], .get-in-touch textarea
        {
            background: rgb(235, 241, 245);
            color: rgb(36, 39, 41);
        }
        .get-in-touch  input:focus, .get-in-touch  textarea:focus {
            outline: 0;
            background: #FFF;
        }
        .btn
        {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 26px;
            font-weight: normal;
            line-height: 1.428571429;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            border: 1px solid transparent;
            border-radius: 4px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
            font-family: 'cs_prajadbold','RobotoDraft','Roboto','Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
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
                CONTACT US
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <p>&nbsp;</p>
                            <p>
                            <address>
                                <strong>PTT MAINTENANCE AND ENGINEERING COMPANY LIMITED</strong><br>
                                22/2 Pakornsongkoraj Rd.<br>
                                T.Maptaput, A.Mueang, Rayong. 21150<br>
                                <abbr title="Phone">P:</abbr> +66(0) 3897-7800<br>
                                <abbr title="Fax">F:</abbr> +66(0) 3897-7900 <br>
                                <abbr title="Email">E:</abbr> info@pttme.co.th
                            </address>
                            </p>
                            <form action="#" method="post" class="form" id="form_contact">
                                <div class="get-in-touch">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Telephone</label>
                                        <input type="text" class="form-control" id="tel" name="tel" placeholder="Telephone" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea class="form-control" rows="7" placeholder="Message" id="message" name="message" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary  btn-block">SEND</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            <p>&nbsp;</p>
                            <p><strong>MAP</strong></p>
                            <p>
                                <iframe src="https://www.google.com/maps/d/embed?mid=zgjJ0ScSXn3M.k2LfuiMCZMoo&hl=th" width="524" height="393" style="margin-top:15px;"></iframe>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="{{ asset('public/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });
    });
</script>
</body>
</html>