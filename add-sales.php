<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'admin-header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a form with input fields named 'Cust_ID', 'Service_ID', 'Price', and 'Quantity'
    $custID = $_POST['Cust_ID'];
    $serviceID = $_POST['Service_ID'];
    $price = $_POST['Price'];
    $quantity = $_POST['Quantity'];

    // Perform validation and insert into the 'sales' table
    $insertQuery = "INSERT INTO sales (Cust_ID, Service_ID, Price, Quantity) VALUES ('$custID', '$serviceID', '$price', '$quantity')";
    $insertResult = mysqli_query($con, $insertQuery);

    if (!$insertResult) {
        die("Error in SQL query: " . mysqli_error($con));
    }

    echo "<div class='container text-center mt-5'>";
    echo "<p class='text-success'>Sales added successfully!</p>";
    echo "<a href='sales.php' class='btn btn-secondary'>Back to Sales Details</a>";
    echo "</div>";

} else {
    // Display the form for adding sales
    echo "<div class='container mt-3'>";
    echo "<h2 class='mb-3'>Add Sales</h2>";
    echo "<form method='post' action='add-sales.php'>";
    echo "<div class='form-group'>";
    echo "<label for='Cust_ID'>Customer ID:</label>";
    echo "<input type='text' class='form-control' name='Cust_ID' required>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label for='Service_ID'>Service ID:</label>";
    echo "<input type='text' class='form-control' name='Service_ID' required>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label for='Price'>Price:</label>";
    echo "<input type='text' class='form-control' name='Price' required>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label for='Quantity'>Quantity:</label>";
    echo "<input type='text' class='form-control' name='Quantity' required>";
    echo "</div>";
    echo "<button type='submit' class='btn btn-success'>Add Sales</button>";
    echo "</form>";
    echo "</div>";
}

include 'footer.php';
?>

</html>
