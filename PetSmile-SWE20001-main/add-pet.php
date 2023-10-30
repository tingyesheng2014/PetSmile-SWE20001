<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'header.php';

if (isset($_POST['addPet'])) {
    $Cust_ID = $_SESSION['Cust_ID'];
    $Pet_ID = mysqli_real_escape_string($con, $_POST['petid']);
    $Pet_Name = mysqli_real_escape_string($con, $_POST['petname']);
    $Pet_Sex = mysqli_real_escape_string($con, $_POST['petsex']);
    $Pet_Breed = mysqli_real_escape_string($con, $_POST['petbreed']);

    $insertPetQuery = "INSERT INTO pet (Cust_ID, Pet_ID, Pet_Name, Pet_Sex, Pet_Breed) VALUES ('$Cust_ID', '$Pet_ID', '$Pet_Name', '$Pet_Sex', '$Pet_Breed')";

    if (mysqli_query($con, $insertPetQuery)) {
        echo '<div class="alert alert-success"><strong>New pet added successfully!</strong></div>';
    } else {
        echo '<div class="alert alert-danger"><strong>Error adding the new pet!</strong> Please try again later.</div>';
    }
}
?>

    <!-- Carousel Start -->
    <form method="POST" action="add-pet.php">
        <h2>Add New Pet</h2>

        <!-- Pet details -->
        <div>
            <label for="petid">Pet ID:</label>
            <input type="text" name="petid" id="petid" required>
        </div>

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

        <input type="submit" name="addPet" value="Add Pet">
        <a href="edit-petprofile.php" class="btn btn-primary">Back to Pet Profile</a>
    </form>

    <!-- Carousel End -->
    
    <?php
    include 'footer.php';
    ?>

</html>
