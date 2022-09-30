<?php
session_start();
unset($_SESSION["userphone"]);
unset($_SESSION["userpassword"]);
header("Location:index.php");
?>