<?php
session_start();
unset($_SESSION["adminphone"]);
unset($_SESSION["adminpassword"]);
header("Location:../user/index.php");
?>