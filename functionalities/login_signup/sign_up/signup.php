<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "easyride";
$conn = mysqli_connect($host,$user,$pass,$dbname);

if(isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"] , PASSWORD_ARGON2I);
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];
}

$s2="select password from user where username='$username'";
$q2=mysqli_query($conn,$s2);

if(mysqli_num_rows($q2)>0){
    echo"<script type='text/javascript'>alert('this username is already taken');</script>";
    header('location:http://localhost/easyride/functionalities/login_signup/sign_up/index.html');
    exit;

} else {
    $s1="insert into signin values('$user_id','$password')";
    $q1=mysqli_query($conn,$s1);

    $s3="insert into user(name,phone,email,password,dob,username)
    values('$name','$phone','$email','$password','$dob','$username')";
    $q3=mysqli_query($conn,$s3);

    header('location:http://localhost/easyride/views/userHome.html');
    exit;
}

?>
