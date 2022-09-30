<?php
session_start();
if (!isset($_SESSION['adminphone'])) {
    header('Location: adminregistration.php');
}
// if(isset($_SESSION['adminphone'])) {
//     header('Location: ../user/index.php');
// }
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

<!-- Jquery Validation -->
<script type="text/javascript">
    $(document).ready(function() {
        //Edit Profile Modal validation
        $("#update_form").validate({
            rules: {},
        })
    });
</script>

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

            <!-- Admin Detail -->
            <h1>Admin Details</h1>
            <table class="table table-bordered px-2 py-2">
                <thead>
                    <tr id="title" class="tab">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody id="adminDetail"></tbody>
            </table>
        </div>

        <!-- Update Modal -->
        <div class="modal fade" id="updateuserModal">
            <div class="modal-dialog">
                <form method="post" id="update_form">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title text-uppercase">Update Profile</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="this.form.reset();">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="updatephone">Phone Number:</label>
                                <input type="text" class="form-control" id="updatephone" name="phone" disabled>
                            </div>
                            <div class="form-group">
                                <label for="updatename">Update Name:</label>
                                <input type="text" class="form-control" id="updatename" name="name">
                            </div>
                            <div class="form-group">
                                <label for="updateemail">Update Email:</label>
                                <input type="text" class="form-control" id="updateemail" name="email">
                                <span class="error" id="eemail"></span>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" data-dismis="modal">Update</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <input type="hidden" name="hidden_id" id="hidden_id">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script type="text/javascript">

            function disableBack() { window.history.forward(); }
            setTimeout("disableBack()", 0);
            window.onunload = function () { null };

            $(document).ready(function() {

                adminDetail();

                //Send Data - Edit Modal
                $('#update_form').on('submit', function(e) {
                    var form = new FormData(this);
                    form.append('method', 'update_record');
                    e.preventDefault();
                    if ($(this).valid()) {
                        $.ajax({
                            url: "admindatabase.php",
                            type: "POST",
                            data: form,
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                console.log(data);
                                adminDetail();
                                $('#updateuserModal').modal('hide');
                            }
                        });
                    }
                });
            });

            //Update Record Form
            function GetUserDetails(id) {
                $('#hidden_id').val(id);
                $.post("admindatabase.php", {
                    id: id,
                    method: 'edit'
                }, function(data, status) {
                    var user = JSON.parse(data);
                    $('#updatename').val(user.name);
                    $('#updateemail').val(user.email);
                    $('#updatephone').val(user.phone);
                });
                $('#updateModal').modal("show");
            }

            //Display Admin Profile
            function adminDetail() {
                $.ajax({
                    url: "admindatabase.php",
                    type: "POST",
                    data: {
                        method: 'admindetail'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        adminDetailHtml = `<tr>
                                                    <td>` + result.name + `</td>
                                                    <td>` + result.email + `</td>
                                                    <td>` + result.phone + `</td>
                                                    <td><button type="button" data-toggle="modal" data-target="#updateuserModal" onclick="GetUserDetails(` + result.id + `)" class="btn btn-warning">Edit</button></td>
                                                </tr>`
                        $('#adminDetail').html(adminDetailHtml);
                    }
                });
            }
        </script>
</body>

</html>