<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'header.php';

if (isset($_GET['appointmentID']) && isset($_GET['appointmentType'])) {
    $appointmentID = $_GET['appointmentID'];
    $appointmentType = $_GET['appointmentType'];

    if ($appointmentType === "Pet Grooming" || $appointmentType === "Pet Boarding") {
        $appointmentQuery = "";
        if ($appointmentType === "Pet Grooming") {
            $appointmentQuery = "SELECT g.*, s.Service_Name, st.Last_Name AS Staff_Name
                                 FROM groomingAppt g
                                 INNER JOIN service s ON g.Service_ID = s.Service_ID
                                 LEFT JOIN staff st ON g.Staff_ID = st.Staff_ID
                                 WHERE g.GAppt_ID = '$appointmentID'";
        } elseif ($appointmentType === "Pet Boarding") {
            $appointmentQuery = "SELECT b.*, s.Service_Name, st.Last_Name AS Staff_Name
                                 FROM boardingAppt b
                                 INNER JOIN service s ON b.Service_ID = s.Service_ID
                                 LEFT JOIN staff st ON b.Staff_ID = st.Staff_ID
                                 WHERE b.BAppt_ID = '$appointmentID'";
        }

        $appointmentResult = mysqli_query($con, $appointmentQuery);

        if (!$appointmentResult) {
            die("Error in SQL query: " . mysqli_error($con));
        }

        $appointmentData = mysqli_fetch_assoc($appointmentResult);

        if (!$appointmentData) {
            echo "Appointment not found.";
            exit;
        }

        echo "<div class='container text-center mt-5'>";
        echo "<h2 class='display-4 m-0'>Appointment <span class='text-primary'>Details</span></h2>";
        echo "</div>";

        echo "<div class='container'>";
        if ($appointmentType === "Pet Grooming") {
            echo "<p><strong>Appointment Type:</strong> Pet Grooming</p>";
            echo "<p><strong>Appointment Date:</strong> " . $appointmentData['GAppt_Date'] . "</p>";
            echo "<p><strong>Appointment Time:</strong> " . $appointmentData['GAppt_Time'] . "</p>";
        } elseif ($appointmentType === "Pet Boarding") {
            echo "<p><strong>Appointment Type:</strong> Pet Boarding</p>";
            echo "<p><strong>Start Date:</strong> " . $appointmentData['BAppt_StartDate'] . "</p>";
            echo "<p><strong>End Date:</strong> " . $appointmentData['BAppt_EndDate'] . "</p>";
        }

        echo "<p><strong>Service:</strong> " . $appointmentData['Service_Name'] . "</p>";
        echo "<p><strong>Staff:</strong> " . $appointmentData['Staff_Name'] . "</p>";
        echo "<p><strong>Status:</strong> " . $appointmentData['Status'] . "</p>";

        echo "<a href='cancel-appointment.php?appointmentID=$appointmentID&appointmentType=$appointmentType' class='btn btn-danger'>Cancel Appointment</a>";
        echo "</div>";

        echo "<div class='container text-center mt-3'>";
        echo "<a href='bookinghistory.php' class='btn btn-secondary'>Back to Booking History</a>";
        echo "</div>";

    } else {
        echo "Invalid appointment type.";
        exit;
    }
} else {
    echo "Appointment details not provided.";
    exit;
}
?>

<?php
include 'footer.php';
?>

</html>
