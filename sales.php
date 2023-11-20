<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'admin-header.php';

echo "<div class='container text-center mt-5'>";
echo "<h2 class='display-4 m-0'>Sales <span class='text-primary'>Details</span></h2>";
echo "</div>";

echo "<div class='container'>";
echo "<div class='text-right mb-3'>";
echo "<a href='add-sales.php' class='btn btn-success'>Add Sales</a>";
echo "</div>";

echo "<table class='table table-bordered mt-3'>";
echo "<thead class='thead-dark'>";
echo "<tr>";
echo "<th>Sales ID</th>";
echo "<th>Customer ID</th>";
echo "<th>Service ID</th>";
echo "<th>Price</th>";
echo "<th>Quantity</th>";
echo "<th>Actions</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

// Assuming you have a table named 'sales' in your database
$salesQuery = "SELECT * FROM sales";
$salesResult = mysqli_query($con, $salesQuery);

if (!$salesResult) {
    die("Error in SQL query: " . mysqli_error($con));
}

$totalSales = 0;

while ($salesData = mysqli_fetch_assoc($salesResult)) {
    echo "<tr>";
    echo "<td>" . $salesData['Sales_ID'] . "</td>";
    echo "<td>" . $salesData['Cust_ID'] . "</td>";
    echo "<td>" . $salesData['Service_ID'] . "</td>";
    echo "<td>" . $salesData['Price'] . "</td>";
    echo "<td>" . $salesData['Quantity'] . "</td>";
    echo "<td>";
    echo "<a href='edit-sales.php?salesID=" . $salesData['Sales_ID'] . "' class='btn btn-primary btn-sm'>Edit</a> ";
    echo "<a href='delete-sales.php?salesID=" . $salesData['Sales_ID'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this sale?\")'>Delete</a>";
    echo "</td>";
    echo "</tr>";

    // Calculate total sales
    $totalSales += $salesData['Price'] * $salesData['Quantity'];
}

// Display total row
echo "<tr class='table-info'>";
echo "<td colspan='3'></td>";
echo "<td colspan='2'><strong>Total Sales:</strong></td>";
echo "<td><strong>RM" . $totalSales . "</strong></td>";
echo "</tr>";

echo "</tbody>";
echo "</table>";
echo "</div>";

echo "<div class='container text-center mt-3'>";
echo "<a href='admin-home.php' class='btn btn-secondary'>Back to Previous Page</a>";
echo "</div>";

include 'footer.php';
?>

</html>
