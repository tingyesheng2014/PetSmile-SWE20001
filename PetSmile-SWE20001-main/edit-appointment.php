<!DOCTYPE html>
<html lang="en">

<?php

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

$selectQuery = "SELECT * FROM $tableName WHERE $idColumn = '$appointmentID'";
$result = mysqli_query($con, $selectQuery);

if (!$result || mysqli_num_rows($result) === 0) {
    header("Location: bookinghistory.php");
    exit;
}

$appointmentData = mysqli_fetch_assoc($result);
?>

    <body>
    <div class="container">
        <h1 class="display-4 m-0">Edit Appointment</h1>

        <!-- Display appointment details in a form for editing -->
        <form action="update-appointment.php" method="POST">
          <input type="hidden" name="appointmentID" value="<?php echo $appointmentID; ?>">
          <input type="hidden" name="appointmentType" value="<?php echo $appointmentType; ?>">

            <?php
            $petID = $appointmentData['Pet_ID'];
            $selectPetQuery = "SELECT Pet_Name FROM pet WHERE Pet_ID = '$petID'";
            $petResult = mysqli_query($con, $selectPetQuery);

            if ($petResult && mysqli_num_rows($petResult) > 0) {
                $petData = mysqli_fetch_assoc($petResult);
                $petName = $petData['Pet_Name'];
            } else {
                $petName = "Pet Not Found";
            }

            echo '<div class="form-group">
                        <label for="pet_name">Pet Name:</label>
                        <input type="text" id="pet_name" name="pet_name" value="' . $petName . '" readonly>
                    </div>';
            ?>

            <?php
            $serviceID = $appointmentData['Service_ID'];
            $selectServiceQuery = "SELECT Service_Name FROM service WHERE Service_ID = '$serviceID'";
            $serviceResult = mysqli_query($con, $selectServiceQuery);

            if ($serviceResult && mysqli_num_rows($serviceResult) > 0) {
                $serviceData = mysqli_fetch_assoc($serviceResult);
                $serviceName = $serviceData['Service_Name'];
            } else {
                $serviceName = "Service Not Found";
            }

            echo '<div class="form-group">
                        <label for="service_name">Service Name:</label>
                        <input type="text" id="service_name" name="service_name" value="' . $serviceName . '" readonly>
                    </div>';
            ?>

            <?php
            if ($appointmentType === "Pet Boarding") {
                echo '<div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" id="start_date" name="start_date" value="' . $appointmentData['BAppt_StartDate'] . '" required>
                        </div>';

                echo '<div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input type="date" id="end_date" name="end_date" value="' . $appointmentData['BAppt_EndDate'] . '" required>
                        </div>';
            } else {
                echo '<div class="form-group">
                            <label for="new_date">New Appointment Date:</label>
                            <input type="date" id="new_date" name="new_date" value="' . $appointmentData['GAppt_Date'] . '" required>
                        </div>';

                echo '<div class="form-group">
                            <label for="new_time">New Appointment Time:</label>
                            <input type="time" id="new_time" name="new_time" value="' . $appointmentData['GAppt_Time'] . '" required>
                        </div>';
            }
            ?>
            <?php
            $staffID = $appointmentData['Staff_ID'];
            $selectStaffQuery = "SELECT Last_Name FROM staff WHERE Staff_ID = '$staffID'";
            $staffResult = mysqli_query($con, $selectStaffQuery);

            if ($staffResult && mysqli_num_rows($staffResult) > 0) {
                $staffData = mysqli_fetch_assoc($staffResult);
                $staffName = $staffData['Last_Name'];
            } else {
                $staffName = "Staff Not Found";
            }

            echo '<div class="form-group">
                        <label for="staff_name">Staff Name:</label>
                        <input type="text" id="staff_name" name="staff_name" value="' . $staffName . '" readonly>
                    </div>';
            ?>

            <input type="submit" name="updateAppointment" value="Update Appointment">
        </form>
    </div>
    </body>

    <?php
    include 'footer.php';
    ?>

</html>
