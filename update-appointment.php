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

$tableName = "";
$columnName = "";

if ($appointmentType === "Pet Grooming") {
    $tableName = "groomingAppt";
    $columnName = "GAppt_ID";
} elseif ($appointmentType === "Pet Boarding") {
    $tableName = "boardingAppt";
    $columnName = "BAppt_ID";
} else {
    header("Location: bookinghistory.php");
    exit;
}

$selectQuery = "SELECT * FROM $tableName WHERE $columnName = '$appointmentID'";
$result = mysqli_query($con, $selectQuery);

if (!$result || mysqli_num_rows($result) === 0) {
    header("Location: bookinghistory.php");
    exit;
}

$appointmentData = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedPetName = mysqli_real_escape_string($con, $_POST['petName']);
    $selectedStaffName = mysqli_real_escape_string($con, $_POST['staffName']);

    $Cust_ID = $_SESSION['Cust_ID'];
    $selectPetIDQuery = "SELECT Pet_ID FROM pet WHERE Cust_ID='$Cust_ID' AND Pet_Name = '$selectedPetName'";
    $petIDResult = mysqli_query($con, $selectPetIDQuery);

    if ($petIDResult && mysqli_num_rows($petIDResult) > 0) {
        $petIDData = mysqli_fetch_assoc($petIDResult);
        $selectedPetID = $petIDData['Pet_ID'];
    } else {
        $_SESSION['error_message'] = "Pet not found.";
        header("Location: edit-appointment.php?appointmentID=$appointmentID&appointmentType=$appointmentType");
        exit;
    }

    $selectStaffIDQuery = "SELECT Staff_ID FROM staff WHERE Last_Name = '$selectedStaffName'";
    $staffIDResult = mysqli_query($con, $selectStaffIDQuery);

    if ($staffIDResult && mysqli_num_rows($staffIDResult) > 0) {
        $staffIDData = mysqli_fetch_assoc($staffIDResult);
        $selectedStaffID = $staffIDData['Staff_ID'];
    } else {
        $_SESSION['error_message'] = "Staff not found.";
        header("Location: edit-appointment.php?appointmentID=$appointmentID&appointmentType=$appointmentType");
        exit;
    }

    if ($appointmentType === "Pet Grooming") {
        // Handle grooming appointments
        $newDate = mysqli_real_escape_string($con, $_POST['new_date']);
        $newTime = mysqli_real_escape_string($con, $_POST['new_time']);

        if (!validateDate($newDate) || !validateTime($newTime)) {
            $_SESSION['error_message'] = "Invalid date or time format.";
            header("Location: edit-appointment.php?appointmentID=$appointmentID&appointmentType=$appointmentType");
            exit;
        }

        $updateQuery = "UPDATE groomingAppt SET GAppt_Date = ?, GAppt_Time = ?, Pet_ID = ?, Staff_ID = ? WHERE GAppt_ID = ?";
        $stmt = mysqli_prepare($con, $updateQuery);
        mysqli_stmt_bind_param($stmt, 'ssiii', $newDate, $newTime, $selectedPetID, $selectedStaffID, $appointmentID);
    } elseif ($appointmentType === "Pet Boarding") {
        // Handle boarding appointments
        $newStartDate = mysqli_real_escape_string($con, $_POST['start_date']);
        $newEndDate = mysqli_real_escape_string($con, $_POST['end_date']);

        if (!validateDate($newStartDate) || !validateDate($newEndDate)) {
            $_SESSION['error_message'] = "Invalid start date or end date format.";
            header("Location: edit-appointment.php?appointmentID=$appointmentID&appointmentType=$appointmentType");
            exit;
        }

        $updateQuery = "UPDATE boardingAppt SET BAppt_StartDate = ?, BAppt_EndDate = ?, Pet_ID = ?, Staff_ID = ? WHERE BAppt_ID = ?";
        $stmt = mysqli_prepare($con, $updateQuery);
        mysqli_stmt_bind_param($stmt, 'ssiii', $newStartDate, $newEndDate, $selectedPetID, $selectedStaffID, $appointmentID);
    } else {
        // Handle other appointment types or invalid types
        $_SESSION['error_message'] = "Invalid appointment type.";
        header("Location: bookinghistory.php");
        exit;
    }

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_message'] = "Appointment updated successfully!";
        header("Location: bookinghistory.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Failed to update the appointment. Please try again later.";
    }
}

?>
