<html>

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

    <!-- bootstrap Lib -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="../jquery.toaster.js"></script>
    <!-- validation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
</head>
<style type="text/css">
    /*Main CSS*/

    .error {
        color: red;
        margin-left: 5px;
    }

    .form {
        width: 300px;
        height: 350px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8)50%, rgba(0, 0, 0, 0.8)50%);
        position: absolute;
        top: -20px;
        /* left: 870px; */
        border-radius: 10px;
        padding: 25px;
    }

    .form h2 {
        width: 220px;
        font-family: sans-serif;
        text-align: center;
        color: #ff7200;
        font-size: 22px;
        background-color: #fff;
        border-radius: 10px;
        margin: 2px;
        padding: 8px;
    }

    .form input {
        width: 240px;
        height: 35px;
        background: transparent;
        border-bottom: 1px solid #ff7200;
        border-top: none;
        border-right: none;
        border-left: none;
        color: #fff;
        font-size: 15px;
        letter-spacing: 1px;
        margin-top: 30px;
        font-family: sans-serif;
    }

    .form input:focus {
        outline: none;
    }

    ::placeholder {
        color: #fff;
        font-family: arial;
    }

    .btnn {
        width: 240px;
        height: 40px;
        background: #ff7200;
        border: none;
        margin-top: 30px;
        font-size: 18px;
        border-radius: 10px;
        cursor: pointer;
        color: #fff;
        transition: 0.4s ease;
    }

    .btnn:hover {
        background: #fff;
        color: #ff7200;
    }

    .btnn a {
        text-decoration: none;
        color: #000;
        font-weight: bold;
    }

    .form .link {
        font-family: arial, helvetica, sans-serif;
        font-size: 17px;
        padding-top: 20px;
        text-align: center;
    }

    .form .link a {
        text-decoration: none;
        color: #ff7200;
    }

    /*Login Signup Page*/
    a:focus,
    a:hover,
    a {
        outline: none;
        text-decoration: none;
    }

    li,
    ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .header-top i {
        font-size: 18px;
    }

    .bg-image {
        background: url(../images/background-login.jpg) no-repeat 0 0 / cover;
        position: relative;
        width: 100%;
        height: 100vh;
        display: table;
    }

    .login-header {
        display: inline-block;
        width: 100%;
        background: #0e1a35;
    }

    .login-signup {
        display: table-cell;
        vertical-align: middle;
        width: 100%;
    }

    .login-logo img {
        cursor: pointer;
        max-width: 171px;
        padding: 23px 15px 22px;
        width: 100%;
    }

    .login-header .navbar-right {
        margin-right: 0px;
    }

    .login-header .nav-tabs>li.active>a,
    .login-header .nav-tabs>li.active>a:focus,
    .login-header .nav-tabs>li.active>a:hover {
        background-color: transparent;
        border: none;
        color: #fff;
    }

    .login-header .nav-tabs>li>a {
        border: medium none;
        border-radius: 0;
        font-size: 14px;
        font-weight: 500;
        line-height: 48px;
        padding: 15px 30px;
        color: #fff;
    }

    .login-header .nav-tabs {
        border-bottom: none;
    }

    .login-header .nav-tabs>li {
        margin-bottom: 0px;
    }

    .login-header .nav>li>a:focus,
    .login-header .nav>li>a:hover {
        background: none;
        text-decoration: none;
    }

    .login-header .nav-tabs>li.active {
        border-bottom: 6px solid #5584ff;
    }

    .login-inner h1 {
        color: #8492af;
        font-size: 48px;
        font-weight: 300;
        text-align: center;
        margin-top: 0;
        margin-bottom: 20px;
    }

    .login-inner h1 span {
        color: #5584ff;
    }

    .login-form {
        text-align: center;
    }

    .login-form input {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border-color: -moz-use-text-color -moz-use-text-color #d4d9e3;
        border-image: none;
        border-style: none none solid;
        border-width: medium medium 1px;
        font-size: 13px;
        font-weight: 300;
        width: 100%;
        color: #8492af;
        padding: 15px 50px;
        font-size: 17px;
        max-width: 550px;
    }

    .login-form label {
        margin-bottom: 30px;
        width: 100%;
    }

    .user input {
        background: rgba(0, 0, 0, 0) url("../images/user.png") no-repeat scroll 7px 12px;
    }

    .pass input {
        background: rgba(0, 0, 0, 0) url("../images/password.png") no-repeat scroll 7px 12px;
    }

    .mail input {
        background: rgba(0, 0, 0, 0) url("../images/mail.png") no-repeat scroll 4px 12px;
    }

    .login-signup .tab-content {
        background: #ffffff none repeat scroll 0 0;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);
        display: inline-block;
        margin-top: -8px;
        width: 100%;
    }

    .form-btn {
        background: #5584ff none repeat scroll 0 0;
        border: medium none;
        border-radius: 100px;
        color: #ffffff;
        font-weight: 400;
        max-width: 250px;
        padding: 10px 0;
        position: relative;
        width: 100%;
        margin: 40px 0;
        box-shadow: 0 2px 8px #d2d2d2;
        -moz-box-shadow: 0 2px 8px #d2d2d2;
        -webkit-box-shadow: 0 2px 8px #d2d2d2;
    }

    .form-btn::before {
        content: "";
        font-family: FontAwesome;
        position: absolute;
        right: 17px;
        top: 9px;
    }

    .form-details {
        padding: 35px 0;
    }

    .tab-content .tab-pane {
        padding: 70px 0;
    }


    /*Login Signup Page*/


    /*Home Page*/

    .home {
        background: #f6f7fa;
    }

    #navigation {
        background: #0e1a35;
    }

    #navigation {
        padding: 0;
    }

    .display-table {
        display: table;
        padding: 0;
        height: 100%;
        width: 100%;
    }

    .display-table-row {
        display: table-row;
        height: 100%;
    }

    .display-table-cell {
        display: table-cell;
        float: none;
        height: 100%;
    }

    .v-align {
        vertical-align: top;
    }

    .logo img {
        max-width: 180px;
        padding: 16px 0 17px;
        width: 100%;
    }

    .header-top {
        margin: 0;
        padding-top: 2px;
    }

    .header-top img {
        border-radius: 50%;
        max-width: 48px !important;
        width: 100%;
    }

    .add-project {
        background: #5584ff none repeat scroll 0 0;
        border-radius: 100px;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        padding: 10px 27px 10px 45px;
        position: relative;
    }

    .header-rightside .nav>li>a:focus,
    .header-rightside .nav>li>a:hover {
        background: none;
        text-decoration: none;
    }

    .add-project::before {
        background: rgba(0, 0, 0, 0) url("../images/plus.png") no-repeat scroll 0 0;
        content: "";
        ;
        height: 12px;
        left: 17px;
        position: absolute;
        top: 12px;
        width: 12px;
    }

    .add-project:hover {
        color: #ffffff;
    }

    .header-top i {
        color: #0e1a35;
    }

    .icon-info {
        position: relative;
    }

    .navi i {
        font-size: 20px;
    }

    .label.label-primary {
        border-radius: 50%;
        font-size: 9px;
        left: 8px;
        position: absolute;
        top: -9px;
    }

    .icon-info .label {
        border: 2px solid #ffffff;
        font-weight: 500;
        padding: 3px 5px;
        text-align: center;
    }

    .header-top li {
        display: inline-block;
        text-align: center;
    }

    .header-top .dropdown-toggle {
        color: #0e1a35;
    }

    .header-top .dropdown-menu {
        border: medium none;
        left: -85px;
        padding: 17px;
    }

    .view {
        background: #5584ff none repeat scroll 0 0;
        border-radius: 100px;
        color: #ffffff;
        display: inline-block;
        font-size: 14px;
        font-weight: 600;
        margin-top: 10px;
        padding: 10px 15px;
    }

    .navbar-content>span {
        font-size: 13px;
        font-weight: 700;
    }

    .img-responsive {
        width: 100%;
    }

    #navigation {
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    .search input {
        border: none;
        font-size: 15px;
        padding: 15px 9px;
        width: 100%;
        background: rgba(0, 0, 0, 0) url("../images/search.png") no-repeat scroll 99% 12px;
        color: #8492af;
    }

    header {
        background: #ffffff none repeat scroll 0 0;
        box-shadow: 0 1px 12px rgba(0, 0, 0, 0.04);
        display: inline-block !important;
        line-height: 23px;
        padding: 15px;
        transition: all 0.5s ease 0s;
        width: 100%;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    .logo {
        text-align: center;
    }

    .navi a {
        border-bottom: 1px solid #0d172e;
        border-top: 1px solid #0d172e;
        color: #ffffff;
        display: block;
        font-size: 17px;
        font-weight: 500;
        padding: 28px 20px;
        text-decoration: none;
    }

    .navi i {
        margin-right: 15px;
        color: #5584ff;
    }

    .navi .active a {
        background: #122143;
        border-left: 5px solid #5584ff;
        padding-left: 15px;
    }

    .navi a:hover {
        background: #122143 none repeat scroll 0 0;
        border-left: 5px solid #5584ff;
        display: block;
        padding-left: 15px;
    }

    .navbar-default {
        background-color: #ffffff;
        border-color: #ffffff;
    }

    .navbar-toggle {
        border: none;
    }

    .navbar-default .navbar-toggle:focus,
    .navbar-default .navbar-toggle:hover {
        background-color: rgba(0, 0, 0, 0);
    }

    .navbar-default .navbar-toggle .icon-bar {
        background-color: #0e1a35;
    }

    .circle-logo {
        margin: 0 auto;
        max-width: 30px !important;
        text-align: center;
    }

    .hidden-xs {
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    .user-dashboard {
        padding: 0 20px;
    }

    .user-dashboard h1 {
        color: #0e1a35;
        font-size: 30px;
        font-weight: 500;
        margin: 0;
        padding: 21px 0;
    }

    .sales {
        background: #ffffff none repeat scroll 0 0;
        border: 1px solid #d4d9e3;
        display: inline-block;
        padding: 15px;
        width: 100%;
    }

    .sales button {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: 1px solid #dadee7;
        border-radius: 100px;
        font-size: 15px;
        letter-spacing: 0.5px;
        padding-right: 32px;
        color: #0e1a35;
    }

    .sales button::before {
        content: "";
        font-family: FontAwesome;
        position: absolute;
        right: 12px;
        top: 11px;
    }

    .sales .btn-group {
        float: right;
    }

    .sales h2 {
        color: #8492af;
        float: left;
        font-size: 21px;
        font-weight: 600;
        margin: 0;
        padding: 9px 0 0;
    }

    .btn.btn-secondary.btn-lg.dropdown-toggle>span {
        font-size: 15px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .sales .dropdown-menu {
        margin: 0px;
        padding: 0px;
        border: 0px;
        border-radius: 8px;
        width: 100%;
        color: #0e1a35;
    }

    .sales .btn-group.open .dropdown-toggle,
    .btn.active,
    .btn:active {
        box-shadow: none;
    }

    .sales .dropdown-menu>a {
        color: #0e1a35;
        display: inline-block;
        font-weight: 800;
        padding: 9px 0;
        text-align: center;
        width: 100%;
    }

    #my-cool-chart svg {
        width: 100%;
    }

    .sales .dropdown-menu>a:hover {
        color: #5584FF;
    }

    .shield-buttons {
        display: none;
    }

    .close,
    .close:focus,
    .close:hover {
        color: #fff;
        ;
        opacity: 1;
        text-shadow: none;
    }

    .modal-body input {
        border: 1px solid #d4d9e3;
        font-size: 14px;
        font-weight: 300;
        margin: 5px 0;
        padding: 14px 10px;
        width: 100%;
        color: #8492af;
    }

    .modal-body textarea {
        border: 1px solid #d4d9e3;
        font-size: 14px;
        font-weight: 300;
        height: 200px;
        margin-top: 5px;
        padding: 9px 10px;
        width: 100%;
        color: #8492af;
    }

    .modal-header.login-header h4 {
        color: #ffffff;
    }

    .modal-footer .add-project {
        background: #5584ff none repeat scroll 0 0;
        border: medium none;
        border-radius: 100px;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        padding: 10px 30px;
        position: relative;
    }

    .modal-footer .add-project::before {
        display: none;
    }

    .modal-footer {
        border: 0 none;
        padding: 10px 15px 26px;
        text-align: right;
    }

    .cancel {
        background: #0E1A35;
        border: medium none;
        border-radius: 100px;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        padding: 10px 30px;
        position: relative;

    }

    .modal {
        top: 20%;
    }

    .modal-header .close {
        margin-top: 2px;
    }

    .search input:focus {
        border-bottom: 1px solid #BDC4D4;
        line-height: 22px;
        transition: 0.1s all;
    }

    .modal-header.login-header {
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        /*Main CSS*/






        @media only screen and (max-device-width: 767px) {
            .login-logo img {
                margin: 0 auto;
            }

            .login-details .nav-tabs>li {
                text-align: center;
                width: 50%;
            }

            .login-signup .login-inner h1 {
                font-size: 26px;
                margin-bottom: 0;
                margin-top: 10px;
            }

            .login-inner .login-form input {
                font-size: 15px;
                max-width: 100%;
                padding: 15px 45px;
            }

            .login-inner .form-details {
                padding: 25px;
            }

            .login-inner .login-form label {
                margin-bottom: 20px;
                width: 100%;
            }

            .login-inner .form-btn {
                margin: 0;
                max-width: 180px;
            }

            .tab-content .tab-pane {
                padding: 20px 0;
            }

            #navigation .navi a {
                font-size: 14px;
                padding: 20px;
                text-align: center;
            }

            #navigation .navi i {
                margin-right: 0px;
            }

            #navigation .navi a:hover,
            #navigation .navi .active a {
                background: #122143 none repeat scroll 0 0;
                border-left: none;
                display: block;
                padding-left: 20px;
            }

            header .header-top img {
                max-width: 38px !important;
            }

            .v-align header {
                padding: 12px 15px;
            }

            header .header-top li {
                padding-left: 13px;
                padding-right: 6px;
            }

            .navbar-default .navbar-toggle {
                border-color: rgba(0, 0, 0, 0);
            }

            .navbar-header .navbar-toggle {
                float: left;
                margin: 0;
                padding: 0;
                top: 12px;
            }

            button,
            html [type="button"],
            [type="reset"],
            [type="submit"] {
                outline: medium none;
            }

            .user-dashboard .sales h2 {
                color: #8492af;
                float: left;
                font-size: 14px;
                font-weight: 600;
                margin: 0;
                padding: 13px 0 0;
            }

            .user-dashboard .btn.btn-secondary.btn-lg.dropdown-toggle>span {
                font-size: 11px;
            }

            .user-dashboard .sales button {
                font-size: 11px;
                padding-right: 23px;
            }

            .user-dashboard .sales h2 {
                font-size: 12px;
            }

            .gutter {
                padding: 0;
            }
        }

        @media only screen and (max-device-width: 992px) {
            header .header-top li {
                padding-left: 20px !important;
                padding-right: 0;
            }

            header .logo img {
                max-width: 125px !important;
            }

        }

        @media only screen and (min-device-width: 767px) and (max-device-width: 998px) {
            .user-dashboard .header-top {
                padding-top: 5px;
            }

            .user-dashboard .header-rightside {
                display: inline-block;
                float: left;
                width: 100%;
            }

            .user-dashboard .header-rightside .header-top img {
                max-width: 41px !important;
            }

            .user-dashboard .sales button {
                font-size: 10px;
            }

            .user-dashboard .btn.btn-secondary.btn-lg.dropdown-toggle>span {
                font-size: 12px;
            }

            .user-dashboard .sales h2 {
                font-size: 15px;
            }
        }

        @media only screen and (min-device-width:998px) and (max-device-width: 1350px) {
            #navigation .logo img {
                max-width: 130px;
                padding: 16px 0 17px;
                width: 100%;
            }
        }
    }
