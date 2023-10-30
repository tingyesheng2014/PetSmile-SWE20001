<?php
session_start();

if (!isset($_SESSION['Cust_ID'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['updateAppointment'])) {
    $appointmentID = $_POST['appointmentID'];
    $appointmentType = $_POST['appointmentType'];

    $con = mysqli_connect('localhost', 'root', '', 'petsmile');

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($appointmentType === "Pet Grooming") {
        $newDate = $_POST['new_date'];
        $newTime = $_POST['new_time'];

        $updateQuery = "UPDATE groomingAppt SET GAppt_Date = ?, GAppt_Time = ? WHERE GAppt_ID = ?";
        $stmt = mysqli_prepare($con, $updateQuery);
        mysqli_stmt_bind_param($stmt, 'ssi', $newDate, $newTime, $appointmentID);
    } elseif ($appointmentType === "Pet Boarding") {
        $newStartDate = $_POST['start_date'];
        $newEndDate = $_POST['end_date'];

        $updateQuery = "UPDATE boardingAppt SET BAppt_StartDate = ?, BAppt_EndDate = ? WHERE BAppt_ID = ?";
        $stmt = mysqli_prepare($con, $updateQuery);
        mysqli_stmt_bind_param($stmt, 'ssi', $newStartDate, $newEndDate, $appointmentID);
    }

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_message'] = "Appointment updated successfully!";
        header("Location: bookinghistory.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Failed to update the appointment: " . mysqli_error($con);
        header("Location: bookinghistory.php");
        exit;
    }
} else {
    header("Location: bookinghistory.php");
    exit;
}
?>
