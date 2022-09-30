<?php
session_start();
if(isset($_SESSION['userphone'])){
    header('Location: userDetail.php');
    header('Location: userTotalPost.php');
    header('Location: userTotalRechargeRequest.php');
    header('Location: forgotpass.php');
}
?>
<html>
<head>
    <title>Registration Form</title>
    <!-- Required meta tags -->

    <!-- bootstrap Lib -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 
    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="jquery.toaster.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>


    <!-- validation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script src="../jquery.toaster.js"></script>

</head>
<style type="text/css">
    .error {  
        color: red;  
        margin-left: 5px;  
    }
    .input{
        height: 40px;
        width: 300px;
        font-size: 15px;
        font-weight: bold;
        border-top-left-radius: 15px;
        border-bottom-right-radius: 15px;
        border-bottom-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .input1{
    height: 40px;
    width: 920px;
    border-radius: 15px;
    }
    td{
    font-size: 20px;
    font-weight: bold;
    }
    .button1{
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
    .button1:hover{
    background: steelblue;
    }
    .label{
        text-align: left;
    }
</style>

<!-- Jquery Validation -->
<script type="text/javascript">
        $(document).ready(function() {
            $("#regform").validate({
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
            })
        });
</script>

<body>
    <h1 align="center"><font size="10">Registration Form</font></h1>
    <center>
        <div class="container">
            <form id="regform" method="POST">
            
                <!-- Name -->
                <input type="text" name="name" id="name" class="input1 form-control" required placeholder="Enter Name"/><br>

                <!-- Phone  -->
                <input type="number" name="phone" id="phone" class="input1 form-control" required placeholder="Enter Phone Number"/><br>
                <div id="extensionerror" class="error" for="phone"></div>

                <!-- email  -->
                <input type="email" name="email" id="email" class="input1 form-control" required placeholder="Enter Email Address"/><br>
                <div id="extensionerr" class="error" for="email"></div>

                <!-- Password  -->
                <input type="password" name="password" id="password" class="input1 form-control" required placeholder="Enter Password"/><br>

                <input class="button1" type="submit" name="submit" value="Submit" id="submit">
                <input class="button1" type="reset" name="cancel" value="Cancel">
            </form>
        </div>
    </center>
</body>
<script type="text/javascript">
    $(document).ready(function(){

        function disableBack() { window.history.forward(); }
        setTimeout("disableBack()", 0);
        window.onunload = function () { null };

        // Insert Data
        $('#regform').on('submit', function(e){
            var form = new FormData(this);
            form.append('method', 'insert');
            e.preventDefault();
            if($(this).valid())  
            {
                var phone = $('#phone').val();
                var email = $('#email').val();
                $.ajax({
                    url: "../database.php",
                    type: "POST",
                    data: {email : email, method: 'checkemail'},
                    success: function(data){
                        if(data == "1")
                        {
                            $('#extensionerr').html('<label id="email-error" class="error" for="email">Email is already Exists!</label>');
                            // $.toaster({ priority : 'info', title : 'Info', message : 'Email is already Exists!' });
                        }else{
                            $.ajax({
                                url: "../database.php",
                                type: "POST",
                                data: {phone : phone, method: 'checkphone'},
                                success: function(data){
                                    if(data == "11"){
                                        $('#extensionerror').html('<label id="phone-error" class="error" for="phone">Phone Number is already Exists!</label>');
                                        // $.toaster({ priority : 'info', title : 'Info', message : 'Phone Number is already Exists!' });
                                    }else{
                                        $.ajax({
                                            url: "../database.php",
                                            type: "POST",
                                            data: form,
                                            contentType: false,
                                            processData: false,
                                            success: function(data){
                                                console.log(data);
                                                if(data == "0"){
                                                    $.toaster({ priority : 'danger', title : 'Failed!', message : 'Data not inserted correctly' });
                                                }else if(data == "insert"){
                                                    window.location.href = "userDetail.php";
                                                    $('#regform')[0].reset();
                                                    $.toaster({ priority : 'success', title : 'success', message : 'Data Inserted Successfully'});
                                                }
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    }
                });

            }
        });

        //Reset Form
        $('#regform').on('reset', function(e){
            $('.error').removeClass('error');
            $('#regform')[0].reset();
            $('label').hide();
        });
    })
</script>
</html>