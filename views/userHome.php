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

  <link rel="stylesheet" href="../assets/stylesheets/userHome.css">

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
                            <a class="nav-link" href="http://localhost/easyride/views/carslist.php">Cars<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="http://localhost/easyride/views/bikeslist.php">Bikes<span class="sr-only">(current)</span></a>
                                </li>
                            <li class="nav-item">
                            <a class="nav-link" href="userHome.php">Dashboard</a>
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
    
    <div class="container-fluid">
        <div class="row">
          <nav class="col-md-2 d-none d-md-block navbar-light bg-light sidebar">
            <div class="sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" href="userHome.php">
                    <i class="fas fa-home"></i>
                    Dashboard <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#history">
                    <i class="fas fa-history"></i>
                    Ride History
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="http://localhost/easyride/views/userprofile.php">
                    <i class="fas fa-id-badge"></i>
                    User Profile
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="http://localhost/easyride/views/becomeowner.php">
                    <i class="fas fa-wallet"></i>
                      Earn With Easyride
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"  data-toggle="modal" data-target="#contactModal">
                    <i class="fas fa-address-card"></i>
                    Contact Us
                  </a>
                </li>
              </ul>
            </div>
          </nav>
      
          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="row">
                <div class="col-sm-6">
                        <div class="card text-center">
                                <img class="card-img-top" src="../imgs/car_1.jpg" alt="Card image cap">
                                <div class="card-body">
                                  <h5 class="card-title">Cars</h5>
                                  <a href="http://localhost/easyride/views/carslist.php" class="btn btn-dark">Book Now</a>
                                </div>
                              </div>                    
                </div>
                <div class="col-sm-6">
                        <div class="card text-center">
                                <img class="card-img-top" src="../imgs/bike_1.jpg" alt="Card image cap">
                                <div class="card-body">
                                  <h5 class="card-title">Bikes</h5>
                                  <a href="http://localhost/easyride/views/bikeslist.php" class="btn btn-dark">Book Now</a>
                                </div>
                        </div>                    
                </div>
            </div>
            <hr>
            <hr>
            <div id="history" class = "container">
                <hr class="style-two">
                <h1 class="diplay-1 text-center">History</h1>
                <hr class="style-two">
                <div id="history-list" class="card-footer">
                <hr> 
                    <div class="row">
                    <?php
                    $username = $_SESSION["username"];
                        $q1 = "select user_id from user where username = '$username'";
                        $q2 = mysqli_query($conn,$q1);
                        $d = mysqli_fetch_assoc($q2);
                        $user_id = $d["user_id"];
                        $q3 = "select * from order_history where user_id = '$user_id'";
                        $q4 = mysqli_query($conn,$q3);
                        if(mysqli_num_rows($q4)>0)
                        {	
                            while($d=mysqli_fetch_assoc($q4)) {
                             echo "<div class=\"col-md-12\"> 
                                <span> Order Id:".$d["order_id"]."</span> <span class =\"float-right\">Order Date :-". $d["o_date"]." </span> <p>Vehicle No. :- ".$d["vehicle_id"]."<span class = \"float-right\"> Return Date :-".$d["r_date"]."</span></p>";
                                $var = $d["vehicle_id"];
                                $nq = "select * from vehicle_m where vehicle_id  = '$var'";
                                $search = mysqli_query($conn, $nq);
                                $result = mysqli_fetch_assoc($search);
                                $d_vehicle_id = $d["vehicle_id"];

                                // finding out the charge for the vehicle 
                                $qcharge = "select charge from vehicle_m where vehicle_id = '$d_vehicle_id'";
                                $querycharge = mysqli_query($conn, $qcharge);
                                $resultcharge = mysqli_fetch_assoc($querycharge);

                                // finding out total number of days
                                $start = strtotime($d["o_date"]);
                                $end = strtotime($d["r_date"]);
                                $days = round(abs($end - $start) / 86400);
                                $total_cost = $days * $resultcharge["charge"];
                                if($result["type"] == "car") {
                                    echo "<h5>type : car </h5><span> Total Cost :-".$total_cost."</span><hr class=\"style-two\">";  
                                } else {
                                    echo "<h5>type : bike </h5><span> Total Cost :-".$total_cost."</span><hr class=\"style-two\">";
                                }?>
                            </div>   
                           <?php } 
                        } else { ?> 
                            <li>no bookings done yet </li>
                        <?php }
                    ?>
                </div>
            </div>
          </main>
        </div>
      </div>

   
      <!-- Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Contact Us</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="container text-center">
                    <i class="fas fa-envelope-square"></i> easyride2019@gmail.com
                    <p class="text-center">OR</p>
                    <a class="fab fa-facebook" href="https://www.facebook.com"></a>
                    <a class="fab fa-twitter" href="http://www.twitter.com"></a>
                    <a class="fab fa-instagram" href="http://www.instagram.com"></a>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            </div>
          </div>
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