<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<?php
include 'config.php';

if (isset($_GET['delete'])) {
    $SuppliesIDToDelete = $_GET['delete'];
    $Supplies_ID = $_SESSION['Supplies_ID'];

    $deleteSuppliesQuery = "DELETE FROM inventory WHERE Supplies_ID = '$SuppliesIDToDelete'";

    if (mysqli_query($con, $deleteSuppliesQuery)) {
        echo '<div class="alert alert-success"><strong>Pet deleted successfully!</strong></div>';
    } else {
        echo '<div class="alert alert-danger"><strong>Pet deletion failed!</strong> Please try again later.</div>';
    }
}

$select_inventory = mysqli_query($con, "SELECT * FROM `inventory`");
if(mysqli_num_rows($select_inventory) > 0){
?>

<body>
<div class="row py-3 px-lg-5">
            <div class="col-lg-4">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-capitalize"><span class="text-primary">Pet</span>Smile</h1>
                </a>
            </div>
    </div>
    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span class="text-primary">Safety</span>First</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="admin-home.php" class="nav-item nav-link">Home</a>
                    <a href="sales.php" class="nav-item nav-link">Sales</a>
                    <a href="supplies.php" class="nav-item nav-link active">Supplies</a>
                    <a href="admin-bookinghistory.php" class="nav-item nav-link">Booking History</a>
                      </div>
                  </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <div class="container">
            <h1 class="display-4 m-0">Supplies <span class="text-primary">Inventory</span></h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Supplies ID</th>
                        <th>Supplies Name</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    while($row = mysqli_fetch_assoc($select_inventory)){ 
                      echo "<tr>";
                      echo "<td>{$row['Supplies_ID']}</td>";
                      echo "<td>{$row['Supplies_Name']}</td>";
                      echo "<td>{$row['Price']}</td>";
                      echo "<td>{$row['Date']}</td>";
                      echo "<td>{$row['Total']}</td>";
                        ?>
                      <td><a href="supplies.php?delete=<?= $Supplies_ID; ?>" class="btn btn-danger" onclick="return confirm('Delete this supplies?');">Delete</a></td>
                      <?php
                      echo "</tr>";
                  }
                }
                  ?>
                </tbody>
                </table>
                </div>
            </br></br> </br></br></br></br></br></br></br></br></br>
    <div class="container-fluid text-white py-4 px-sm-3 px-md-5" style="background: #111111;">
        <div class="row">
            <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">
                    &copy; <a class="text-white font-weight-bold" href="#">Your Site Name</a>. All Rights Reserved.
					Designed by <a class="text-white font-weight-bold">Pet Emergency</a>
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
