<?php
session_start();

$con = mysqli_connect('localhost', 'root', '', 'petsmile');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['serviceID'])) {
    $serviceID = $_GET['serviceID'];

    $selectServicesQuery = "SELECT * FROM service WHERE Service_ID = '$serviceID'";
    $servicesResult = mysqli_query($con, $selectServicesQuery);

    if (!$servicesResult) {
        die("Error in SQL query: " . mysqli_error($con));
    }

    $serviceData = mysqli_fetch_assoc($servicesResult);

    if (!$serviceData) {
        echo "Service not found.";
        exit;
    }

    $serviceName = $serviceData['Service_Name'];
    $serviceDesc = $serviceData['Service_Desc'];
    $price = $serviceData['Price'];
    $imageFileName = $serviceData['Img'];
    $serviceType = $serviceData['Service_Type'];
} else {
    echo "Service ID not provided.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

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

<body>
    <!-- Topbar Start -->
        <div class="row py-3 px-lg-5">
            <div class="col-lg-4">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-capitalize"><span class="text-primary">Pet</span>Smile</h1>
                </a>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="d-inline-flex flex-column text-center pr-3 border-right">
                        <h6>Opening Hours</h6>
                        <p class="m-0">10.00AM - 6.00PM</p>
                    </div>
                    <div class="d-inline-flex flex-column text-center px-3 border-right">
                        <h6>Email Us</h6>
                        <p class="m-0">petsmileofficial@gmail.com</p>
                    </div>
                    <div class="d-inline-flex flex-column text-center pl-3">
                        <h6>Call Us</h6>
                        <p class="m-0">+012 345 6789</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

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
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <a href="service.php" class="nav-item nav-link">Service</a>
                    <a href="bookinghistory.php" class="nav-item nav-link">Booking History</a>
                    <div class="nav-item dropdown">
                      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Booking</a>
                      <div class="dropdown-menu rounded-0 m-0">
                          <a href="boarding.php" class="dropdown-item">Pet Boarding</a>
                          <a href="grooming.php" class="dropdown-item">Pet Grooming</a>
                          <a href="treatment.php" class="dropdown-item">Pet Treatment</a>
                      </div>
                  </div>
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                </div>
                <?php
                if (isset($_SESSION['Cust_ID'])) {
                    echo '<a href="edit-profile.php" class="btn btn-lg btn-primary px-3 d-none d-lg-block">Hi, ' . $_SESSION['Cust_ID'] . '</a>';
                } else {
                  echo'<a href="login.php" class="btn btn-lg btn-primary px-3 d-none d-lg-block">Login</a>';
                }
                ?>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <body>
        <div class="container">
          <h1 class="display-4 m-0">Booking <span class="text-primary">Details</span></h1>
            <?php
            echo "<img src='img/$imageFileName' alt='$serviceName' style='max-width: 500px;'><br>";
            echo "<p><strong>Service Name:</strong> $serviceName</p>";
            echo "<p><strong>Description:</strong> $serviceDesc</p>";
            echo "<p><strong>Price:</strong> $price</p>";
            ?>
            <form action="process-booking.php" method="POST">
                <div class="form-group">
                    <label for="petName">Select Pet:</label>
                    <select name="petName" id="petName" class="form-control">
                      <option value="">Select a Pet</option>
                        <?php
                        $Cust_ID = $_SESSION['Cust_ID'];
                        $selectPetQuery = "SELECT * FROM pet WHERE Cust_ID='$Cust_ID'";
                        $petResult = mysqli_query($con, $selectPetQuery);

                        while ($row = mysqli_fetch_assoc($petResult)) {
                            $petID = $row['Pet_ID'];
                            $petName = $row['Pet_Name'];
                            echo "<option value='$petID'>$petName</option>";
                        }
                        ?>
                    </select>
                </div>


                <?php
                if ($serviceType === "Pet Boarding") {
                    echo '<div class="form-group">
                              <label for="boardingStartDate">Boarding Start Date:</label>
                              <input type="date" id="boardingStartDate" name="boardingStartDate" required>
                          </div>';

                    echo '<div class="form-group">
                              <label for="boardingEndDate">Boarding End Date:</label>
                              <input type="date" id="boardingEndDate" name="boardingEndDate" required>
                          </div>';
                }
                else {
                    echo '<div class="form-group">
                              <label for="bookingDate">Booking Date:</label>
                              <input type="date" id="bookingDate" name="bookingDate" required>
                          </div>';

                    echo '<div class="form-group">
                              <label for="bookingTime">Booking Time:</label>
                              <input type="time" id="bookingTime" name="bookingTime" required>
                          </div>';
                }
                ?>

                <div class="form-group">
                  <label for="staffName">Select Staff:</label>
                  <select name="staffName" id="staffName" class="form-control">
                      <option selected>Select A Staff</option>
                      <?php
                      $staffQuery = "SELECT * FROM staff";
                      $staffResult = mysqli_query($con, $staffQuery);

                      while ($row = mysqli_fetch_assoc($staffResult)) {
                          $staffID = $row['Staff_ID'];
                          $staffName = $row['Last_Name'];
                          echo "<option value='$staffID'>$staffName</option>";
                      }
                      ?>
                  </select>
              </div>

                <input type="hidden" name="serviceID" value="<?php echo $serviceID; ?>">
                <input type="submit" value="Book Now">
            </form>
        </div>
    </body>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-4 col-md-12 mb-5">
                <h1 class="mb-3 display-5 text-capitalize text-white"><span class="text-primary">Pet</span>Smile</h1>
                <p class="m-0">Pet Smile is a trusted Subang Jaya pet shop, providing top-notch pet care services for over a decade. We offer boarding, grooming, and pet supplies, all driven by our love for animals and a commitment to excellent service.</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-primary mb-4">Get In Touch</h5>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>51,SS14,SubangJaya</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+012 345 67890</p>
                        <p><i class="fa fa-envelope mr-2"></i>petsmileofficial@gmail.com</p>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-primary mb-4">Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="home.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-white mb-2" href="about.php"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                            <a class="text-white mb-2" href="service.php"><i class="fa fa-angle-right mr-2"></i>Our Services</a>
                            <a class="text-white" href="contact.php"><i class="fa fa-angle-right mr-2"></i>Feedback</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-primary mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0" placeholder="Your Email" required="required" />
                            </div>
                            <div>
                                <button class="btn btn-lg btn-primary btn-block border-0" type="submit">Submit Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
