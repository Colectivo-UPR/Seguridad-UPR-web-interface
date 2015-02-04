<?php
session_start();
session_destroy();
echo $_SESSION;
echo $_SESSION['token'];
$_SESSION = array();
$_SESSION['token'] = array();
echo $_SESSION;
echo $_SESSION['token'];
// header('location: login.php');
?>