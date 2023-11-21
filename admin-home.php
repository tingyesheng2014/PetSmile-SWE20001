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
?>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f7f7f7;
        color: #333;
    }

    header {
        background-color: #3498db;
        color: #fff;
        text-align: center;
        padding: 1em 0;
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    .dashboard-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 20px;
        margin: 20px 0;
    }

    .dashboard-card div {
        flex: 1;
    }

    h3 {
        margin-bottom: 10px;
        color: #333;
    }

    .p1 {
        margin: 0;
        font-size: 1.2em;
        color: #555;
    }
</style>

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
        <h2>Hello Welcome Back</h2>
        <div class="dashboard-card">
            <div>
                <?php
                  $select_users = mysqli_query($con, "SELECT * FROM `member`");
                  $number_of_users = mysqli_num_rows($select_users);
                  ?>
                <h3>User</h3>
                <p1><?php echo $number_of_users; ?></p1>
            </div>
            <div>
                  <?php
                  $select_feedback = mysqli_query($con, "SELECT * FROM `feedback`");
                  $number_of_feedback = mysqli_num_rows($select_feedback);
                  ?>
                <h3>Feedback</h3>
                <p1><?php echo $number_of_feedback; ?></p1>
            </div>
        </div>
        <div class="dashboard-card">
            <div>
                <?php
                    $select_quantity = mysqli_query($con, "SELECT Quantity FROM `inventory`");
                    $number_of_quantity = mysqli_num_rows($select_quantity);
                ?>
                <h3>Inventory</h3>
                <p1><?php while ($row = mysqli_fetch_assoc($select_quantity)) {
                     $quantity = $row['Quantity'];
                    echo "$quantity<br>";
                    } ?></p1>
            </div>
            <div>
                <?php
                  $totalSales = 0;
                  $select_pendings = mysqli_query($con, "SELECT * FROM `sales`");
                  while ($row = mysqli_fetch_assoc($select_pendings)) {
                    $quantity = $row['Quantity'];
                    $price = $row['Price'];
                    $totalPrice = $quantity * $price;
                    $totalSales += $totalPrice;
                }
               ?>
                <h3>Sales</h3>
                <p1>RM<?php echo $totalSales; ?> </p1>
            </div>
        </div>
        <div class="dashboard-card">
            <div>
                <?php
                  $select_GAppt = mysqli_query($con, "SELECT * FROM `groomingappt` WHERE status != 'Canceled'");
                  $number_of_GAppt = mysqli_num_rows($select_GAppt);                  
                ?>
            <h3>Grooming appointment</h3>
            <p1><?php echo $number_of_GAppt; ?></p1>
            </div>
            <div>
                <?php
                  $select_BAppt = mysqli_query($con, "SELECT * FROM `boardingappt` WHERE status != 'Canceled'");
                  $number_of_BAppt = mysqli_num_rows($select_BAppt);                  
                ?>
            <h3>Boarding appointment</h3>
            <p1><?php echo $number_of_BAppt; ?> </p1>
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