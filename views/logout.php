<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['password']);
session_destroy();
header("location:http://localhost/easyride/functionalities/login_signup/login/index.html");
exit;
?>