<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'header.php';

if (isset($_POST['addPet'])) {
    $Cust_ID = $_SESSION['Cust_ID'];
    $Pet_Name = mysqli_real_escape_string($con, $_POST['petname']);
    $Pet_Sex = mysqli_real_escape_string($con, $_POST['petsex']);
    $Pet_Breed = mysqli_real_escape_string($con, $_POST['petbreed']);

    $insertPetQuery = "INSERT INTO pet (Cust_ID, Pet_Name, Pet_Sex, Pet_Breed) VALUES ('$Cust_ID', '$Pet_Name', '$Pet_Sex', '$Pet_Breed')";

    if (mysqli_query($con, $insertPetQuery)) {
        echo '<div class="alert alert-success"><strong>New pet added successfully!</strong></div>';
    } else {
        echo '<div class="alert alert-danger"><strong>Error adding the new pet!</strong> Please try again later.</div>';
    }
}
?>

    <!-- Carousel Start -->
    <body>
        <div class="container text-center mt-5">
            <h2 class="display-4 m-0">Add <span class="text-primary">New Pet</span></h2>
            <h3>Add Pet</h3>
        </div>

        <div class="container">
            <form method="POST" action="add-pet.php">
                <!-- Pet details -->
                <div>
                    <label for="petname">Pet Name:</label>
                    <input type="text" name="petname" id="petname" required>
                </div>

                <div>
                    <label for="petsex">Pet Sex:</label>
                    <input type="text" name="petsex" id="petsex" required>
                </div>

                <div>
                    <label for="petbreed">Pet Breed:</label>
                    <input type="text" name="petbreed" id="petbreed" required>
                </div>

                <input type="submit" name="addPet" value="Add Pet" class="btn btn-success mt-3">
            </form>
        </div>

        <div class="container text-center mt-3">
            <a href="edit-petprofile.php" class="btn btn-lg btn-primary px-3">Back to Pet Profile</a>
        </div>
    </body>
    <!-- Carousel End -->

    <?php
    include 'footer.php';
    ?>

</html>
