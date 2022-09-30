<?php

require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';

require_once('vendor/autoload.php');

$conn = mysqli_connect("localhost", "root", "Jay@1234", "phonerecharge");
extract($_POST);
switch ($_POST['method']) {

    case 'insert':
        insert_data($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['password'], $conn);
        break;

    case 'checkphone':
        checkphone($_POST['phone'], $conn);
        break;

    case 'checkemail':
        checkemail($_POST['email'], $conn);
        break;

    case 'login':
        login_data($_POST['phone'], $_POST['password'], $conn);
        break;

    case 'mail':
        mail_send($_POST['mail'], $_POST['phone'], $conn);
        break;

    case 'resetpass':
        resetpass($_POST['mail'], $_POST['phone'], $_POST['pass'], $_POST['cpass'], $conn);
        break;

    case 'post_insert':
        post_insert($_FILES['file'], $_POST['title'], $conn);
        break;

    case 'list':
        listData($conn);
        break;

    case 'viewPost':
        viewPost($conn);
        break;

    case 'points':
        points($conn);
        break;

    case 'recharge_form':
        recharge($_POST['number'], $_POST['recharge'], $conn);
        break;

    case 'viewRechargeRequest':
        viewRechargeRequest($_POST, $conn);
        break;

    case 'edit':
        edit_form($_POST['id'], $conn);
        break;

    case 'update_record':
        update_single_record($_POST['hidden_id'], $_POST['email'], $_POST['name'], $conn);
        break;

    case 'requestpoints':
        requestpoints($conn);
        break;

    case 'searchuser':
        searchuser($_POST, $conn);
        break;

    // case 'qrcode':
    //     qrcode($_POST['description'], $_POST['quality'], $_POST['size'], $conn);
    //     break;
}

// function qrcode($description, $quality, $size, $conn)
// {
//     require 'phpqrcode/qrlib.php';
//     $codesDir = "../image/";
//     $codeFile = date('d-m-Y-h-i-s') . '.png';
//     $formData = $description;
//     QRcode::png($formData, $codesDir . $codeFile, $quality, $size);
//     echo '<img class="img-thumbnail" src="' . $codesDir . $codeFile . '" />';
// }

//Search User
function searchuser($inputs, $conn)
{
    // SELECT * FROM `user` WHERE `phone` NOT IN (889)
    session_start();
    $phone = $_SESSION['userphone'];
    if ($inputs['query'] != '') {
        $input = $inputs['query'];
        $query = "SELECT `id`,`name`, `email`, `phone` FROM `user` WHERE `phone` NOT IN ($phone) AND user.name LIKE '%{$input}%'";
        // echo $query;
    }


    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }
    echo json_encode(array("rows" => $rows));
    die();
}

//Update Record
function update_single_record($hidden_id, $email, $name, $conn)
{
    $qry = "UPDATE `user` SET `name`='$name' WHERE id='$hidden_id'";
    $done = mysqli_query($conn, $qry);
    if (isset($done)) {
        echo "Query Success";
    } else {
        echo "Query Failed";
    }
}

//Edit Profile Form
function edit_form($id, $conn)
{
    $query = "select `id`,`name`,`email`,`phone` from user where id='$id'";
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
}

//Insert User Data
function insert_data($name, $phone, $email, $password, $conn)
{
    session_start();
    $password = md5($password);
    $points = 0;
    $requestpoints = 0;
    $relation = 0;
    $query = "INSERT INTO `user`(`name`,`phone`,`email`,`password`,`points`,`requestpoints`) VALUES ('$name','$phone','$email','$password','$points','$requestpoints')";
    // echo $query;
    $done = mysqli_query($conn, $query);
    if ($done) {
        echo "insert";
        $_SESSION['userphone'] = $phone;
        $_SESSION['userpassword'] = $password;
        die();
    } else {
        echo "0";
        die();
    }
    die();
}

