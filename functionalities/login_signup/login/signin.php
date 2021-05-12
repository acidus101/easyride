<?php
$host="localhost";
$user="root";
$pass="";
$dbname="easyride";
$conn=mysqli_connect($host,$user,$pass,$dbname);

if(empty($_SESSION)) {
    session_start();
}

if(isset($_POST["login_user"]))
{
    echo"<script type='text/javascript'>alert('your credentials are mm wrong');</script>";
    $username=$_POST["username"];
	$w=$_POST["password"];
}

$s1="select * from user where username = '$username'"; 
$q1=mysqli_query($conn,$s1);

if(mysqli_num_rows($q1)>0)
{	
	while($d=mysqli_fetch_assoc($q1)) {
        if(password_verify($w,$d["pass"])) {	
                $_SESSION['password']=$w;	
                $_SESSION['username']=$username;
                header('location:http://localhost/easyride/views/userHome.php');					
            } else {
                echo"<script type='text/javascript'>alert('your credentials are wrong');</script>";
                session_destroy();
                header('location:http://localhost/easyride/functionalities/login_signup/login/index.html');
            }
		}
} else {
    echo "<script type='text/javascript'>alert('no such username exists');</script>";
}
?>
