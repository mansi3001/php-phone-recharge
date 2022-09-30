<?php
$conn = mysqli_connect("localhost", "root", "Jay@1234", "phonerecharge");
extract($_POST);
switch ($_POST['method']) {

    case 'checkphone':
        checkphone($_POST['mail'], $_POST['phone'], $conn);
        break;

    case 'list':
        listData($_POST, $conn);
        break;

    case 'viewRechargeRequest':
        viewRechargeRequest($_POST, $conn);
        break;

    case 'status':
        status($_POST['id'], $conn);
        break;

    case 'login':
        login_data($_POST['phone'], $_POST['password'], $conn);
        break;

    case 'admindetail':
        admindetail($conn);
        break;

    case 'edit':
        edit_form($_POST['id'], $conn);
        break;

    case 'update_record':
        update_single_record($_POST['hidden_id'], $_POST['email'], $_POST['name'], $conn);
        break;

    case 'requestdata':
        requestdata($_POST, $conn);
        break;
    
    case 'sorting':
        sorting($_POST,$conn);
        break;
}

//sorting
function sorting($inputs, $conn) {

    // print_r($inputs);
    // print_r($columnName);

    $record_per_page = 5;
    $page = 1;

    if ($inputs['page'] > 1) {
        $page = $inputs['page'];
    } else {
        $start_from = 0;
    }

    $start_from = ($page - 1) * $record_per_page;

    // if (sort == "asc") {
    //     $(".sort").val("desc");
    // } else{
    //     $(".sort").val("asc");
    // }

    if($inputs['sort'] == "asc"){
        $inputs['sort'] == "desc";
    }else{
        $inputs['sort'] == "asc";
    }
    
    $select_query = "SELECT recharge.id, user.name, recharge.rupee, recharge.date, recharge.status FROM recharge INNER JOIN user ON recharge.user_id = user.id ORDER BY ".$inputs['columnName']." ".$inputs['sort']." LIMIT $start_from, $record_per_page";

    //all_query for pagination
    $all_query = "SELECT recharge.id, user.name, recharge.rupee, recharge.date, recharge.status FROM recharge INNER JOIN user ON recharge.user_id = user.id ORDER BY ".$inputs['columnName']." ".$inputs['sort']."";

    // echo $select_query;
    $result = mysqli_query($conn,$select_query);

    //execute all_query for pagination
    $all_result = mysqli_query($conn, $all_query);

    $total_records = mysqli_num_rows($all_result);

    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    } else {
        echo "1";
    }
    // echo "<pre>"; print_r($rows);"</pre>"; 

    $total_pages = ceil($total_records / $record_per_page);

    echo json_encode(array("rows" => $rows, "page" => $total_pages));

// print_r($rows);
    // echo json_encode(array("rows" => $rows));

}

//Show Approve and Pending Records in radio button and drop down
function requestdata($inputs, $conn)
{
    // print_r($inputs);die();

    $query = "";

    if ($inputs['radiorequest'] == 'approve' || $inputs['request'] == 'approve') {
        if ($inputs['request'] == 'approve' && $inputs['radiorequest'] == 'pending') {
            // print_R("Enter in r-a g-p");
            $query .= "SELECT recharge.id, user.name, recharge.rupee, recharge.date, recharge.status FROM recharge INNER JOIN user ON recharge.user_id = user.id";
        } else if ($inputs['request'] == 'pending' && $inputs['radiorequest'] == 'approve') {
            // print_R("Enter in r-p g-a");
            $query .= "SELECT recharge.id, user.name, recharge.rupee, recharge.date, recharge.status FROM recharge INNER JOIN user ON recharge.user_id = user.id";
        } else {
            // print_R("Enter in r-a g-a");
            $query .= "SELECT recharge.id, user.name, recharge.rupee, recharge.date, recharge.status FROM recharge INNER JOIN user ON recharge.user_id = user.id WHERE recharge.status = 1";
        }
    } else if ($inputs['radiorequest'] == 'pending' || $inputs['request'] == 'pending') {
        if ($inputs['request'] == 'approve' && $inputs['radiorequest'] == 'pending') {
            // print_R("Enter in r-a g-p");
            $query .= "SELECT recharge.id, user.name, recharge.rupee, recharge.date, recharge.status FROM recharge INNER JOIN user ON recharge.user_id = user.id";
        } else if ($inputs['request'] == 'pending' && $inputs['radiorequest'] == 'approve') {
            // print_R("Enter in r-p g-a");
            $query .= "SELECT recharge.id, user.name, recharge.rupee, recharge.date, recharge.status FROM recharge INNER JOIN user ON recharge.user_id = user.id";
        } else {
            // print_R("Enter in r-p g-p");
            $query .= "SELECT recharge.id, user.name, recharge.rupee, recharge.date, recharge.status FROM recharge INNER JOIN user ON recharge.user_id = user.id WHERE recharge.status = 0";
        }
    }

    $response = mysqli_query($conn, $query);

    if (mysqli_num_rows($response)) {
        while ($row = mysqli_fetch_assoc($response)) {
            $rows[] = $row;
        }
    } else {
        echo "1";
    }

    echo json_encode(array("rows" => $rows));
    die();
}