//Login
function login_data($phone, $password, $conn)
{
    session_start();
    $pass = md5($password);
    if ($pass == md5($password)) {
        $query = "select * from user where phone='$phone' && password='$pass'";
        // echo $query;
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['userphone'] = $phone;
            $_SESSION['userpassword'] = $pass;
            echo "ok";
        } else {
            echo "not ok";
            echo "Wrong Credentials";
        }
    }
    mysqli_close($conn);
}

//Send mail
function mail_send($mail, $phone, $conn)
{

    $query = "SELECT * FROM user WHERE phone = '$phone' AND email = '$mail'";
    $select = mysqli_query($conn, $query);
    $phoneN = md5($phone);

    if (mysqli_num_rows($select) == 1) {
        $name = " - Mansi V";  // Name of your website or yours
        $subject = "Mail from $name"; // Subject of the mail
        $body = '<b>Click On This Link to Reset Password: </b><a href="http://localhost/Mansi/PhoneRecharge/forgotpass.php?expired=1600881883?email=' . $mail . '&phone=' . $phoneN . '">Click Here</a>';
        $from = "mansivadher02@gmail.com";  // you mail

        //SMTP Settings

        $phpmailer = new phpmailer\phpmailer\PHPMailer;
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'bfffcd7dcd3934';
        $phpmailer->Password = '8c06f6ad3ba91a';
        $phpmailer->SMTPSecure = true;

        //Email Settings
        $phpmailer->isHTML(true);
        $phpmailer->setFrom($from, $name);
        $phpmailer->addAddress("mansiv@mailinator.io"); // enter email address whom you want to send
        $phpmailer->Subject = $subject;
        $phpmailer->Body = $body;

        if ($phpmailer->send()) {
            echo "1"; //mail sent successfully
        } else {
            echo "0"; // mail is not sent
        }
    } else {
        echo "2"; //you are not registered yet
    }
}

//Check phone number is exist or not
function checkphone($phone, $conn)
{
    $query = "SELECT `phone` FROM user WHERE phone = '$phone'";
    $select = mysqli_query($conn, $query);
    if (mysqli_num_rows($select) > 0) {
        echo "11";
    }
}

//Check email is exist or not
function checkemail($email, $conn)
{
    $query = "SELECT * FROM user WHERE email = '$email'";
    $select = mysqli_query($conn, $query);
    if (mysqli_num_rows($select) > 0) {
        echo "1";
    }
}

//Mobile Recharge
function recharge($number, $recharge, $conn)
{
    session_start();
    $phone = $_SESSION['userphone'];
    $query = "SELECT SUM(point) AS points FROM addpost WHERE `user_id` = (SELECT id FROM user WHERE phone = $phone)";
    $data = mysqli_query($conn, $query);

    $sql = "SELECT requestpoints AS rpoints FROM user WHERE id =(SELECT id FROM user WHERE phone = $phone)";
    $check = mysqli_query($conn, $sql);

    if (mysqli_num_rows($check) > 0) {
        $r = mysqli_fetch_array($check);
    }

    if (mysqli_num_rows($data) > 0) {
        $result = mysqli_fetch_array($data);
    }
    if ($r['rpoints'] > $recharge) {
        if ($result['points'] >= 30) {
            if ($result['points'] > $recharge) {

                date_default_timezone_set("Asia/Kolkata");
                $format = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
                $date = date("Y-m-d H:i:s", $format);

                $query = "INSERT INTO `recharge` (`user_id`,`rupee`,`date`,`status`) VALUES ((SELECT id FROM user WHERE phone = $phone),'$recharge','$date','0')";
                $data = mysqli_query($conn, $query);
                if ($data) {
                    echo "sent";
                    $qry = "UPDATE `user` SET requestpoints = requestpoints-$recharge WHERE  phone = $phone";
                    mysqli_query($conn, $qry);
                    $_SESSION['rupee'] = $recharge;
                } else {
                    echo "fail";
                }
            } else {
                echo "lessthanpoints";
            }
        } else {
            echo "pointerror";
        }
    } else {
        echo "request";
    }
}

