<?php
session_start();
if (!isset($_SESSION['userphone'])) {
    header('Location: registration.php');
    header('Location: index.php');
}
?>
<!doctype html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    <!-- validation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <!-- timer -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.7.0/timer.jquery.js"></script>

    <!-- toaster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <script src="../jquery.toaster.js"></script>

    <!-- swal -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<style type="text/css">
    .name:valid {
        background-color: #f6eec0 !important;
    }

    .screen {
        margin-top: 70px;
    }

    .error {
        color: red;
        margin-left: 5px;
    }

    .logout {
        margin-left: 140px;
        margin-top: 20px;
    }

    .edit {
        margin-top: 20px;
        margin-right: 25px;
    }
</style>

<body>
    <div class="container">
        <nav class="navbar navbar-dark bg-dark navbar-fixed-top">
            <!-- Navbar content -->
            <a href="userDetail.php" class="navbar-brand">User Detail</a>
            <a href="searchuser.php" class="navbar-brand">Search</a>
            <a href="../userTotalPost.php" class="navbar-brand">Total Posts</a>
            <a href="userTotalRechargeRequest.php" class="navbar-brand">Recharge Request</a>
        </nav>

        <div class="screen">
            <!-- User Details -->
            <h1>Detail</h1>
            <label>Search: </label>
            <input type="text" id="search" placeholder="Search for Result..." class="search"><br><br>

            <!-- Search User Profile -->
            <h1>Search Profile</h1>
            <table id="mytable" class="table table-bordered px-2 py-2">
                <thead>
                    <tr id="title" class="tab" style="display: none;">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody id="userDetail">
                    <tr>
                        <td id="postnot" colspan="4" align="center">
                            <h3>Search User Name</h3>
                        </td>
                    </tr>
                </tbody>
                <tbody id="searchuser"></tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            //disabled forward option on browser
            function disableBack() {
                window.history.forward();
            }
            setTimeout("disableBack()", 0);
            window.onunload = function() {
                null
            };

            //user id search
            $('#search').keyup(function() {
                var search = $(this).val();
                searchuser(search);
            });
        });

        //Display Other User Profile
        function searchuser(query = '') {
            $.ajax({
                url: "../database.php",
                type: "POST",
                data: {
                    query: query,
                    method: 'searchuser'
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#postnot').hide();
                    $('#title').show();
                    if ($('#search').val() == '') {
                        $('#postnot').show();
                        $('#title').hide();
                    }
                    var userDetailHtml = "";
                    $.each(data.rows, function(key, value) {
                        console.log(key, value);

                        userDetailHtml += `<tr>
                                        <td>` + value.name + `</td>
                                        <td>` + value.email + `</td>
                                        <td>` + value.phone + `</td>`;
                        userDetailHtml += `</tr>`;
                    });
                    $('#searchuser').html(userDetailHtml);
                }
            });
        }
    </script>
</body>

</html>