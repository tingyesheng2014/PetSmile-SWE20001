<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'admin-header.php';

if (isset($_GET['appointmentID']) && isset($_GET['appointmentType'])) {
    $appointmentID = $_GET['appointmentID'];
    $appointmentType = $_GET['appointmentType'];

    if ($appointmentType === "Pet Grooming" || $appointmentType === "Pet Boarding") {
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $newStaff = $_POST['new_staff'];
                    if ($newStaff === "any") {
                        $newStaff = null;
                    }
                    $newStatus = $_POST['new_status'];

        if ($appointmentType === "Pet Grooming") {
          $newDate = $_POST['new_date'];
          $newTime = $_POST['new_time'];

          $updateQuery = "UPDATE groomingAppt SET
              GAppt_Date = '$newDate',
              GAppt_Time = '$newTime',
              Staff_ID = '$newStaff',
              Status = '$newStatus'
              WHERE GAppt_ID = '$appointmentID'";
      } elseif ($appointmentType === "Pet Boarding") {
          $newStartDate = $_POST['start_date'];
          $newEndDate = $_POST['end_date'];

          $updateQuery = "UPDATE boardingAppt SET
              BAppt_StartDate = '$newStartDate',
              BAppt_EndDate = '$newEndDate',
              Staff_ID = '$newStaff',
              Status = '$newStatus'
              WHERE BAppt_ID = '$appointmentID'";
      }

      if (mysqli_query($con, $updateQuery)) {
          $_SESSION['success_message'] = 'Appointment updated successfully.';
          header("Location: admin-bookinghistory.php");
          exit;
      } else {
          $_SESSION['error_message'] = 'Error updating appointment: ' . mysqli_error($con);
      }
  }

        echo "<div class='container text-center mt-5'>";
        echo "<h2 class='display-4 m-0'>Appointment <span class='text-primary'>Details</span></h2>";
        echo "</div>";

        echo "<div class='container'>";
        echo "<form method='POST'>";
        if ($appointmentType === "Pet Grooming") {
                    echo "<input type='hidden' name='appointmentType' value='Pet Grooming'>";
                    echo "<p><strong>Appointment Type:</strong> Pet Grooming</p>";
                    echo "<p><strong>Customer ID:</strong> " . $appointmentData['Cust_ID'] . "</p>";
                    echo "<p><strong>Pet Name:</strong> " . $appointmentData['Pet_Name'] . "</p>";

                    echo '<div class="form-group">
                                <label for="new_date">Appointment Date:</label>
                                <input type="date" id="new_date" name="new_date" value="' . $appointmentData['GAppt_Date'] . '" required>
                            </div>';

                    echo '<div class="form-group">
                                <label for="new_time">Appointment Time:</label>
                                <input type="time" id="new_time" name="new_time" value="' . $appointmentData['GAppt_Time'] . '" required>
                            </div>';
                } elseif ($appointmentType === "Pet Boarding") {
                    echo "<input type='hidden' name='appointmentType' value='Pet Boarding'>";
                    echo "<p><strong>Appointment Type:</strong> Pet Boarding</p>";
                    echo "<p><strong>Customer ID:</strong> " . $appointmentData['Cust_ID'] . "</p>";
                    echo "<p><strong>Pet Name:</strong> " . $appointmentData['Pet_Name'] . "</p>";

                    echo '<div class="form-group">
                                <label for="start_date">Start Date:</label>
                                <input type="date" id="start_date" name="start_date" value="' . $appointmentData['BAppt_StartDate'] . '" required>
                            </div>';

                    echo '<div class="form-group">
                                <label for="end_date">End Date:</label>
                                <input type="date" id="end_date" name="end_date" value="' . $appointmentData['BAppt_EndDate'] . '" required>
                            </div>';
                }

                echo "<p><strong>Service:</strong> " . $appointmentData['Service_Name'] . "</p>";

                $staffQuery = "SELECT * FROM staff";
                $staffResult = mysqli_query($con, $staffQuery);

                echo '<div class="form-group">
                        <label for="new_staff">Staff:</label>
                        <select id="new_staff" name="new_staff" class="form-control" required>
                        <option value="any">Any Staff</option>';
                while ($row = mysqli_fetch_assoc($staffResult)) {
                        $staffID = $row['Staff_ID'];
                        $staffName = $row['Last_Name'];
                        $selected = ($row['Staff_ID'] == $appointmentData['Staff_ID']) ? 'selected' : '';
                        echo "<option value='$staffID' $selected>$staffName</option>";
                }
                echo '</select>
                    </div>';

                echo '<div class="form-group">
                        <label for="new_status">Status:</label>
                        <select id="new_status" name="new_status" class="form-control" required>
                            <option value="Pending" ' . ($appointmentData['Status'] == 'Pending' ? 'selected' : '') . '>Pending</option>
                            <option value="Approved" ' . ($appointmentData['Status'] == 'Approved' ? 'selected' : '') . '>Approved</option>
                            <option value="Rejected" ' . ($appointmentData['Status'] == 'Rejected' ? 'selected' : '') . '>Rejected</option>
                            <option value="Canceled" ' . ($appointmentData['Status'] == 'Canceled' ? 'selected' : '') . '>Canceled</option>
                        </select>
                      </div>';

                echo '<input type="submit" name="updateAppointment" value="Update Appointment" class="btn btn-primary px-3 mt-3">';
                echo "<a href='admin-delete-appointment.php?appointmentID=$appointmentID&appointmentType=$appointmentType' class='btn btn-danger px-3 mt-3'>Delete Appointment</a>";

                echo "</form>";
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
