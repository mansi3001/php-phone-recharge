<?php
session_start();
if (!isset($_SESSION['userphone'])) {
    header('Location: ../PhoneRecharge/user/index.php');
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

    <!-- swal -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
    });
</script>

<!-- Total Post -->
<div class="container">
    <nav class="navbar navbar-dark bg-dark navbar-fixed-top">
        <!-- Navbar content -->
        <a href="../PhoneRecharge/user/userDetail.php" class="navbar-brand btn btn-nav">User Detail</a>
        <a href="../PhoneRecharge/user/searchuser.php" class="navbar-brand">Search</a>
        <a href="userTotalPost.php" class="navbar-brand">Total Posts</a>
        <a href="../PhoneRecharge/user/userTotalRechargeRequest.php" class="navbar-brand">Recharge Request</a>
    </nav>
    <div class="screen">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" id="addPost" class="btn btn-secondary btn-success edit" data-toggle="modal" data-target="#addPostModal">Add Post</button>
        </div>
        <h1>Total Post</h1>
        <h4 id="points">After request approve Points</h4>
        <h4 id="requestpoints">After Recharge Request Points</h4>
        <table id="total_post" class="table table-bordered px-2 py-2">
            <thead>
                <tr id="post_title" class="tab">
                    <th>Title</th>
                    <th>Image</th>
                    <th>Point</th>
                </tr>
            </thead>
            <tbody id="display_post">
                <!-- <tr>
                    <td id="postnot">
                        <h3>Post not Found</h3>
                    </td>
                </tr> -->
            </tbody>
        </table>
        <table id="datatable" style="display: none;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mansi</td>
                    <td>mansi@gmail.com</td>
                </tr>
                <tr>
                    <td>Meena</td>
                    <td>meena@gmail.com</td>
                </tr>
                <tr>
                    <td>Devansh</td>
                    <td>devansh@gmail.com</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Post Modal -->
<div class="modal fade" id="addPostModal">
    <div class="modal-dialog">
        <form id="addPostForm" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="addPostModalLabel">Upload Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="this.form.reset();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label> Title:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Your Post Title" />
                </div>
                <div class="modal-body">
                    <label> Select Image:</label>
                    <input type="file" name="file" id="file" class="input1 form-control" /><br>
                    <div id="extensionerror" class="error" for="file"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="send">Add Post</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    viewPost();
    totalPoints();
    requestPoints();

    $(document).ready(function() {

        function disableBack() {
            window.history.forward();
        }
        setTimeout("disableBack()", 0);
        window.onunload = function() {
            null
        };

        //Add Post 
        $('body').on('submit', '#addPostForm', function(e) {
            var form = new FormData(this);
            form.append('method', 'post_insert');
            e.preventDefault();
            $.ajax({
                url: "database.php",
                type: "POST",
                data: form,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data == "imgfail") {
                        $('#extensionerror').html('<label id="file-error" class="error" for="file">Please select only jpg, jpeg, png file!</label>');
                    } else if (data == "0") {
                        $.toaster({
                            priority: 'danger',
                            title: 'Failed!',
                            message: 'Data not inserted correctly'
                        });
                    } else if (data == "postsuccess") {
                        $('#addPostModal').modal('hide');
                        viewPost();
                        $.toaster({
                            priority: 'success',
                            title: 'success',
                            message: 'Data Inserted Successfully'
                        });
                    }
                }
            });
            // die();
        });

        // Reset value in Add Post Modal
        $('#addPostModal').on('hidden.bs.modal', function() {
            $('#addPostModal form')[0].reset();
            $('.error').removeClass('error');
            $('label').hide();
        });

        $("#total_post").DataTable();

    });

    //After request approve Points 
    function totalPoints() {
        $.ajax({
            url: "database.php",
            type: "POST",
            data: {
                method: 'points'
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                // viewPost();
                $('#points').html('<h4 id="points">Request approve Points =' + data.points + '</h4>');
            }
        });
    }

    //After Recharge Request Points
    function requestPoints() {
        $.ajax({
            url: "database.php",
            type: "POST",
            data: {
                method: 'requestpoints'
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                // viewPost();
                $('#requestpoints').html('<h4 id="requestpoints">Recharge Request Points =' + data.requestpoints + '</h4>');
            }
        });
    }

    //Display All Post 
    function viewPost() {
        $.ajax({
            url: "database.php",
            type: "POST",
            data: {
                method: 'viewPost'
            },
            dataType: 'json',
            success: function(result) {
                // console.log(result);
                // $('#postnot').hide();
                var userPostHtml = "";
                for (var i = 0; i < result.length; i++) {
                    userPostHtml += `<tr>
                    <td>` + result[i].title + `</td>
                    <td><img src= ` + result[i].image + ` width="60" height="60"></td>
                    <td>` + result[i].point + `</td>`;
                    userPostHtml += `</tr>`;
                }
                $('#display_post').html(userPostHtml);
                totalPoints();
                requestPoints();
            }
        });
    }
</script>
</body>

</html>