</style>

<body class="home">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="navi">
                    <ul>
                        <li class="active"><a href="index1.php"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li
                        <li><a href="index1.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">User Login</span></a></li>
                        <li><a href="../admin/adminregistration.php"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Admin Login</span></a></li>
                        <li><a href="registration.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">User Registration</span></a></li>
                        <li><a href="calender.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Calender</span></a></li>
                        <li><a href="qrcode.php"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Generate QR Code</span></a></li>>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
                <div class="row">
                    <header>
                        <div class="col-md-7">
                            <nav class="navbar-default pull-left">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                            </nav>
                            <div class="search hidden-xs hidden-sm">
                                <input type="text" placeholder="Search" id="search">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="header-rightside">
                                <ul class="list-inline header-top pull-right">
                                    <li class="hidden-xs"><a href="#" class="add-project" data-toggle="modal" data-target="#add_project">Add Project</a></li>
                                    <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                                    <li>
                                        <a href="#" class="icon-info">
                                            <i class="fa fa-bell" aria-hidden="true"></i>
                                            <span class="label label-primary">3</span>
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="../image/profile.png">
                                            <b class="caret"></b>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </header>
                </div>
                <div class="user-dashboard">
                    <h1>Hello, Mansi</h1>
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-12 gutter">

                            <div class="sales">
                                <h2>Your Sale</h2>

                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>Period:</span> Last Year
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="#">2012</a>
                                        <a href="#">2014</a>
                                        <a href="#">2015</a>
                                        <a href="#">2016</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12 gutter">

                            <div class="sales report">
                                <h2>Report</h2>
                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>Period:</span> Last Year
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="#">2012</a>
                                        <a href="#">2014</a>
                                        <a href="#">2015</a>
                                        <a href="#">2016</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br><br>
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-12 gutter">
                            <div class="form">
                                <h2>User Login Here</h2>
                                <form id="loginform" method="POST">
                                    <?php
                                    $conn = mysqli_connect("localhost", "root", "Jay@1234", "phonerecharge");
                                    ?>
                                    <input type="phone" name="phone" id="phone" placeholder="Enter Phone Here" required>
                                    <input type="password" name="password" id="password" placeholder="Enter Password Here" required>
                                    <input type="submit" name="login" value="Login" class="btnn">
                                    <p class="link">
                                        <a href="#" id="forgot_password" data-toggle="modal" data-target="#forgotpassModal">Forgot Password?</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12 gutter">
                                <div id="map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.2583140537417!2d72.83609491453656!3d21.221602985894297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04ee866307dcf%3A0x8277cdcb7d6df161!2sELaunch%20Solution%20Pvt.%20Ltd.%20-%20Website%2C%20Mobile%20App%20and%20Software%20Development%20Company%20in%20Surat!5e0!3m2!1sen!2sin!4v1661171151534!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <!-- Modal -->
    <div id="add_project" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Add Project</h4>
                </div>
                <div class="modal-body">
                    <input type="text" placeholder="Project Title" name="name">
                    <input type="text" placeholder="Post of Post" name="mail">
                    <input type="text" placeholder="Author" name="passsword">
                    <textarea placeholder="Desicrption"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <button type="button" class="add-project" data-dismiss="modal">Save</button>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="offcanvas"]').click(function() {
                $("#navigation").toggleClass("hidden-xs");
            });

            // Forot password modal validation
            $("#passwordForm").validate({
                rules: {
                    number: {
                        digits: true
                    }
                },
                message: {
                    number: {
                        digits: "Enter only Digits"
                    }
                }
            });

            //login form validation
            $("#loginform").validate({
                rules: {
                    phone: {
                        digits: true
                    }
                },
                message: {
                    phone: {
                        digits: "Enter only Digits"
                    }
                }
            });

            function disableBack() {
                window.history.forward();
            }
            setTimeout("disableBack()", 0);
            window.onunload = function() {
                null
            };

            //Login form
            $('#loginform').on('submit', function(e) {
                e.preventDefault();
                phone = $("#phone").val().trim();
                password = $("#password").val().trim();

                if ($(this).valid()) {
                    $.ajax({
                        url: "../database.php",
                        type: "POST",
                        data: {
                            phone: phone,
                            password: password,
                            method: 'login'
                        },
                        success: function(data) {
                            console.log("Ok");
                            if (data == "ok") {
                                window.location.href = "userDetail.php";
                            } else {
                                $.toaster({
                                    priority: 'danger',
                                    title: 'Error',
                                    message: 'Please Enter valid login details'
                                });
                            }
                        }
                    });
                }
            });

            // Send mail for get reset password link.
            $('body').on('submit', '#passwordForm', function(e) {
                e.preventDefault();
                if ($(this).valid()) {
                    mail = $("#mail").val().trim();
                    phone = $("#number").val().trim();
                    $("#send").attr('disabled', 'disabled');
                    $("#send").html("Please wait...")
                    $.ajax({
                        url: "../database.php",
                        type: "POST",
                        data: {
                            mail: mail,
                            phone: phone,
                            method: 'mail'
                        },
                        success: function(data) {
                            $(this).off("click").attr('href', "javascript: void(0);");
                            // console.log(data);
                            if (data == "1") {
                                $("#send").html("Send Mail");
                                $("#send").attr('disabled', false);
                                $('#forgotpassModal').modal('hide');
                                $.toaster({
                                    priority: 'success',
                                    title: 'success',
                                    message: 'Mail sent successfully.'
                                });
                            } else if (data == "2") {
                                $.toaster({
                                    priority: 'info',
                                    title: 'Info',
                                    message: 'You are not Registered yet'
                                });
                            } else if (data == "0") {
                                $.toaster({
                                    priority: 'danger',
                                    title: 'Error',
                                    message: 'Mail is not sent successfully'
                                });
                            }
                        }
                    });
                }
            });


            // Reset value in forgotpass Modal
            $('#forgotpassModal').on('hidden.bs.modal', function() {
                $('#forgotpassModal form')[0].reset();
                $('.error').removeClass('error');
                $('label').hide();
            });


        });
    </script>
</body>

</html>