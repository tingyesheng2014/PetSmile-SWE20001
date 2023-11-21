<?php
include 'config.php';

if (!isset($_SESSION['Staff_ID'])) {
    header("Location: admin-login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['appointmentID'], $_POST['date'])) {
    $action = $_POST['action'];
    $appointmentID = $_POST['appointmentID'];
    $date = $_POST['date'];

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        echo 'Invalid date format';
        exit;
    }

    $columnName = ($action === 'checkin') ? 'BAppt_CheckInDate' : 'BAppt_CheckOutDate';
    $updateQuery = "UPDATE boardingAppt SET $columnName = '$date' WHERE BAppt_ID = $appointmentID";

    $result = mysqli_query($con, $updateQuery);

    if ($result) {
        echo 'Success';
    } else {
        echo 'Error updating the database';
    }
} else {
    echo 'Invalid request';
}
?>
