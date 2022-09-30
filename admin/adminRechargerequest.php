<?php
session_start();
if (!isset($_SESSION['adminphone'])) {
    header('Location: adminregistration.php');
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

    <!-- Swal -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- validation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

</head>
<style type="text/css">
    .screen {
        margin-top: 80px;
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

    .search {
        background-color: #ADD8E6;
    }
</style>

<body background="../image/bg.jpg" style="background-repeat: no-repeat; background-size: 100% 200%">
    <div class="container">
        <nav class="navbar navbar-dark bg-dark navbar-fixed-top">
            <!-- Navbar content -->
            <a href="adminDetail.php" class="navbar-brand btn btn-nav">Admin Detail</a>
            <a href="adminuserDetail.php" class="navbar-brand btn btn-nav">User Details</a>
            <a href="adminRechargerequest.php" class="navbar-brand">Recharge Request</a>
        </nav>
        <div class="screen">

            <!-- Total Recharge Request -->
            <h1>Total Recharge Request</h1><br><br>
            <label>Search: </label>
            <input type="text" id="search" placeholder="Search for Result..." class="search">

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <!-- request in drop down -->
            <label>Request: </label>
            <select id="request" name="request" onclick="request(this.val)" class="btn btn-info dropdown-toggle">
                <option value="">--Select--</option>
                <option value='approve'>Approve</option>
                <option value='pending'>Pending</option>
            </select>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <!-- request in radio button -->
            <label id="radior" name="request">Select Request: </label>
            <input type="radio" name="request" value="approve" class="radiorequest" onclick="request(this.val)">Approve</input>
            <input type="radio" name="request" value="pending" class="radiorequest" onclick="request(this.val)">Pending</input>

            <br><br>
            <table id="total_post" class="table table-bordered px-2 py-2">
            <input type='hidden' class='sort' value='desc'>
                <thead>
                    <tr id="post_title" class="tab">
                        <!-- <th id="name" class="name" value="name">name</th> -->
                        <th><span onclick='sortTable(columnName = "name",page);'>name</span></th>
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
            </table><br>
            <div id="pagination" align="center"></div>
            <div id="sortingpagination" align="left"></div>
            <button class = "btn btn-primary btn-sm"><a href = "chart.php" style = "text-decoration: none; color: #fff;"><i class="fas fa-chart-bar"></i> Gprahical Results</a></button>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            // disable forward option on browser
            function disableBack() {
                window.history.forward();
            }
            setTimeout("disableBack()", 0);
            window.onunload = function() {
                null
            };

            showRechargeRequest(page = 1, search = null);

            $('#search').keyup(function() {
                var search = $(this).val();
                showRechargeRequest(1, search);
            });

            $(document).on('click', "#pagination a", function(e) {
                e.preventDefault();
                var page_id = $(this).attr("page_no");
                var search = $('#search').val();
                $(this).addClass('active');
                showRechargeRequest(page_id, search);
            });

            //sorting pagination
            $(document).on('click', "#sortingpagination a", function(e) {
                e.preventDefault();
                
                var id = $(this).attr("id");
                $(this).addClass('click');
                sortTable(columnName="", id);
            });
        });

        function sortTable(columnName, page) {
            var sort = $(".sort").val();
            console.log(sort);
            $.ajax({
                url: 'admindatabase.php',
                type: 'post',
                dataType: 'json',
                data: {
                    page: page,
                    sort: sort,
                    columnName: columnName,
                    method: 'sorting'
                },
                success: function(result) {
                    console.log('result');
                    console.log(result);
                    var userRequestHtml = "";
                    $.each(result.rows, function(k, i) {
                        // console.log(k, i);
                        userRequestHtml += `<tr><td>` + i.name + `</td><td>` + i.rupee + `</td><td>` + i.date + `</td>`;
                        if (i.status == "0") {
                            userRequestHtml += `<td><button onclick="updateStatus(` + i.id + `)" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-danger pending" id="status" value="pending" name="pending">Pending</button></td>`;
                        } else if (i.status == "1") {
                            userRequestHtml += `<td><button value="approve" type="button" class="btn btn-warning approve" id="status" name="approve">Approve</button></td>`;
                        }
                        userRequestHtml += `</tr>`;
                        if (sort == "asc") {
                            $(".sort").val("desc");
                        } else{
                            $(".sort").val("asc");
                        }
                        // }
                    });
                    $('#display_request').html(userRequestHtml);
                    var data = "";
                    for (var i = 1; i <= result.page; i++) {
                        var click = i == result.page ? 'click' : '';
                        // console.log(i);
                        data += `<a id=` + i + ` href="" class="` + click + `" style="cursor:pointer; margin: 2px; padding: 9px; border: 1px solid black;">` + i + `</a>`;
                    }
                    $('#sortingpagination').html(data);
                }
            });
        }

        // updateStatus();
        function updateStatus(id) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to change status!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "admindatabase.php",
                            type: "POST",
                            data: {
                                id: id,
                                method: 'status'
                            },
                            success: function(data) {
                                console.log(data);
                                if (data == "update") {
                                    swal("Poof! Recharge Request is Approve!", {
                                        icon: "success",
                                    });
                                    showRechargeRequest();
                                } else if (data == "0") {
                                    swal("Your imaginary file is safe!");
                                }
                            }
                        });
                    }
                });

        }

        //Display All Recharge Request
        function showRechargeRequest(page = 1, query = '') {
            $.ajax({
                url: "admindatabase.php",
                type: "POST",
                data: {
                    page: page,
                    query: query,
                    method: 'viewRechargeRequest'
                },
                dataType: 'json',
                success: function(result) {
                    // console.log("pagination");
                    // console.log(result);
                    $('#postnot').hide();
                    var userRequestHtml = "";
                    $.each(result.rows, function(k, i) {
                        // console.log(k, i);
                        userRequestHtml += `<tr><td>` + i.name + `</td><td>` + i.rupee + `</td><td>` + i.date + `</td>`;
                        if (i.status == "0") {
                            userRequestHtml += `<td><button onclick="updateStatus(` + i.id + `)" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-danger pending" id="status" value="pending" name="pending">Pending</button></td>`;
                        } else if (i.status == "1") {
                            userRequestHtml += `<td><button value="approve" type="button" class="btn btn-warning approve" id="status" name="approve">Approve</button></td>`;
                        }
                        userRequestHtml += `</tr>`;
                        // }
                    });
                    $('#display_request').html(userRequestHtml);
                    var response = "";
                    for (var m = 1; m <= result.page; m++) {
                        var active = m == result.page ? 'active' : '';
                        // console.log(m);
                        response += `<a page_no=` + m + ` href="" class="` + active + `" style="cursor:pointer; margin: 2px; padding: 9px; border: 1px solid black;">` + m + `</a>`;
                    }
                    $('#pagination').html(response);
                }
            });
        }

        //Approve and Pending Request dropdown and radio buttons
        function request(value) {
            var request = $("#request").val();
            var radiorequest = $(".radiorequest:checked").val();
            console.log(request);
            console.log(radiorequest);
            $.ajax({
                url: "admindatabase.php",
                type: "POST",
                data: {
                    radiorequest: radiorequest,
                    request: request,
                    method: 'requestdata'
                },
                dataType: 'json',
                success: function(data) {
                    console.log("request");
                    console.log(data);
                    var userRequestHtml = "";
                    $.each(data.rows, function(k, i) {
                        // console.log(k, i);
                        userRequestHtml += `<tr><td>` + i.name + `</td><td>` + i.rupee + `</td><td>` + i.date + `</td>`;
                        if (i.status == "0") {
                            userRequestHtml += `<td><button onclick="updateStatus(` + i.id + `)" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-danger pending" id="status" value="pending" name="pending">Pending</button></td>`;
                        } else if (i.status == "1") {
                            userRequestHtml += `<td><button value="approve" type="button" class="btn btn-warning approve" id="status" name="approve">Approve</button></td>`;
                        }
                        userRequestHtml += `</tr>`;
                        // }
                    });
                    $('#display_request').html(userRequestHtml);
                    $('#pagination').hide();
                }
            });
        }
    </script>
</body>

</html>