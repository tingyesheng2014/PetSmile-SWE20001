<?php
session_start();

if (!isset($_SESSION['Cust_ID'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['appointmentID']) || !isset($_GET['appointmentType'])) {
    header("Location: bookinghistory.php");
    exit;
}

$appointmentID = $_GET['appointmentID'];
$appointmentType = $_GET['appointmentType'];

$con = mysqli_connect('localhost', 'root', '', 'petsmile');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($appointmentType === "Pet Grooming") {
    $tableName = "groomingAppt";
    $idColumn = "GAppt_ID";
} elseif ($appointmentType === "Pet Boarding") {
    $tableName = "boardingAppt";
    $idColumn = "BAppt_ID";
} else {
    header("Location: bookinghistory.php");
    exit;
}

$deleteQuery = "DELETE FROM $tableName WHERE $idColumn = '$appointmentID'";

if (mysqli_query($con, $deleteQuery)) {
    $_SESSION['success_message'] = "Appointment deleted successfully!";
} else {
    $_SESSION['error_message'] = "Failed to delete the appointment. Please try again later.";
}

mysqli_close($con);

header("Location: bookinghistory.php");
exit;
?>
