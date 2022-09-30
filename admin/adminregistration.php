<?php
session_start();
if (isset($_SESSION['adminphone'])) {
    header('Location: adminDetail.php');
}
?>
<html>

<head>
    <title>Admin Registration Form</title>
    <!-- Required meta tags -->

    <!-- bootstrap Lib -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- validation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script src="../jquery.toaster.js"></script>

</head>
<style type="text/css">
    #login {
        margin-left: 1100px;
    }

    .error {
        color: red;
        margin-left: 5px;
    }

    .input {
        height: 40px;
        width: 300px;
        font-size: 15px;
        font-weight: bold;
        border-top-left-radius: 15px;
        border-bottom-right-radius: 15px;
        border-bottom-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .input1 {
        height: 40px;
        width: 920px;
        border-radius: 15px;
    }

    td {
        font-size: 20px;
        font-weight: bold;
    }

    .button1 {
        height: 50px;
        width: 150px;
        border-top-left-radius: 25px;
        border-bottom-right-radius: 25px;
        border-bottom-left-radius: 25px;
        border-top-right-radius: 25px;
        background: dodgerblue;
        border-style: outset;
        color: white;
    }

    .button1:hover {
        background: steelblue;
    }

    .label {
        text-align: left;
    }
</style>

<!-- Jquery Validation -->
<script type="text/javascript">
    $(document).ready(function() {

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

<body>
    <h1 align="center">
        <font size="10">Admin LogIn</font>
    </h1>
    <center>
        <div class="container">
            <form id="loginform" method="POST">

                <!-- Phone  -->
                <input type="phone" name="phone" id="number" class="form-control" required placeholder="Enter Phone Number" /><br>

                <!-- Password  -->
                <input type="password" name="password" id="lpassword" class="form-control" required placeholder="Enter Password" /><br>

                <button type="submit" name="login" class="button1 btn btn-primary">Login</button>
                <input class="button1" type="reset" name="cancel" value="Cancel">
            </form>
        </div>
    </center>

</body>
<script type="text/javascript">
    $(document).ready(function() {

        function disableBack() { window.history.forward(); }
        setTimeout("disableBack()", 0);
        window.onunload = function () { null };

        //Login form
        $('#loginform').on('submit', function(e) {
            e.preventDefault();
            phone = $("#number").val().trim();
            // console.log(phone);
            password = $("#lpassword").val().trim();
            if ($(this).valid()) {
                console.log(phone);
                // console.log(password);
                $.ajax({
                    url: "admindatabase.php",
                    type: "POST",
                    data: {
                        phone: phone,
                        password: password,
                        method: 'login'
                    },
                    success: function(data) {
                        console.log(data);

                        if (data == "ok") {
                            window.location.href = "adminDetail.php";
                        } else if(data == "notok"){
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

        // Reset value in Add Post Modal
        $('#loginModal').on('hidden.bs.modal', function() {
            $('#loginModal form')[0].reset();
            $('.error').removeClass('error');
            $('label').hide();
        });
    })
</script>

</html>