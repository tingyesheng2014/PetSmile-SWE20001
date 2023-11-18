<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Add Bootstrap CSS link here -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
include 'config.php';
include 'admin-header.php';

if (isset($_POST['update'])) {
    $Staff_ID = $_SESSION['Staff_ID'];
    $First_Name = $_POST['firstname'];
    $Last_Name = $_POST['lastname'];
    $Phone_No = $_POST['phoneno'];
    $Address = $_POST['address'];
    $City = $_POST['city'];
    $Postcode = $_POST['postcode'];
    $Position = $_POST['position'];

    $updateStaffQuery = "UPDATE staff SET First_Name='$First_Name', Last_Name='$Last_Name', Phone_No='$Phone_No', Address='$Address', City='$City', Postcode='$Postcode', Position='$Position' WHERE Staff_ID='$Staff_ID'";

    if (mysqli_query($con, $updateStaffQuery)) {
        echo '<div class="alert alert-success"><strong>Profile updated successfully!</strong></div>';
    } else {
        echo '<div class="alert alert-danger"><strong>Profile update failed!</strong> Please try again later.</div>';
    }
}

$Staff_ID = $_SESSION['Staff_ID'];
$selectStaffQuery = "SELECT * FROM staff WHERE Staff_ID='$Staff_ID'";
$staffResult = mysqli_query($con, $selectStaffQuery);
$staffData = mysqli_fetch_assoc($staffResult);
?>

    <!-- Carousel Start -->
    <body>
    <div class="container text-center mt-5">
        <h2 class="display-4 m-0">My <span class="text-primary">Profile</span></h2>
        <h3>Edit Profile</h3>
    </div>

    <div class="container">
        <form method="POST" action="admin-editprofile.php">
            <div class="form-group">
                <label for="staffid">Staff ID:</label>
                <input type="text" name="staffid" id="staffid" value="<?php echo $staffData['Staff_ID']; ?>" class="form-control"
                    required readonly>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" id="firstname" value="<?php echo $staffData['First_Name']; ?>"
                        class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" id="lastname" value="<?php echo $staffData['Last_Name']; ?>"
                        class="form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phoneno">Phone Number:</label>
                    <input type="tel" name="phoneno" id="phoneno" value="<?php echo $staffData['Phone_No']; ?>"
                        class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="position">Position:</label>
                    <input type="position" name="position" id="position" value="<?php echo $staffData['Position']; ?>"
                        class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" value="<?php echo $staffData['Address']; ?>"
                    class="form-control" required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city" value="<?php echo $staffData['City']; ?>" class="form-control"
                        required>
                </div>

                <div class="form-group col-md-6">
                    <label for="postcode">Postcode:</label>
                    <input type="text" name="postcode" id="postcode" value="<?php echo $staffData['Postcode']; ?>"
                        class="form-control" required>
                </div>
            </div>

            <input type="submit" name="update" value="Update Profile" class="btn btn-primary px-3 mt-3">
        </form>
    </div>

    <div class="container text-center mt-3">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <!-- Add Bootstrap JS and Popper.js links here -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    <!-- Carousel End -->

    <?php
    include 'footer.php';
    ?>

</html>
