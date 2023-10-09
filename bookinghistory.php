<?php
session_start();

if (!isset($_SESSION['Cust_ID'])) {
    header("Location: login.php");
    exit;
}

$con = mysqli_connect('localhost', 'root', '', 'petsmile');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$customerID = $_SESSION['Cust_ID'];

$groomingAppointmentsQuery = "
    SELECT
        g.GAppt_ID,
        p.Pet_Name,
        s.Service_Name,
        st.Last_Name AS Staff_Name,
        g.GAppt_Date,
        g.GAppt_Time,
        g.Status
    FROM
        groomingAppt g
    INNER JOIN
        pet p ON g.Pet_ID = p.Pet_ID
    INNER JOIN
        service s ON g.Service_ID = s.Service_ID
    INNER JOIN
        staff st ON g.Staff_ID = st.Staff_ID
    WHERE
        p.Cust_ID = '$customerID'
";

$groomingAppointmentsResult = mysqli_query($con, $groomingAppointmentsQuery);

$boardingAppointmentsQuery = "
    SELECT
        b.BAppt_ID,
        p.Pet_Name,
        s.Service_Name,
        st.Last_Name AS Staff_Name,
        b.BAppt_StartDate,
        b.BAppt_EndDate,
        b.Status
    FROM
        boardingAppt b
    INNER JOIN
        pet p ON b.Pet_ID = p.Pet_ID
    INNER JOIN
        service s ON b.Service_ID = s.Service_ID
    INNER JOIN
        staff st ON b.Staff_ID = st.Staff_ID
    WHERE
        p.Cust_ID = '$customerID'
";

$boardingAppointmentsResult = mysqli_query($con, $boardingAppointmentsQuery);

if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
} elseif (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']);
}
?>

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

<body>
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
                    <a href="home.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <a href="service.php" class="nav-item nav-link">Service</a>
                    <a href="bookinghistory.php" class="nav-item nav-link active">Booking History</a>
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

    <div class="container">
            <h1 class="display-4 m-0">Booking <span class="text-primary">History</span></h1>

            <!-- Display Pet Grooming Appointments -->
            <h2 class="mt-4">Pet Grooming Appointments</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Grooming Appointment ID</th>
                        <th>Pet Name</th>
                        <th>Service Name</th>
                        <th>Staff Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                  while ($row = mysqli_fetch_assoc($groomingAppointmentsResult)) {
                      echo "<tr>";
                      echo "<td>{$row['GAppt_ID']}</td>";
                      echo "<td>{$row['Pet_Name']}</td>";
                      echo "<td>{$row['Service_Name']}</td>";
                      echo "<td>{$row['Staff_Name']}</td>";
                      echo "<td>{$row['GAppt_Date']}</td>";
                      echo "<td>{$row['GAppt_Time']}</td>";
                      echo "<td>{$row['Status']}</td>";
                      echo "<td><button class='btn btn-primary' onclick='editAppointment({$row['GAppt_ID']}, \"Pet Grooming\")'>Edit</button></td>";
                      echo "<td><button class='btn btn-danger' onclick='deleteAppointment({$row['GAppt_ID']}, \"Pet Grooming\")'>Delete</button></td>";
                      echo "</tr>";
                  }
                  ?>

                </tbody>
            </table>

            <!-- Display Pet Boarding Appointments -->
            <h2 class="mt-4">Pet Boarding Appointments</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Boarding Appointment ID</th>
                        <th>Pet Name</th>
                        <th>Service Name</th>
                        <th>Staff Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                  while ($row = mysqli_fetch_assoc($boardingAppointmentsResult)) {
                      echo "<tr>";
                      echo "<td>{$row['BAppt_ID']}</td>";
                      echo "<td>{$row['Pet_Name']}</td>";
                      echo "<td>{$row['Service_Name']}</td>";
                      echo "<td>{$row['Staff_Name']}</td>";
                      echo "<td>{$row['BAppt_StartDate']}</td>";
                      echo "<td>{$row['BAppt_EndDate']}</td>";
                      echo "<td>{$row['Status']}</td>";
                      echo "<td><button class='btn btn-primary' onclick='editAppointment({$row['BAppt_ID']}, \"Pet Boarding\")'>Edit</button></td>";
                      echo "<td><button class='btn btn-danger' onclick='deleteAppointment({$row['BAppt_ID']}, \"Pet Boarding\")'>Delete</button></td>";
                      echo "</tr>";
                  }
                  ?>

                </tbody>
            </table>

            <script>
            function deleteAppointment(appointmentID, appointmentType) {
                if (confirm("Are you sure you want to delete this appointment?")) {
                    window.location.href = `delete-appointment.php?appointmentID=${appointmentID}&appointmentType=${appointmentType}`;
                }
            }
            </script>

            <script>
            function editAppointment(appointmentID, appointmentType) {
                if (appointmentType === "Pet Grooming") {
                    window.location.href = `edit-appointment.php?appointmentID=${appointmentID}&appointmentType=${appointmentType}`;
                } else if (appointmentType === "Pet Boarding") {
                    window.location.href = `edit-appointment.php?appointmentID=${appointmentID}&appointmentType=${appointmentType}`;
                }
            }
            </script>

        </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-4 col-md-12 mb-5">
                <h1 class="mb-3 display-5 text-capitalize text-white"><span class="text-primary">Pet</span>Lover</h1>
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
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-white py-4 px-sm-3 px-md-5" style="background: #111111;">
        <div class="row">
            <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">
                    &copy; <a class="text-white font-weight-bold" href="#">Your Site Name</a>. All Rights Reserved.

					<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
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
