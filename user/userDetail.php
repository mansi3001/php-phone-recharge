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

    <!-- swal -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<style type="text/css">
    .name:valid {
        background-color: #f6eec0 !important;
    }

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

        //Add Post modal validation
        $("#addPostForm").validate({
            rules: {
                title: {
                    required: true,
                },
                file: {
                    required: true,
                }
            }
        });

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
            <a href="userDetail.php" class="navbar-brand">User Detail</a>
            <a href="searchuser.php" class="navbar-brand">Search</a>
            <a href="../userTotalPost.php" class="navbar-brand">Total Posts</a>
            <a href="userTotalRechargeRequest.php" class="navbar-brand">Recharge Request</a>
        </nav>
        <div class="screen">

            <div class="btn-group" role="group" aria-label="Basic example">
                <input type="button" value="Logout" class="btn btn-secondary btn-danger edit" onclick="window.location.href='logout.php'">
            </div>

            <!-- <div class="label">Count up from now</div>
            <div id="demo1" class="demo">00:00:00</div>
            <button type="button" id="start1" class="btn btn-success">Start</button> -->

            <div class="card" style="width: 40%;">

                <div class="card-body">
                    <h5 id="timer1" class="card-title btn btn-success edit">0</h5><br>
                    <h4>
                        <p class="card-text text-note text-danger" style="display: none;">Refresh the page to start timer again.</p>
                    </h4>

                    <button type="button" id="start" class="btn btn-success">Start</button>
                    <button type="button" id="pause" class="btn btn-primary">Pause</button>
                    <button type="button" id="resume" class="btn btn-warning">Resume</button>
                    <button type="button" id="remove" class="btn btn-danger">Stop</button>
                </div>
            </div>

            <!-- User Details -->
            <h1>Detail</h1>
            <table id="mytable" class="table table-bordered px-2 py-2">
                <thead>
                    <tr id="title" class="tab">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody id="userDetail">
                    <tr>
                        <td id="postnot" colspan="4" align="center">
                            <h3>Request not Found</h3>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateuserModal">
        <div class="modal-dialog">
            <form method="post" id="update_form">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-uppercase">Update Profile</h4>
                        <h5 class="error">You can't change your email and phone number
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="this.form.reset();">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="updatename">Update Name:</label>
                            <input type="text" class="form-control name" id="updatename" name="name">
                        </div>
                        <div class="form-group">
                            <label for="updatephone">Phone Number:</label>
                            <input type="text" class="form-control" id="updatephone" name="phone" disabled>
                        </div>
                        <div class="form-group">
                            <label for="updateemail">Email:</label>
                            <input type="text" class="form-control" id="updateemail" name="email" disabled>
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
        $(document).ready(function() {

            //disabled forward option on browser
            function disableBack() {
                window.history.forward();
            }
            setTimeout("disableBack()", 0);
            window.onunload = function() {
                null
            };


            //start a timer
            $('#start').on('click', function() {
                $("#timer1").timer();
            })

            //pause the timer
            $('#pause').on('click', function() {
                swal("Explain reason for pause timer:", {
                        content: "input",
                    })
                    .then((value) => {
                        swal(`Ok then Enjoy : ${value}`);
                        $('#timer1').timer('pause');
                    });
            })

            //resume the timer
            $('#resume').on('click', function() {
                $('#timer1').timer('resume');
            })

            //remove the timer
            $('#remove').on('click', function() {
                $('#timer1').timer('remove').hide();
                $('#start,#pause,#resume,#remove').hide();
                $('.text-note').show();
            })

            loadListData();

            //Send Data - Edit Modal
            $('#update_form').on('submit', function(e) {
                var form = new FormData(this);
                form.append('method', 'update_record');
                e.preventDefault();
                if ($(this).valid()) {
                    $.ajax({
                        url: "../database.php",
                        type: "POST",
                        data: form,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log(data);
                            loadListData();
                            $('#updateuserModal').modal('hide');
                        }
                    });
                }
            });

        });

        //Display User Profile
        function loadListData() {
            $.ajax({
                url: "../database.php",
                type: "POST",
                data: {
                    method: 'list'
                },
                dataType: 'json',
                success: function(result) {
                    console.log(result);
                    userDetailHtml = `<tr>
                                <td>` + result.name + `</td>
                                <td>` + result.email + `</td>
                                <td>` + result.phone + `</td>
                                <td><button type="button" data-toggle="modal" data-target="#updateuserModal" onclick="GetUserDetails(` + result.id + `)" class="btn btn-warning">Edit</button></td>
                            </tr>`
                    $('#userDetail').html(userDetailHtml);
                }
            });
        }

        //Update Record Form
        function GetUserDetails(id) {
            $('#hidden_id').val(id);
            $.post("../database.php", {
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
    </script>
</body>

</html>