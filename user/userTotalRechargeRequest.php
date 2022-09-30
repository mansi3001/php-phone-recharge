<?php
session_start();
if (!isset($_SESSION['userphone'])) {
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
        //Recharge modal validation
        $("#rechargeForm").validate({
            rules: {
                number: {
                    digits: true
                },
                recharge: {
                    range: [0, Infinity],
                    number: true
                }
            },
            message: {
                number: {
                    digits: "Enter only Digits"
                },
                recharge: {}
            }
        });
    });
</script>

<div class="container">
    <nav class="navbar navbar-dark bg-dark navbar-fixed-top">
        <!-- Navbar content -->
        <a href="userDetail.php" class="navbar-brand btn btn-nav">User Detail</a>
        <a href="searchuser.php" class="navbar-brand">Search</a>
        <a href="../userTotalPost.php" class="navbar-brand">Total Posts</a>
        <a href="userTotalRechargeRequest.php" class="navbar-brand">Recharge Request</a>
    </nav>
    <div class="screen">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" id="recharge" id="recharge1" class="btn btn-secondary btn-success edit" data-toggle="modal" data-target="#rechargeModal">Recharge</button>
        </div>
        <!-- Total Recharge Request -->
        <h1>Total Recharge Request</h1>
        <table id="total_post" class="table table-bordered px-2 py-2">
            <thead>
                <tr id="post_title" class="tab">
                    <th>Rupees</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="display_request">
                <tr>
                    <td id="postnot" colspan="3" align="center">
                        <h3>Request not Found</h3>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

    
<!-- Mobile Recharge -->
<div class="modal fade" id="rechargeModal">
    <div class="modal-dialog">
        <form id="rechargeForm" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="rechargeModalLabel">Recharge Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="this.form.reset();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label> Recharge Rupees:</label>
                    <input type="phone" name="recharge" id="number" id="recharge" class="input1 form-control" placeholder="Enter Recharge Rupees" required /><br>
                    <div class="error"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="request">Send Request</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        function disableBack() { window.history.forward(); }
        setTimeout("disableBack()", 0);
        window.onunload = function () { null };
        
        showRechargeRequest();

        //Mobile Recharge Form
        $('body').on('submit', '#rechargeForm', function(e) {
            var form = new FormData(this);
            form.append('method', 'recharge_form');
            e.preventDefault();
            $.ajax({
                url: "../database.php",
                type: "POST",
                data: form,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log("Enter in success");
                    console.log(data);
                    if (data == "sent") {
                        showRechargeRequest();
                        $('#rechargeModal').modal('hide');
                        $.toaster({
                            priority: 'success',
                            title: 'Sent',
                            message: 'Request sent successfully!'
                        });
                    } else if (data == "request") {
                        $('.error').html("Your recharge request is greater-than points!");
                    } else if (data == "pointerror") {
                        $('.error').html("After 30 points you can send recharge request!");
                    } else if (data == "fail") {
                        $('.error').html("Request sent Unsuccessful!");
                    } else if (data == "lessthanpoints") {
                        $('.error').html("You can Recharge minimum points Rupees!");
                    }
                }
            });
        });


        // Reset value in Recharge Modal Modal
        $('#rechargeModal').on('hidden.bs.modal', function() {
            $('label').hide();
            $('#rechargeModal form')[0].reset();
            $('.error').html("");
        });
    });


    //Display All Recharge Request
    function showRechargeRequest() {
        $.ajax({
            url: "../database.php",
            type: "POST",
            data: {
                method: 'viewRechargeRequest'
            },
            dataType: 'json',
            success: function(result) {
                $('#postnot').hide();
                var userRequestHtml = "";
                for (var i = 0; i < result.length; i++) {
                    userRequestHtml += `<tr><td>` + result[i].rupee + `</td><td>` + result[i].date + `</td>`;
                    if (result[i].status == "0") {
                        userRequestHtml += `<td><button type="button" class="btn btn-danger" id="status" name="status" disabled>Pending</button></td>`;
                    } else {
                        userRequestHtml += `<td><button type="button" class="btn btn-warning" id="status" name="status" disabled>Approve</button></td>`;
                    }
                    userRequestHtml += `</tr>`;
                }
                $('#display_request').html(userRequestHtml);
            }
        });
    }
</script>
</body>

</html>