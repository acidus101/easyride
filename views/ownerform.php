<?php
$host="localhost";
$user="root";
$pass="";
$dbname="easyride";
$conn=mysqli_connect($host,$user,$pass,$dbname);

if(empty($_SESSION)) //if the session not yet started
{
     session_start();
     if(!isset($_SESSION['username']))
     header("location:http://localhost/easyride/functionalities/login_signup/login/index.html");
}
else if(!isset($_SESSION['username']))
{
header("location:http://localhost/easyride/functionalities/login_signup/login/index.html");
exit;
}
$vehicle_name = $_POST["name"];
$vehicle_id = $_POST["vehicle_id"];
$address = $_POST["address"];
$charge = $_POST["charge"];
$type = $_POST["type"];
$model = $_POST["model"];
$username = $_SESSION["username"];

// getting user id
$username = $_SESSION["username"];
$q1 = "select user_id from user where username = '$username'";
$query1 = mysqli_query($conn, $q1);
$result1 = mysqli_fetch_assoc($query1);
$user_id = $result1["user_id"];

// update vehicle_m table
$q3 = "insert into vehicle_m values('$vehicle_name','$vehicle_id','$user_id','$charge','$type','$model')";
$query3 = mysqli_query($conn, $q3);
if($query3) {
    // update the user table
    $q5 = "update user set address = '$address' where user_id = '$user_id'";
    $query5 = mysqli_query($conn, $q5);
    if($q5){
        // check if user is already in user table
        $q6 = "select * from owner where owner_id = '$user_id'";
        $query6 = mysqli_query($conn, $q6);
        if(mysqli_num_rows($query6) == 0){
            // update owner table 
            $q2 = "insert into owner(owner_id) values('$user_id')";
            $query2 = mysqli_query($conn, $q2);
            if($q2){
                // update the user table
                $q4 = "update user set owner = 1 where user_id = '$user_id'";
                $query4 = mysqli_query($conn, $q4);
                if($query4){
                    if($type == 'car'){
                        header('location:http://localhost/easyride/views/carslist.php');
                    }else{
                        header('location:http://localhost/easyride/views/bikeslist.php');
                    }
                }else{
                    echo"can't do 4";
                }
            }else{
                echo"can't do 2";
            }
        }else{
            // update the user table
            $q4 = "update user set owner = 1 where user_id = '$user_id'";
            $query4 = mysqli_query($conn, $q4);
            if($query4){
                if($type == 'car'){
                    header('location:http://localhost/easyride/views/carslist.php');
                }else{
                    header('location:http://localhost/easyride/views/bikeslist.php');
                }
            }else{
                echo"can't do 2";
            }
        }
    }else{
        echo"can't do 5";
    }
}else {
    echo "can't do 1";
}
?>