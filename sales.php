<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Sales Report</title>
</head>
<?php
include 'config.php';
include 'admin-header.php';

if (!isset($_SESSION['Staff_ID'])) {
    header("Location: admin-login.php");
    exit;
}


$StaffID = $_SESSION['Staff_ID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <body>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div class="container">
            <h1 class="display-4 m-0">Sales <span class="text-primary">Report</span></h1>
        
            <table class="table">
                <thead>
                    <tr>
                        <th>SalesID</th>
                        <th>Customer ID</th>
                        <th>Service name</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Total</th>
                    </tr>
                </thead>
                </div>
            </table>
</body>
</html>
<?php
include 'footer.php';
?>

</html>