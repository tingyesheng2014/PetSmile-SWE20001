<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'admin-header.php';

if (isset($_GET['salesID'])) {
    $salesID = $_GET['salesID'];

    // Assuming you have a form with input fields named 'Cust_ID', 'Service_ID', 'Price', and 'Quantity'
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $custID = $_POST['Cust_ID'];
        $serviceID = $_POST['Service_ID'];
        $price = $_POST['Price'];
        $quantity = $_POST['Quantity'];

        // Perform validation and update the 'sales' table
        $updateQuery = "UPDATE sales SET Cust_ID='$custID', Service_ID='$serviceID', Price='$price', Quantity='$quantity' WHERE Sales_ID='$salesID'";
        $updateResult = mysqli_query($con, $updateQuery);

        if (!$updateResult) {
            die("Error in SQL query: " . mysqli_error($con));
        }

        echo "<div class='container text-center mt-5'>";
        echo "<p class='text-success'>Sales updated successfully!</p>";
        echo "<a href='view-sales.php' class='btn btn-secondary'>Back to Sales Details</a>";
        echo "</div>";

    } else {
        // Display the form for editing sales
        $salesQuery = "SELECT * FROM sales WHERE Sales_ID='$salesID'";
        $salesResult = mysqli_query($con, $salesQuery);

        if (!$salesResult) {
            die("Error in SQL query: " . mysqli_error($con));
        }

        $salesData = mysqli_fetch_assoc($salesResult);

        if (!$salesData) {
            echo "<div class='container text-center mt-5'>";
            echo "<p class='text-danger'>Sales not found!</p>";
            echo "<a href='view-sales.php' class='btn btn-secondary'>Back to Sales Details</a>";
            echo "</div>";
            exit;
        }

        echo "<div class='container mt-3'>";
        echo "<h2 class='mb-3'>Edit Sales</h2>";
        echo "<form method='post' action='edit-sales.php?salesID=$salesID'>";
        echo "<div class='form-group'>";
        echo "<label for='Cust_ID'>Customer ID:</label>";
        echo "<input type='text' class='form-control' name='Cust_ID' value='" . $salesData['Cust_ID'] . "' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='Service_ID'>Service ID:</label>";
        echo "<input type='text' class='form-control' name='Service_ID' value='" . $salesData['Service_ID'] . "' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='Price'>Price:</label>";
        echo "<input type='text' class='form-control' name='Price' value='" . $salesData['Price'] . "' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='Quantity'>Quantity:</label>";
        echo "<input type='text' class='form-control' name='Quantity' value='" . $salesData['Quantity'] . "' required>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-primary'>Update Sales</button>";
        echo "</form>";
        echo "</div>";
    }

} else {
    echo "<div class='container text-center mt-5'>";
    echo "<p class='text-danger'>Sales ID not provided!</p>";
    echo "<a href='view-sales.php' class='btn btn-secondary'>Back to Sales Details</a>";
    echo "</div>";
}

include 'footer.php';
?>

</html>
