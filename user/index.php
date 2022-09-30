<?php
session_start();
if (isset($_SESSION['userphone'])) {
    header('Location: userDetail.php');
    header('Location: forgotpass.php');
    header('Location: userTotalPost.php');
    header('Location: userTotalRechargeRequest.php');
}
?>
<html>

<head>
    <title>Webpage Using CSS</title>
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
    .error {
        color: red;
        margin-left: 5px;
    }

    * {
        margin: 0;
        padding: 0;
    }

    .main {
        width: 100%;
        background: linear-gradient(to top,
                rgba(0, 0, 0, 0.5)50%, rgba(0, 0, 0, 0.5)50%);
        background-position: center;
        background-size: cover;
        height: 109vh;
    }

    .navbar {
        width: 1200px;
        height: 75px;
        margin: auto;
    }

    .icon {
        width: 200px;
        float: left;
        height: 70px;
    }

    .logo {
        color: #ff7200;
        font-size: 35px;
        font-family: arial;
        padding-left: 10px;
        float: left;
        padding-top: 10px;
    }

    .menu {
        width: 400px;
        float: left;
        height: 70px;
    }

    ul {
        float: left;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    ul li {
        list-style: none;
        margin-left: 62px;
        margin-top: 27px;
        font-size: 14px;
    }

    ul li a {
        text-decoration: none;
        color: #fff;
        font-family: arial;
        font-weight: bold;
        transition: 0.4s ease-in-out;
    }

    ul li a:hover {
        color: #ff7200;
    }

    .search {
        width: 300px;
        float: left;
        margin-left: 270px;
    }

    .srch {
        font-family: 'Times New Roman';
        width: 200px;
        height: 40px;
        background: transparent;
        border: 1px solid #ff7200;
        margin-top: 13px;
        color: #fff;
        border-right: none;
        font-size: 16px;
        float: left;
        padding: 10px;
        border-bottom-left-radius: 5px;
    }

    .btn {
        width: 100px;
        height: 40px;
        background: #ff7200;
        border: 2px solid #ff7200;
        margin-top: 13px;
        color: #fff;
        font-size: 15px;
        border-bottom-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    .btn:focus {
        outline: none;
    }

    .srch:focus {
        outline: none;
    }

    .content {
        width: 1200px;
        height: auto;
        margin: auto;
        color: #fff;
        position: relative;
    }

    .content .par {
        padding-left: 20px;
        padding-bottom: 25px;
        font-family: arial;
        letter-spacing: 1.2px;
        line-height: 30px;
    }

    .content h1 {
        font-family: 'Times New Roman';
        font-size: 50px;
        padding-left: 20px;
        margin-top: 9%;
        letter-spacing: 2px;
    }

    .content .cn {
        width: 160px;
        height: 40px;
        background: #ff7200;
        border: none;
        margin-bottom: 10px;
        margin-left: 20px;
        font-size: 18px;
        border-radius: 10px;
        cursor: pointer;
        transition: .4s ease;
    }

    .content .cn a {
        text-decoration: none;
        color: #000;
        transition: .3s ease;
    }

    .cn:hover {
        background-color: #fff;
    }

    .content span {
        color: #ff7200;
        font-size: 65px;
    }

    .form {
        width: 300px;
        height: 350px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8)50%, rgba(0, 0, 0, 0.8)50%);
        position: absolute;
        top: -20px;
        left: 870px;
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

    .liw {
        padding-top: 15px;
        padding-bottom: 10px;
        text-align: center;
    }
</style>

<!-- Jquery Validation -->
<script type="text/javascript">
    $(document).ready(function() {

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

        //Add Post modal validation
        $("#addPost").validate({
            rules: {}
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

    });
</script>

<body background="../image/background.jpg" style="background-repeat: no-repeat; background-size: 100% 109%">
    <div class="navbar">
        <div class="icon">
            <h2 class="logo">Phone Recharge</h2>
        </div>
        <div class="menu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Add Post</a></li>
                <li><a href="#">Recharge</a></li>
                <li><a href="#">Post</a></li>
                <li><a href="#">Request</a></li>
            </ul>
        </div>
        <div class="search">
            <input class="srch" type="search" name="search" placeholder="Type To text">
            <a href="#"><button class="btn">Search</button></a>
        </div>
    </div>

    <div class="content">
        <h1>Web Design &<br><span>Devlopment</span><br>Class</h1><br>
        <p class="par"><b><u>Build</u></b> internship-grade tech-projects
            <br><b><u>Learn</u></b> Full Stack or Backend development hands-on
            <br><b><u>Grow</u></b> your career with real work experience
        </p>
        <button class="cn"><a href="registration.php">Registration</a></button>
        <button class="cn"><a href="../admin/adminregistration.php">Admin</a></button>
        <div class="form">
            <h2>User Login Here</h2>
            <form id="loginform" method="POST">
                <?php
                $conn = mysqli_connect("localhost", "root", "Jay@1234", "phonerecharge");
                ?>
                <input type="phone" name="phone" id="phone" placeholder="Enter Phone Here" required>
                <input type="password" name="password" id="password" placeholder="Enter Password Here" required>
                <input type="submit" name="login" value="Login" class="btnn">
                <p class="link">Forgot Password?<br>
                    <a href="#" id="forgot_password" data-toggle="modal" data-target="#forgotpassModal">Click Here</a>
                </p>
            </form>
        </div>
    </div>

    <!--Forgot Password Modal -->
    <div class="modal fade" id="forgotpassModal">
        <div class="modal-dialog">
            <form id="passwordForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-uppercase" id="forgotpassModalLabel">Enter Mail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label> Email:</label>
                        <input type="email" class="form-control" id="mail" name="mail" placeholder="Enter Your Email Id" required>
                    </div>
                    <div class="modal-body">
                        <label> Phone Number:</label>
                        <input type="phone" class="form-control" id="number" name="number" placeholder="Enter Your Phone Number" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="send">Send Mail</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script -->
    <script type="text/javascript">
        $(document).ready(function() {

            function disableBack() { window.history.forward(); }
            setTimeout("disableBack()", 0);
            window.onunload = function () { null };

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