//Update Profile Modal
function edit_form($id, $conn)
{
    $query = "select `id`,`name`,`email`,`phone` from admin where id='$id'";
    // echo $query;
    if (!$result = mysqli_query($conn, $query)) {
        exit();
    }
    $response = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response = $row;
        }
    } else {
        $response = "Data not Found";
    }
    echo json_encode($response);
    die();
}

//Display User Details
function admindetail($conn)
{
    session_start();
    $phone = $_SESSION['adminphone'];
    // echo $p;
    $password = $_SESSION['adminpassword'];
    // echo $password;
    $qry = "select * from admin where phone='$phone' && password='$password'";
    // echo $qry;
    $data = mysqli_query($conn, $qry);
    $row = mysqli_fetch_assoc($data);
    echo json_encode($row);
    die();
}

//Admin Login
function login_data($phone, $password, $conn)
{
    session_start();
    if ($password == $password) {
        $query = "select * from admin where phone='$phone' && password='$password'";
        // echo $query;
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['adminphone'] = $phone;
            $_SESSION['adminpassword'] = $password;
            echo "ok";
        } else {
            echo "notok";
        }
    }
    mysqli_close($conn);
    die();
}

//Change Status
function status($id, $conn)
{
    session_start();
    $rupee = $_SESSION['rupee'];

    $query = "UPDATE `recharge` SET `status`= 1 WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "update";
        $phone = $_SESSION['userphone'];
        $qry = "UPDATE `user` SET points= points-$rupee WHERE phone = $phone";
        mysqli_query($conn, $qry);
    } else {
        echo "0";
    }
    die();
}

//Display Total Recharge Request
function viewRechargeRequest($inputs, $conn)
{
    // print_r($inputs); die();
    $record_per_page = 5;
    $page = 1;

    if ($inputs['page'] > 1) {
        $page = $inputs["page"];
    } else {
        $start_from = 0;
    }

    $start_from = ($page - 1) * $record_per_page;

    //query for fetch all record
    $query = "SELECT recharge.id, user.name, recharge.rupee, recharge.date, recharge.status FROM recharge INNER JOIN user ON recharge.user_id = user.id";

    //all_query for pagination
    $all_query = "SELECT recharge.id, user.name, recharge.rupee, recharge.date, recharge.status FROM recharge INNER JOIN user ON recharge.user_id = user.id";

    //Searching
    if ($inputs['query'] != '') {
        $input = $inputs['query'];
        $query .= " WHERE user.name LIKE '%{$input}%' OR recharge.status LIKE '%{$input}%'";

        $all_query .= " WHERE user.name LIKE '%{$input}%' OR recharge.status LIKE '%{$input}%'";
    }

    //Add limit
    $query = $query . " LIMIT $start_from, $record_per_page";

    //execute query for all records
    $result = mysqli_query($conn, $query);

    //execute all_query for pagination
    $all_result = mysqli_query($conn, $all_query);

    $total_records = mysqli_num_rows($all_result);

    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    } else {
        echo "1";
    }
    $total_pages = ceil($total_records / $record_per_page);

    echo json_encode(array("rows" => $rows, "page" => $total_pages));
    die();
}

//Display User Profile
function listData($inputs, $conn)
{
    // print_r($inputs); die();
    // session_start();
    $record_per_page = 5;
    $page = 1;
    if ($inputs['page'] > 1) {
        $page = $inputs['page'];
    } else {
        $start_from = 0;
    }
    $start_from = ($page - 1) * $record_per_page;
    // print_r($start_from);

    //qry for fetch all records
    $qry = "SELECT `name`, `email`, `phone` FROM `user` LIMIT $start_from, $record_per_page";

    //query for pagination
    $query = "SELECT `name`, `email`, `phone` FROM `user`";

    $data = mysqli_query($conn, $qry);

    $result = mysqli_query($conn, $query);

    $total_records = mysqli_num_rows($result);

    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            $rows[] = $row;
        }
    }

    $total_pages = ceil($total_records / $record_per_page);

    echo json_encode(array("rows" => $rows, "page" => $total_pages));
    die();
}
