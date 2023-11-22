<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'admin-header.php';

if (!isset($_SESSION['Staff_ID'])) {
    header("Location: admin-login.php");
    exit;
}

$boardingAppointmentsQuery = "
    SELECT
        b.BAppt_ID,
        c.Cust_ID,
        p.Pet_Name,
        s.Service_Name,
        b.BAppt_CheckInDate,
        b.BAppt_CheckOutDate,
        b.Status
    FROM
        boardingAppt b
    INNER JOIN
        pet p ON b.Pet_ID = p.Pet_ID
    INNER JOIN
        service s ON b.Service_ID = s.Service_ID
    LEFT JOIN
        member c ON p.Cust_ID = c.Cust_ID
    WHERE
        b.Status = 'Approved'
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
    <h1 class="display-4 m-0">Pet <span class="text-primary">Boarding</span></h1>

    <h2 class="mt-4">Manage Pet Boarding</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Boarding ID</th>
                <th>Customer ID</th>
                <th>Pet Name</th>
                <th>Service Name</th>
                <th>Check In Date</th>
                <th>Check Out Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($boardingAppointmentsResult)) {
                echo "<tr>";
                echo "<td>{$row['BAppt_ID']}</td>";
                echo "<td>{$row['Cust_ID']}</td>";
                echo "<td>{$row['Pet_Name']}</td>";
                echo "<td>{$row['Service_Name']}</td>";
                echo "<td>{$row['BAppt_CheckInDate']}</td>";
                echo "<td>{$row['BAppt_CheckOutDate']}</td>";
                echo "<td>";

                // Check In
                if (empty($row['CheckIn_Date'])) {
                    echo "<button class='btn btn-success' onclick='promptCheckInOut(\"checkin\", {$row['BAppt_ID']})'>Check In</button>";
                }

                // Check Out
                if (empty($row['CheckOut_Date'])) {
                    echo " <button class='btn btn-danger' onclick='promptCheckInOut(\"checkout\", {$row['BAppt_ID']})'>Check Out</button>";
                }

                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    function promptCheckInOut(action, appointmentID) {
        var actionText = action === 'checkin' ? 'Check In' : 'Check Out';
        var promptText = 'Enter ' + actionText + ' Date (YYYY-MM-DD):';
        var inputDate = prompt(promptText, '');

        if (inputDate !== null && inputDate !== '') {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'admin-checkin-checkout-action.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === 'Success') {
                        var dateColumnId = action === 'checkin' ? 'CheckIn_Date' : 'CheckOut_Date';
                        var dateColumn = document.getElementById(`date_${appointmentID}_${dateColumnId}`);
                        dateColumn.innerHTML = inputDate;
                    } else {
                        alert('Error updating the database');
                    }
                }
            };

            var data = 'action=' + action + '&appointmentID=' + appointmentID + '&date=' + inputDate;
            xhr.send(data);
        }
    }
</script>


<?php
include 'footer.php';
?>

</html>
