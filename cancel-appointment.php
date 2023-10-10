<?php
include 'config.php';

if (isset($_GET['appointmentID']) && isset($_GET['appointmentType'])) {
    $appointmentID = $_GET['appointmentID'];
    $appointmentType = $_GET['appointmentType'];

    if ($appointmentType === "Pet Grooming" || $appointmentType === "Pet Boarding") {
        $tableName = ($appointmentType === "Pet Grooming") ? "groomingAppt" : "boardingAppt";
        $primaryKeyColumn = ($appointmentType === "Pet Grooming") ? "GAppt_ID" : "BAppt_ID";

        $cancelAppointmentQuery = "UPDATE $tableName SET Status = 'Canceled' WHERE $primaryKeyColumn = '$appointmentID'";
        $cancelAppointmentResult = mysqli_query($con, $cancelAppointmentQuery);

        if (!$cancelAppointmentResult) {
            die("Error in SQL query: " . mysqli_error($con));
        }

        $_SESSION['success_message'] = "Appointment canceled successfully";
        header("Location: bookinghistory.php");
        exit;
    } else {
        echo "Invalid appointment type.";
        exit;
    }
} else {
    echo "Appointment details not provided.";
    exit;
}
?>
