<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['Cust_ID'])) {
    header("Location: login.php");
    exit;
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
    LEFT JOIN
        staff st ON g.Staff_ID = st.Staff_ID
    WHERE
        p.Cust_ID = '$customerID'
    ORDER BY g.GAppt_Date ASC;
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
    LEFT JOIN
        staff st ON b.Staff_ID = st.Staff_ID
    WHERE
        p.Cust_ID = '$customerID'
    ORDER BY b.BAppt_StartDate ASC;
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

    <div class="container">
            <h1 class="display-4 m-0">Booking <span class="text-primary">History</span></h1>

            <form method="post" id="historyForm">
                <div class="form-group">
                    <label for="bookingType">Select Booking Type:</label>
                    <select name="bookingType" id="bookingType" class="form-control">
                        <option>All Appointment</option>
                        <option>Pet Grooming Appointment</option>
                        <option>Pet Boarding Appointment</option>
                    </select>
                </div>
                <input type="submit" value="Show History" class="btn btn-primary">
            </form>

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
                        <th>Action</th>
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
                      echo "<td><button class='btn btn-primary' onclick='viewAppointment({$row['GAppt_ID']}, \"Pet Grooming\")'>View</button></td>";
                      echo "</tr>";
                  }
                  ?>

                </tbody>
            </table>

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
                        <th>Action</th>
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
                      echo "<td><button class='btn btn-primary' onclick='viewAppointment({$row['BAppt_ID']}, \"Pet Boarding\")'>View</button></td>";
                      echo "</tr>";
                  }
                  ?>

                </tbody>
            </table>

            <script>
                function viewAppointment(appointmentID, appointmentType) {
                    window.location.href = `view-appointment.php?appointmentID=${appointmentID}&appointmentType=${appointmentType}`;
                }
            </script>

        </div>

        <?php
        include 'footer.php';
        ?>

</html>
