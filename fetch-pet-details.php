<?php
$con = mysqli_connect('localhost', 'root', '', 'petsmile');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['petID'])) {
    $petID = $_POST['petID'];

    // Fetch pet details
    $selectPetQuery = "SELECT * FROM pet WHERE Pet_ID='$petID'";
    $petResult = mysqli_query($con, $selectPetQuery);
    $petData = mysqli_fetch_assoc($petResult);

    echo json_encode($petData);
}
