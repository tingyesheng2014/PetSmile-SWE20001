<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'admin-header.php';

if (!isset($_SESSION['Staff_ID'])) {
    header("Location: admin-login.php");
    exit;
}

echo "<div class='container text-center mt-5'>";
echo "<h2 class='display-4 m-0'>Generate Monthly <span class='text-primary'>Report</span></h2>";
echo "</div>";

echo "<div class='container text-center mt-3'>";
echo "<form method='post' action='generate-report.php'>";
echo "<label for='month'>Select Month:</label>";
echo "<select name='month' id='month'>";
for ($i = 1; $i <= 12; $i++) {
    echo "<option value='$i'>" . date('F', mktime(0, 0, 0, $i, 1)) . "</option>";
}
echo "</select>";
echo "<button type='submit' class='btn btn-primary'>Generate Report</button>";
echo "</form>";
echo "</div>";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedMonth = $_POST['month'];

    // Fetch sales data for the selected month
    $salesQuery = "SELECT * FROM sales WHERE MONTH(Date) = $selectedMonth";
    $salesResult = mysqli_query($con, $salesQuery);

    if (!$salesResult) {
        die("Error in SQL query: " . mysqli_error($con));
    }

    // Display the sales data in a report format
    echo "<div class='container'>";
    echo "<h3 class='mt-3'>Monthly Sales Report for " . date('F', mktime(0, 0, 0, $selectedMonth, 1)) . "</h3>";
    echo "<table class='table table-bordered mt-3'>";
    echo "<thead class='thead-dark'>";
    echo "<tr>";
    echo "<th>Sales ID</th>";
    echo "<th>Customer ID</th>";
    echo "<th>Service ID</th>";
    echo "<th>Date</th>";
    echo "<th>Price</th>";
    echo "<th>Quantity</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($salesData = mysqli_fetch_assoc($salesResult)) {
        echo "<tr>";
        echo "<td>" . $salesData['Sales_ID'] . "</td>";
        echo "<td>" . $salesData['Cust_ID'] . "</td>";
        echo "<td>" . $salesData['Service_ID'] . "</td>";
        echo "<td>" . $salesData['Date'] . "</td>";
        echo "<td>" . $salesData['Price'] . "</td>";
        echo "<td>" . $salesData['Quantity'] . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
}

echo "<div class='container text-center mt-3'>";
echo "<a href='sales.php' class='btn btn-secondary'>Back to Previous Page</a>";
echo "</div>";

include 'footer.php';
?>

</html>
