<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'admin-header.php';

if (isset($_GET['appointmentID']) && isset($_GET['appointmentType'])) {
    $appointmentID = $_GET['appointmentID'];
    $appointmentType = $_GET['appointmentType'];

    if ($appointmentType === "Pet Grooming" || $appointmentType === "Pet Boarding" || $appointmentType === "Pet Treatment") {
        $appointmentQuery = "";
        if ($appointmentType === "Pet Grooming") {
            $appointmentQuery = "SELECT g.*, s.Service_Name, st.Last_Name AS Staff_Name,
                                 p.Pet_Name,
                                 c.Cust_ID
                                 FROM groomingAppt g
                                 INNER JOIN service s ON g.Service_ID = s.Service_ID
                                 INNER JOIN pet p ON g.Pet_ID = p.Pet_ID
                                 LEFT JOIN staff st ON g.Staff_ID = st.Staff_ID
                                 LEFT JOIN member c ON p.Cust_ID = c.Cust_ID
                                 WHERE g.GAppt_ID = '$appointmentID'";
        } if ($appointmentType === "Pet Treatment") {
              $appointmentQuery = "SELECT t.*, s.Service_Name, st.Last_Name AS Staff_Name,
                                p.Pet_Name,
                                c.Cust_ID
                                FROM treatmentAppt t
                                INNER JOIN service s ON t.Service_ID = s.Service_ID
                                INNER JOIN pet p ON t.Pet_ID = p.Pet_ID
                                LEFT JOIN staff st ON t.Staff_ID = st.Staff_ID
                                LEFT JOIN member c ON p.Cust_ID = c.Cust_ID
                                WHERE t.TAppt_ID = '$appointmentID'";
        } elseif ($appointmentType === "Pet Boarding") {
            $appointmentQuery = "SELECT b.*, s.Service_Name, st.Last_Name AS Staff_Name,
                                 p.Pet_Name,
                                 c.Cust_ID
                                 FROM boardingAppt b
                                 INNER JOIN service s ON b.Service_ID = s.Service_ID
                                 INNER JOIN pet p ON b.Pet_ID = p.Pet_ID
                                 LEFT JOIN staff st ON b.Staff_ID = st.Staff_ID
                                 LEFT JOIN member c ON p.Cust_ID = c.Cust_ID
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
            echo "<p><strong>Customer ID:</strong> " . $appointmentData['Cust_ID'] . "</p>";
            echo "<p><strong>Pet Name:</strong> " . $appointmentData['Pet_Name'] . "</p>";
            echo "<p><strong>Appointment Date:</strong> " . $appointmentData['GAppt_Date'] . "</p>";
            echo "<p><strong>Appointment Time:</strong> " . $appointmentData['GAppt_Time'] . "</p>";
        } if ($appointmentType === "Pet Treatment") {
            echo "<p><strong>Appointment Type:</strong> Pet Treatment</p>";
            echo "<p><strong>Customer ID:</strong> " . $appointmentData['Cust_ID'] . "</p>";
            echo "<p><strong>Pet Name:</strong> " . $appointmentData['Pet_Name'] . "</p>";
            echo "<p><strong>Appointment Date:</strong> " . $appointmentData['TAppt_Date'] . "</p>";
            echo "<p><strong>Appointment Time:</strong> " . $appointmentData['TAppt_Time'] . "</p>";
        } elseif ($appointmentType === "Pet Boarding") {
            echo "<p><strong>Appointment Type:</strong> Pet Boarding</p>";
            echo "<p><strong>Customer ID:</strong> " . $appointmentData['Cust_ID'] . "</p>";
            echo "<p><strong>Pet Name:</strong> " . $appointmentData['Pet_Name'] . "</p>";
            echo "<p><strong>Start Date:</strong> " . $appointmentData['BAppt_StartDate'] . "</p>";
            echo "<p><strong>End Date:</strong> " . $appointmentData['BAppt_EndDate'] . "</p>";
        }

        echo "<p><strong>Service:</strong> " . $appointmentData['Service_Name'] . "</p>";
        echo "<p><strong>Staff:</strong> " . $appointmentData['Staff_Name'] . "</p>";
        echo "<p><strong>Status:</strong> " . $appointmentData['Status'] . "</p>";

        echo "<a href='admin-edit-appointment.php?appointmentID=$appointmentID&appointmentType=$appointmentType' class='btn btn-primary px-3 mt-3'>Edit Appointment</a>";
        echo "</div>";

        echo "<div class='container text-center mt-3'>";
        echo "<a href='admin-bookinghistory.php' class='btn btn-secondary'>Back to Booking History</a>";
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
