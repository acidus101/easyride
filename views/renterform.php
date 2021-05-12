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
$o_date = date("y-m-d");
$r_date = $_POST["r_date"];
$driver = $_POST["driver"];

if($driver == "yes") {
    $want_driver = 1;
}else {
    $want_driver = 0;
}

// get vehicle_id
$vehicle_id = $_GET["value"];

// calculating days
$end = strtotime("today");
$start = strtotime($r_date);
$days = round(abs($end - $start) / 86400);

// get the amount
$rate = "select charge from vehicle_m where vehicle_id = '$vehicle_id'";
$queryrate = mysqli_query($conn, $rate);
$resultrate = mysqli_fetch_assoc($queryrate);
$amount = $resultrate["charge"] * $days;

if($want_driver == 0){
    $owner_commission = $amount * 0.10;
    $company_commission = $amount * 0.20;
}else{
    $owner_commission = $amount * 0.10;
    $company_commission = $amount * 0.30;
}

// getting user id
$username = $_SESSION["username"];
$q1 = "select user_id from user where username = '$username'";
$query1 = mysqli_query($conn, $q1);
$result1 = mysqli_fetch_assoc($query1);
$user_id = $result1["user_id"];

// getting car owner id
$qnew = "select owner_id from vehicle_m where vehicle_id = '$vehicle_id'";
$querynew = mysqli_query($conn, $qnew);
$resultnew = mysqli_fetch_assoc($querynew);

// payment 1 cash 0 card
$payment = $_POST["payment"];
if($payment == "cash"){
    $payment_method = 1;
}else {
    $payment_method = 0;
}
// update order_history
$q2 = "insert into order_history(o_date,r_date,driver,owner_commission,company_commission,user_id,vehicle_id) values('$o_date','$r_date','$want_driver','$owner_commission','$company_commission','$user_id','$vehicle_id')";
$query2 = mysqli_query($conn, $q2);
if($query2){
    $qorder = "select order_id from order_history where o_date = '$o_date' and r_date = '$r_date' and vehicle_id = '$vehicle_id'";
    $qorderresult = mysqli_query($conn, $qorder);
    if($qorderresult){
            $result_order = mysqli_fetch_assoc($qorderresult);
        
        // old company commission and update
        $q3 = "select * from company_commission";
        $query3 = mysqli_query($conn, $q3);
        if(mysqli_num_rows($query3) == 0) {
            $q4 = "insert into company_commission values('$company_commission')";
            $query4 = mysqli_query($conn, $q4);
        }else {
            while($result3 = mysqli_fetch_assoc($query3)){
                $old_company_commission = $result3["company_commission"];
                $new_company_commission = $old_company_commission + $company_commission;
                $q4 = "update company_commission set company_commission = '$new_company_commission'";
                $query4 = mysqli_query($conn, $q4); 
            }
        }
            // old user commission and update
        $query10 = "select owner_id from vehicle_m where vehicle_id = '$vehicle_id'";
        $result10 = mysqli_query($conn, $query10);
        $compass = mysqli_fetch_assoc($result10);
        $com = $compass["owner_id"];
    
        $q5 = "select * from owner where owner_id = '$com'";
        $query5 = mysqli_query($conn, $q5);
        $result5 = mysqli_fetch_assoc($query5);
    
        $old_owner_commission = $result5["owner_commission"];
        if(!$old_owner_commission) {
            $q6 = "update owner set owner_commission = '$owner_commission' where owner_id = '$com'";
            $query6 = mysqli_query($conn, $q6);
        }else {
            $new_owner_commission = $old_owner_commission + $owner_commission;
            $q7 = "update owner set owner_commission = '$new_owner_commission' where owner_id = '$com'";
            $query7 = mysqli_query($conn, $q7); 
        }
        
        // update table renter
        $q8 = "insert into renter values('$user_id')";
        $query8 = mysqli_query($conn, $q8);
        
        // get order id
        $order_id = $result_order["order_id"]; 
        
        // update table payment
        $q9 = "insert into payment values('$user_id','$order_id','$payment_method','$amount')";
        $query9 = mysqli_query($conn, $q9);
        if($query9){
            header('location:http://localhost/easyride/views/userHome.php');
        }
    }else{
        echo "can't find order_id";
    }
}else {
    echo"can't fill order_history";
}
?>