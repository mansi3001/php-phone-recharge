<?php
session_start();
if (isset($_SESSION['userphone'])) {
    header('Location: ../PhoneRecharge/user/userDetail.php');
    header('Location: ../PhoneRecharge/user/index.php');
}
?>
<html>

<head>
    <title>
        Reset Password
    </title>

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

    <script src="jquery.toaster.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

</head>

<style type="text/css">
    .error {
        color: red;
        margin-left: 5px;
    }
</style>

<!-- Jquery Validation -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#reset-password").validate({
            rules: {}
        })
    });
</script>

<body>
    <h1>Update Password</h1>
    <form id="reset-password" method="POST">

        <label for="password">New Password : </label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="password">Confirm Password : </label>
        <input type="password" name="confirmpassword" id="confirmpassword" required><br><br>

        <input type="submit" name="resetPassword" id="resetPassword" value="Reset Password">
    </form>

    <div id="backtologin"></div>

    <script type="text/javascript">
        $(document).ready(function() {

            function disableBack() { window.history.forward(); }
            setTimeout("disableBack()", 0);
            window.onunload = function () { null };
        
            $('#reset-password').on('submit', function(e) {
                mail = "<?php echo $_GET['email']; ?>";
                phone = "<?php echo $_GET['phone']; ?>";
                pass = $('#password').val();
                cpass = $('#confirmpassword').val();
                e.preventDefault();
                if ($(this).valid()) {
                    $.ajax({
                        url: "database.php",
                        type: "POST",
                        data: {
                            mail: mail,
                            phone: phone,
                            pass: pass,
                            cpass: cpass,
                            method: 'resetpass'
                        },
                        success: function(data) {
                            console.log(data);
                            if (data == "success") {
                                $('#backtologin').html('<a href="../PhoneRecharge/user/index.php" type="button" class="btn btn-success">Back to Log In</a>');
                                $.toaster({
                                    priority: 'success',
                                    title: 'success',
                                    message: 'Password update Successfully.'
                                });
                            } else if (data == "0") {
                                $.toaster({
                                    priority: 'danger',
                                    title: 'Info',
                                    message: 'Change Password Failed.'
                                });
                            } else if (data == "2") {
                                $.toaster({
                                    priority: 'warning',
                                    title: 'Warning',
                                    message: 'Password not matched.'
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>