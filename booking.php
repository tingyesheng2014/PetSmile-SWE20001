<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'header.php';

if (isset($_GET['serviceID'])) {
    $serviceID = $_GET['serviceID'];

    $selectServicesQuery = "SELECT * FROM service WHERE Service_ID = '$serviceID'";
    $servicesResult = mysqli_query($con, $selectServicesQuery);

    if (!$servicesResult) {
        die("Error in SQL query: " . mysqli_error($con));
    }

    $serviceData = mysqli_fetch_assoc($servicesResult);

    if (!$serviceData) {
        echo "Service not found.";
        exit;
    }

    $serviceName = $serviceData['Service_Name'];
    $serviceDesc = $serviceData['Service_Desc'];
    $price = $serviceData['Price'];
    $imageFileName = $serviceData['Img'];
    $serviceType = $serviceData['Service_Type'];
} else {
    echo "Service ID not provided.";
    exit;
}
?>

    <body>
        <div class="container text-center mt-5">
          <h1 class="display-4 m-0">Booking <span class="text-primary">Details</span></h1>
        </div>

        <div class="container d-flex justify-content-center align-items-center mt-4">
                <div class="text-center">
                    <img src="img/<?php echo $imageFileName; ?>" alt="<?php echo $serviceName; ?>" style="max-width: 500px;">
                </div>
            </div>

        <div class="container mt-4">
            <?php
            echo "<p><strong>Service Name:</strong> $serviceName</p>";
            echo "<p><strong>Description:</strong> $serviceDesc</p>";
            echo "<p><strong>Price:</strong> $price</p>";
            ?>
            <form action="process-booking.php" method="POST">
                <div class="form-group">
                    <label for="petName">Select Pet:</label>
                    <select name="petName" id="petName" class="form-control">
                      <option value="">Select a Pet</option>
                        <?php
                        $Cust_ID = $_SESSION['Cust_ID'];
                        $selectPetQuery = "SELECT * FROM pet WHERE Cust_ID='$Cust_ID'";
                        $petResult = mysqli_query($con, $selectPetQuery);

                        while ($row = mysqli_fetch_assoc($petResult)) {
                            $petID = $row['Pet_ID'];
                            $petName = $row['Pet_Name'];
                            echo "<option value='$petID'>$petName</option>";
                        }
                        ?>
                    </select>
                </div>

                <?php
                if ($serviceType === "Pet Boarding") {
                    echo '<div class="form-group">
                              <label for="boardingStartDate">Boarding Start Date:</label>
                              <input type="date" id="boardingStartDate" name="boardingStartDate" required>
                          </div>';

                    echo '<div class="form-group">
                              <label for="boardingEndDate">Boarding End Date:</label>
                              <input type="date" id="boardingEndDate" name="boardingEndDate" required>
                          </div>';
                }
                else {
                    echo '<div class="form-group">
                              <label for="bookingDate">Booking Date:</label>
                              <input type="date" id="bookingDate" name="bookingDate" required>
                          </div>';

                    echo '<div class="form-group">
                              <label for="bookingTime">Booking Time:</label>
                              <input type="time" id="bookingTime" name="bookingTime" required>
                          </div>';
                }
                ?>

                <div class="form-group">
                  <label for="staffName">Select Staff:</label>
                  <select name="staffName" id="staffName" class="form-control">
                      <option selected>Select A Staff</option>
                      <option value="any">Any Staff</option>
                      <?php
                      $staffQuery = "SELECT * FROM staff";
                      $staffResult = mysqli_query($con, $staffQuery);

                      while ($row = mysqli_fetch_assoc($staffResult)) {
                          $staffID = $row['Staff_ID'];
                          $staffName = $row['Last_Name'];
                          echo "<option value='$staffID'>$staffName</option>";
                      }
                      ?>
                  </select>
              </div>
                <input type="hidden" name="serviceID" value="<?php echo $serviceID; ?>">
                <input type="submit" value="Book Now">
            </form>
          </div>
        </div>
    </body>

    <?php
    include 'footer.php';
    ?>

</html>
