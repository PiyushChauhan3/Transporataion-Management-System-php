<?php
    
    $connection= mysqli_connect("localhost","root","","transportation_ms");
    session_start();
    
    $id= $_GET['id'];

    $sql= "SELECT * FROM `booking` WHERE booking_id='$id'"; 

    //echo $sql;
    $res= mysqli_query($connection,$sql);
    $row= mysqli_fetch_assoc($res);

if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = $row['email'];
    
    //echo $email_to;
    
 
     
 
     
 
 
 
     
 
    // validation expected data exists
 /*
    if(!isset($_POST['first_name']) ||
 
        // !isset($_POST['last_name']) ||
 
        !isset($_POST['email']) ||
 
        !isset($_POST['phone']) ||
 
        !isset($_POST['comment'])) {
 
        died('');       //enter msg within this string
 
    }*/
 
     
 
    $first_name = $row['name']; // required
 
    // $last_name = $_POST['last_name']; // required
 
    $email_from = "iafbd24@gmail.com"; // required
 
    $telephone = $row['mobile']; // not required
 
    //$comments = $_POST['comment']; // required
    $driver_id= $_POST['driverid'];
    //echo $driver_id;
    
    $veh_reg= $_POST['veh_reg'];
    //$veh_reg= $_POST[''];
    //echo $veh_reg;
    
    $sql2="SELECT * FROM `driver` WHERE driverid='$driver_id'";
    $res2= mysqli_query($connection,$sql2);
    $row2= mysqli_fetch_assoc($res2);
    
    $driver_name=$row2['drname'];
    $driver_mobile=$row2['drmobile'];
    //echo $driver_name;
    //echo $driver_mobile;
     
 
   
 
    $email_message = " This is an email form Transport  Management System to confirm your vehicle. Details are given below.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "first Name: ".clean_string($first_name)."\n";
 
    // $email_message .= "Last Name: ".clean_string($last_name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Phone: ".clean_string($telephone)."\n\n";
 
    $email_message .= "Driver's Name: ".clean_string($driver_name)."\n";
    $email_message .= "Vehicle Regitration: ".clean_string($veh_reg)."\n";
    $email_message .= "Driver's Phone Number: ".clean_string($driver_mobile)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers); 
    
 
$update_query="UPDATE `booking` SET `confirmation`='1',`veh_reg`='$veh_reg',`driverid`='$driver_id' WHERE booking_id='$id'; UPDATE `vehicle` SET `veh_available`='1' WHERE veh_reg='$veh_reg';UPDATE `driver` SET `dr_available`='1' WHERE driverid='$driver_id'";
    
//$update_query="UPDATE `booking` SET `confirmation`='1' WHERE booking_id='$id'";
//echo $update_query;
    

    
//$res3=mysqli_query($connection,$update_query);
$res3=mysqli_multi_query($connection,$update_query);  //to run multiple query
 
?>
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>success</title>
     <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <link rel="stylesheet" href="animate.css">
     <link rel="stylesheet" href="style.css"> -->
     <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link href="assets/vendor/flagiconcss/css/flag-icon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="wrapper">
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <img src="assets/img/tms.png" alt="bootraper logo" class="app-logo">
            </div>
            <ul class="list-unstyled components text-secondary">
                <li>
                    <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#ticketbookingmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fa-solid fa-ticket"></i> Ticket Booking</a>
                    <ul class="collapse list-unstyled" id="ticketbookingmenu">
                        <li>
                            <a href="#busbookingmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fas fa-bus"></i> Bus Booking</a>
                            <ul class="collapse list-unstyled" id="busbookingmenu">
                                <li>
                                    <a href="bus_route.php">Bus & Routes</a>
                                </li>
                                <li>
                                    <a href="admin-add-bus.php">Add Buses</a>
                                </li>
                                <li>
                                    <a href="admin-booking-list.php">Booking List</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#vehiclebookingmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fa-solid fa-truck"></i> Vehicle Booking</a>
                    <ul class="collapse list-unstyled" id="vehiclebookingmenu">
                        <li>
                            <a href="newvehicle.php"> Add New Vehicle</a>
                        </li>
                        <li>
                            <a href="newdriver.php"> Add New Driver</a>
                        </li>
                        <li>
                            <a href="indexbill.php"> Billing</a>
                        </li>
                        <li>
                            <a href="bookingvlist.php"> Booking </a>
                        </li>
                        <li>
                            <a href="tripdetail.php"> Trip details</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#goods-logistics" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fa-solid fa-truck-fast"></i> Goods & Logistics</a>
                    <ul class="collapse list-unstyled" id="goods-logistics">
                        <li>
                            <a href="view-booking.php"> View Bookings</a>
                        </li>
                        <li>
                            <a href="manage-billing.php"> Manage Billing</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="users.php"><i class="fas fa-user-friends"></i>Users</a>
                </li>
                <li>
                    <a href="adminlist.php"><i class="fas fa-user-shield"></i>Admin</a>
                </li>
            </ul>
        </nav>
        <div id="body" class="active">
            <!-- navbar navigation component -->
            <nav class="navbar navbar-expand-lg navbar-white bg-white">
                <button type="button" id="sidebarCollapse" class="btn btn-light">
                    <i class="fas fa-bars"></i><span></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> <span><?php echo $_SESSION['admin_email']; ?></span> <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                                    <ul class="nav-list">
                                        <li><a href="" class="dropdown-item"><i class="fas fa-address-card"></i> Profile</a></li>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="http://localhost/Transportation%20MS/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- end of navbar navigation -->
   <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
               <br><br><br><br><br>
                <div class="alert alert-success animated tada">
                      <strong>Success!</strong> Mail has been sent successfully.
                </div>
                
                <a class="btn btn-default" href="bookingvlist.php">Go Back</a>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
     
 </body>
 <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/main.js"></script>
 </html>
 

 
 <?php
 
}
 
?>
