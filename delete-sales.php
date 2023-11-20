<?php
include 'config.php';

if (isset($_GET['salesID'])) {
    $salesID = $_GET['salesID'];

    // Perform deletion from the 'sales' table
    $deleteQuery = "DELETE FROM sales WHERE Sales_ID='$salesID'";
    $deleteResult = mysqli_query($con, $deleteQuery);

    if (!$deleteResult) {
        die("Error in SQL query: " . mysqli_error($con));
    }

    // Redirect to the sales details page after deletion
    header("Location: sales.php");
    exit;
} else {
    echo "<div class='container text-center mt-5'>";
    echo "<p class='text-danger'>Sales ID not provided!</p>";
    echo "<a href='view-sales.php' class='btn btn-secondary'>Back to Sales Details</a>";
    echo "</div>";
}
?>