//Total points
function points($conn)
{
    session_start();
    $phone = $_SESSION['userphone'];
    $query = "SELECT points FROM user WHERE phone = '$phone'";
    // echo $query;
    $data = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($data);
    echo json_encode($row);
}

//After request send display pending points
function requestpoints($conn)
{
    session_start();
    $phone = $_SESSION['userphone'];
    $query = "SELECT requestpoints FROM user WHERE phone = '$phone'";
    // echo $query;
    $data = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($data);
    echo json_encode($row);
}

//Display all Post
function viewPost($conn)
{
    session_start();
    $phone = $_SESSION['userphone'];
    $query = "SELECT `id`,`title`, `image`, `point` FROM addpost WHERE `user_id` = (SELECT id FROM user WHERE phone = $phone)";
    $data = mysqli_query($conn, $query);

    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            $rows[] = $row;
        }
    } else {
        echo "1";
    }
    // echo "<pre>"; print_r($rows);"</pre>"; 
    echo json_encode($rows);
}

//Display User Profile
function listData($conn)
{
    session_start();
    $phone = $_SESSION['userphone'];
    $password = $_SESSION['userpassword'];
    $qry = "SELECT * FROM user  where phone='$phone' AND password='$password'";
    // echo $qry;
    $data = mysqli_query($conn, $qry);
    $row = mysqli_fetch_assoc($data);
    echo json_encode($row);
}

//Total Recharge Request
function viewRechargeRequest($inputs, $conn)
{
    session_start();
    $phone = $_SESSION['userphone'];

    $query = "SELECT `rupee`, `date`,`status` FROM recharge WHERE `user_id` = (SELECT id FROM user WHERE phone = $phone)";

    $data = mysqli_query($conn, $query);
    if (mysqli_num_rows($data)) {
        while ($row = mysqli_fetch_assoc($data)) {
            $rows[] = $row;
        }
    } else {
        echo "1";
    }
    // echo "<pre>"; print_r($row);"</pre>"; 
    echo json_encode($rows);
}

// Insert Post
function post_insert($file, $title, $conn)
{
    // 
    if (isset($file)) {
        $filename = $_FILES['file']['name'];
        $tmpname = $_FILES['file']['tmp_name'];

        $move = "../image/" . $filename;
        $imageFileType = pathinfo($move, PATHINFO_EXTENSION);
        $imageFileType = strtolower($imageFileType);

        $allowed =  array('jpeg', 'jpg', "png");
        if (in_array($imageFileType, $allowed)) {

            session_start();
            $point = "10";

            if (move_uploaded_file($tmpname, $move)) {

                $phone = $_SESSION['userphone'];
                $query = "INSERT INTO `addpost` (`user_id`,`title`,`image`,`point`) VALUES ((SELECT id FROM user WHERE phone = $phone),'$title', '$move','$point')";
                $done = mysqli_query($conn, $query);
                if ($done) {
                    echo "postsuccess";
                    $qry = "UPDATE `user` SET points = points+10 WHERE  phone = $phone";
                    mysqli_query($conn, $qry);
                    $sql = "UPDATE `user` SET requestpoints = requestpoints+10 WHERE  phone = $phone";
                    mysqli_query($conn, $sql);
                } else {
                    echo "0";
                    die();
                }
                die();
            }
        } else {
            echo "imgfail";
            die();
        }
    }
}

//Reset password
function resetpass($mail, $phone, $pass, $cpass, $conn)
{
    session_start();
    // echo "Password";
    if (isset($pass) && isset($cpass)) {
        $query = "SELECT * FROM user WHERE email = '$mail'";
        $run = mysqli_query($conn, $query);
        if ($pass == $cpass) {
            $password = md5($pass);
            $query = "UPDATE user SET password = '$password' WHERE email = '$mail'";
            $run = mysqli_query($conn, $query);
            if ($run) {
                echo "success"; // Password changed successfully
            } else {
                echo "0"; // Password not changed successfully
            }
        } else {
            echo "2"; // Password is not match
        }
    }
}
