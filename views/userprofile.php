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
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />

  <link rel="stylesheet" href="">

  <title>EASYRIDE</title>
</head>
<body>
    <section id ="header" class="my-5">
        <!-- navigation bar -->
        <nav id = "main_nav" class="navbar navbar-expand-lg navbar-light bg-light fixed-top py-0">
            <div class="container-fluid">
                    <a class="navbar-brand" href="./userHome.php"><i class="fas fa-biking"></i> EASY<span>RIDE</span></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                            <a class="nav-link" href="./carslist.php">Cars<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="./carslist.php">Bikes<span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./userHome.php">Dashboard</a>
                                </li>
                        </ul>
                        <ul class="navbar-nav navbar-right">
                                <li class="nav-item">
                                    <a class = "nav-link" href="../functionalities/login_signup/login/index.html"><?php echo "signed in as " .$_SESSION["username"];?> </a>
                                </li> 
                                <?php if(!isset($_SESSION['username'])) { ?>
                                   <li class="nav-item">
                                    <a class = "nav-link" href="../functionalities/login_signup/login/index.html"><i class ="fas fa-sign-in-alt"></i> Login </a>
                                    </li>                       
                                    <li class="nav-item">
                                    <a class = "nav-link" href="../functionalities/login_signup/sign_up/index.html"><i class ="fas fa-user-plus"></i> Sign Up </a>
                                    </li>
                                <?php } 
                                else { ?>
                                <li class="nav-item">
                                        <a class = "nav-link" href="./logout.php"><i class ="fas fa-sign-out-alt"></i> Logout </a>
                                </li>
                                <?php } ?>
                        </ul>
                    </div>
            </div>
        </nav>
    </section>
    <div class="container">
        <div class="jumbotron" style = "color: #2c3e50; background-color: #ecf0f1;">
            <?php
                // getting user id
                $username = $_SESSION["username"];
                $q1 = "select * from user where username = '$username'";
                $query1 = mysqli_query($conn, $q1);
                $result1 = mysqli_fetch_assoc($query1);
                $user_id = $result1["user_id"];
                echo "<h5>Name : </h5>".$result1["name"]."<hr><br><h5>Username : </h5>".$username."<hr><br><h5>Username : </h5>".$result1["phone"]."<hr><br><h5>Email : </h5>".$result1["email"]."<hr><br><h5>DOB : </h5>".$result1["dob"];
                if($result1["address"] != ""){
                    echo "<hr><br><h5>Address : </h5>".$result1["address"];
                }
                $end =strtotime("today");
                $start = strtotime($result1["dob"]);
                $age = round(abs($end - $start) / 31536000);
                echo "<hr><br><h5>Age : </h5>".$age;
            ?>
        </div>
    </div>

    <!-- footer -->
    <hr class="style-eight" >
    <p>© EASYRIDE 2019</p>
    <!-- scripts to use -->
    <script src = ""></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>


