<?php
session_start();
if (!isset($_SESSION['adminphone'])) {
    header('Location: adminregistration.php');
    header('Location: ../user/index.php');
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

</head>
<style type="text/css">
    .screen {
        margin-top: 50px;
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
            <a href="adminDetail.php" class="navbar-brand btn btn-nav">Admin Detail</a>
            <a href="adminuserDetail.php" class="navbar-brand btn btn-nav">User Details</a>
            <a href="adminRechargerequest.php" class="navbar-brand">Recharge Request</a>
        </nav>
        <div class="screen">
            <input type="button" value="Logout" class="btn btn-secondary btn-danger edit" onclick="window.location.href='adminlogout.php'">

            <!-- User Details -->
            <h1>user Details</h1>
            <table id="mytable" class="table table-bordered px-2 py-2">
                <thead>
                    <tr id="title" class="tab">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody id="userDetail">
                    <tr>
                        <td id="postnot">
                            <h3>User not Registered</h3>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div id = "pagination" align = "center"></div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            function disableBack() { window.history.forward(); }
            setTimeout("disableBack()", 0);
            window.onunload = function () { null };

            loadListData(page = 1);

            $(document).on('click', "#pagination a", function (e) {
                e.preventDefault();
                var page_id = $(this).attr('page_no');
                // console.log(page_id);
                $(this).addClass('active');
                loadListData(page_id);
            });

        });

        //Display User Profile
        function loadListData(page = 1) {
            $.ajax({
                url: "admindatabase.php",
                type: "POST",
                data: {
                    page: page,
                    method: 'list'
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#postnot').hide();
                    var userDetailHtml = "";
                    $.each(data.rows, function(key, value) {
                        console.log(key,value);
                        userDetailHtml += `<tr><td>` + value.name + `</td><td>` + value.email + `</td><td>` + value.phone + `</td>`
                        userDetailHtml += `</tr>`;
                    });
                    $('#userDetail').html(userDetailHtml);
                    var response = "";
                    for( var i = 1; i <= data.page; i++ ) {
                        var active = i == data.page ? 'active' : "";
                        console.log(i);
                        response += `<a page_no=` + i + ` href="" class="`  + active + `" style="cursor:pointer; margin: 2px; padding: 9px; border: 1px solid black;">` + i + `</a>`;
                    }
                    $('#pagination').html(response);
                }
            });
        }
    </script>
</body>

</html>



<!-- // for (var i = 0; i <= data.rows; i++) {
                    //     userDetailHtml = `<tr>
                    //                 <td>` + data[i].name + `</td>
                    //                 <td>` + data[i].email + `</td>
                    //                 <td>` + data[i].phone + `</td>
                    //             </tr>`
                    //     $('#userDetail').append(userDetailHtml);
                    // } -->