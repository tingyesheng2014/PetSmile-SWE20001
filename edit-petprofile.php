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

if (isset($_GET['delete'])) {
    $petIDToDelete = $_GET['delete'];
    $Cust_ID = $_SESSION['Cust_ID'];

    $deletePetQuery = "DELETE FROM pet WHERE Pet_ID = '$petIDToDelete' AND Cust_ID = '$Cust_ID'";

    if (mysqli_query($con, $deletePetQuery)) {
        echo '<div class="alert alert-success"><strong>Pet deleted successfully!</strong></div>';
    } else {
        echo '<div class="alert alert-danger"><strong>Pet deletion failed!</strong> Please try again later.</div>';
    }
}

$Cust_ID = $_SESSION['Cust_ID'];
$selectPetQuery = "SELECT * FROM pet WHERE Cust_ID='$Cust_ID'";
$petResult = mysqli_query($con, $selectPetQuery);
$petData = mysqli_fetch_assoc($petResult);

?>

    <!-- Carousel Start -->
    <body>
      <div class="container text-center mt-5">
        <h2 class="display-4 m-0">Pet <span class="text-primary">Profile</span></h2>
        <h3>Edit Pet Details</h3>
      </div>

        <div class="container">
            <form method="POST" action="edit-petprofile.php">
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
                    <a href="edit-petprofile.php?delete=<?= $petID; ?>" class="btn btn-danger" onclick="return confirm('Delete this pet?');">Delete</a>
                </div>

                <form method="POST" action="add-pet.php">
                <div class="container">
                <div id="petDetails" class="form-group">
                    <label for="petid">Pet ID:</label>
                    <input type="text" name="petid" id="petid" class="form-control"value="" readonly>
                </div>
                

                <div class="form-group">
                    <label for="petname">Pet Name:</label>
                    <input type="text" name="petname" id="petname" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="petsex">Pet Sex:</label>
                    <input type="text" name="petsex" id="petsex" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="petbreed">Pet Breed:</label>
                    <input type="text" name="petbreed" id="petbreed" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="petbreed">Pet Health (How many vaccine taken):</label>
                    <input type="text" name="pethealth" id="pethealth" class="form-control" required>
                </div>

                <input type="submit" name="addPet" value="Add Pet" class="btn btn-success mt-3">
            </form>
        </div>

                <input type="submit" name="update" value="Update Profile" class="btn btn-primary px-3 mt-3">
                <a href="add-pet.php" class="btn btn-success mt-3">Add New Pet</a>
            </form>
        </div>

        <div class="container text-center mt-3">
            <a href="edit-profile.php" class="btn btn-lg btn-primary px-3">Go to My Profile</a>
        </div>

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
                    document.getElementById('pethealth').value = petDetails.Pet_Health;
                }
            };
            xhr.send('petID=' + selectedPetID);
        });
    </script>
  </body>

    <!-- Carousel End -->

    <?php
    include 'footer.php';
    ?>

</html>
