<?php
session_start();
   $id= $_GET['id'];

   $conn=mysqli_connect('localhost','root','','transportation_ms');
   $sql="SELECT * FROM bill WHERE id='$id'";
   $result=mysqli_query($conn,$sql);

   $std=mysqli_fetch_assoc($result);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin - Transportation MS</title>
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
        <div class="col-md-2">
          <a class="btn btn-info" href="index.php">Bill List</a>
        </div> 
        <div class="col-md-8">
        <h2>Edit bill</h2>
        <hr>

        
        <form action="updatebill.php?id=<?php echo '$id'.'$bill_id'; ?>" method="POST">
        
        <div class="form-group">
          <label for="name">ID :</label>
          <input required type="text" class="form-control" name="id" value="<?php echo $std['bill_id']?>">
        </div>

        <div class="form-group">
          <label for="Roll">Total KM :</label>
          <input required type="text" class="form-control" name="salary" value="<?php echo $std['total_km']?>">
        </div>
        
        <div class="form-group">
          <label for="Age">Extra Cost :</label>
          <input type="text" class="form-control" name="equipment" value="<?php echo $std['extra_cost']?>">
        </div>

        <div class="form-group">
          <label for="Address">Fuel Cost :</label>
          <input type="text" class="form-control" name="oil" value="<?php echo $std['fuel_cost']?>">
        </div>

        <div class="form-group">
          <label for="Mobile">Total cost :</label>
          <input type="text" class="form-control" name="tcost" value="<?php echo $std['total_cost']?>">
        </div>

        <button type="submit" class="btn btn-info">Submit</button>
      </form>
        </div>
      </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html> 