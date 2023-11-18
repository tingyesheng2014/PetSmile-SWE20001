<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin Dashboard</title>
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopMe Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .dashboard-card {
            background-color: #f5f5f5;
            border-radius: 5px;
            padding: 20px;
            margin: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Heloo welcome back</h1>
        <div class="dashboard-card">
            <div>
                <h3>Staff Name</h3>
                <p><?php echo ('Staff1');  ?></p>
            </div>
            <div>
                <h3>User</h3>
                <p><?php echo date('2'); ?> </p>
            </div>
            <div>
                <h3>Feedback</h3>
                <p><?php echo date('3'); ?> </p>
            </div>
        </div>
        <div class="dashboard-card">
            <div>
                <h3>Inventory</h3>
                <p><?php echo ('100');  ?></p>
            </div>
            <div>
                <h3>Sales</h3>
                <p>RM<?php echo date('36000'); ?> </p>
            </div>
            <div>
                <h3>Product</h3>
                <p><?php echo date('1'); ?> </p>
            </div>
        </div>
        <div class="dashboard-card">
            <div>
            <h3>Grooming appointment</h3>
            <p><?php echo date('4'); ?> </p>
            </div>
            <div>
            <h3>Boarding appointment</h3>
            <p><?php echo date('6'); ?> </p>
            </div>
            <div>
                <h3>Earn</h3>
                <p>RM<?php echo date('40000'); ?></p>
            </div>
        </div>
    </div>
</body>
</html>
</body>
<?php
include 'footer.php';
?>

</html>