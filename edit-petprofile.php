<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'header.php';

if (isset($_POST['update'])) {
    $Cust_ID = $_SESSION['Cust_ID'];
    $Pet_Name = $_POST['petname'];
    $Pet_Sex = $_POST['petsex'];
    $Pet_Breed = $_POST['petbreed'];
    $Pet_ID = $_POST['petid'];

    $updatePetQuery = "UPDATE pet SET Pet_Name='$Pet_Name', Pet_Sex='$Pet_Sex', Pet_Breed='$Pet_Breed' WHERE Pet_ID='$Pet_ID'";

    if (mysqli_query($con, $updatePetQuery)) {
        echo '<div class="alert alert-success"><strong>Pet profile updated successfully!</strong></div>';
    } else {
        echo '<div class="alert alert-danger"><strong>Pet profile update failed!</strong> Please try again later.</div>';
    }
}

$Cust_ID = $_SESSION['Cust_ID'];
$selectPetQuery = "SELECT * FROM pet WHERE Cust_ID='$Cust_ID'";
$petResult = mysqli_query($con, $selectPetQuery);
$petData = mysqli_fetch_assoc($petResult);
?>

    <!-- Carousel Start -->
    <form method="POST" action="edit-petprofile.php">
        <h2>Edit Pet Profile</h2>

        <h3>Pet Details</h3>

        <!-- Pet selection dropdown -->
        <div class="form-group">
            <label for="petToEdit">Select Pet:</label>
            <select name="petToEdit" id="petToEdit" class="form-control">
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

        <!-- Pet details -->
        <div id="petDetails">
            <div>
                <label for="petid">Pet ID:</label>
                <input type="text" name="petid" id="petid" value="">
            </div>
            <div>
                <label for="petname">Pet Name:</label>
                <input type="text" name="petname" id="petname" value="">
            </div>
            <div>
                <label for="petsex">Pet Sex:</label>
                <input type="text" name="petsex" id="petsex" value="">
            </div>
            <div>
                <label for="petbreed">Pet Breed:</label>
                <input type="text" name="petbreed" id="petbreed" value="">
            </div>
        </div>

        <input type="submit" name="update" value="Update Profile">
        <a href="edit-profile.php" class="btn btn-lg btn-primary px-3 mt-3">Go to My Profile</a>

        <a href="add-pet.php" class="btn btn-success mt-3">Add New Pet</a>
    </form>

    <!-- JavaScript to fetch and display pet details -->
    <script>
        document.getElementById('petToEdit').addEventListener('change', function () {
            var selectedPetID = this.value;
            var petDetailsDiv = document.getElementById('petDetails');

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fetch-pet-details.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var petDetails = JSON.parse(xhr.responseText);

                    document.getElementById('petid').value = petDetails.Pet_ID;
                    document.getElementById('petname').value = petDetails.Pet_Name;
                    document.getElementById('petsex').value = petDetails.Pet_Sex;
                    document.getElementById('petbreed').value = petDetails.Pet_Breed;
                }
            };
            xhr.send('petID=' + selectedPetID);
        });
    </script>

    <!-- Carousel End -->

    <?php
    include 'footer.php';
    ?>

</html>
