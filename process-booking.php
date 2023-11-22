<?php
session_start();

if (!isset($_SESSION['Cust_ID'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $con = mysqli_connect('localhost', 'root', '', 'petsmile');

  if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
  }

    $petName = mysqli_real_escape_string($con, $_POST['petName']);
    $serviceID = mysqli_real_escape_string($con, $_POST['serviceID']);

    $staffName = mysqli_real_escape_string($con, $_POST['staffName']);
    if ($staffName === "any") {
        $staffName = null;
    }

    $customerID = $_SESSION['Cust_ID'];

    $getServiceTypeQuery = "SELECT Service_Type FROM service WHERE Service_ID = '$serviceID'";
    $serviceTypeResult = mysqli_query($con, $getServiceTypeQuery);
    $row = mysqli_fetch_assoc($serviceTypeResult);
    $serviceType = $row['Service_Type'];

    $table = "";

    if ($serviceType === "Pet Grooming") {
        $table = "groomingAppt";
        $bookingDate = mysqli_real_escape_string($con, $_POST['bookingDate']);
        $bookingTime = mysqli_real_escape_string($con, $_POST['bookingTime']);
        $insertBookingQuery = "INSERT INTO $table (Pet_ID, Service_ID, Staff_ID, GAppt_Date, GAppt_Time) VALUES ('$petName', '$serviceID', '$staffName', '$bookingDate', '$bookingTime')";
    }
    if ($serviceType === "Pet Treatment") {
        $table = "treatmentAppt";
        $bookingDate = mysqli_real_escape_string($con, $_POST['bookingDate']);
        $bookingTime = mysqli_real_escape_string($con, $_POST['bookingTime']);
        $insertBookingQuery = "INSERT INTO $table (Pet_ID, Service_ID, Staff_ID, TAppt_Date, TAppt_Time) VALUES ('$petName', '$serviceID', '$staffName', '$bookingDate', '$bookingTime')";
    }
    else if ($serviceType === "Pet Boarding"){
        $table = "boardingAppt";
        $boardingStartDate = mysqli_real_escape_string($con, $_POST['boardingStartDate']);
        $boardingEndDate = mysqli_real_escape_string($con, $_POST['boardingEndDate']);
        $insertBookingQuery = "INSERT INTO $table (Pet_ID, Service_ID, Staff_ID, BAppt_StartDate, BAppt_EndDate) VALUES ('$petName', '$serviceID', '$staffName', '$boardingStartDate', '$boardingEndDate')";
    }

    if (mysqli_query($con, $insertBookingQuery)) {
        $_SESSION['success_message'] = "Booking successful!";
        header("Location: booking-success.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Booking failed. Please try again later.";
        header("Location: booking.php?serviceID=$serviceID");
        exit;
    }
} else {
    header("Location: booking.php");
    exit;
}
?>
