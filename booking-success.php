<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'header.php';
?>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center mt-5">
                <h1 class="display-4">Booking Successful!</h1>
                <p>Your booking has been confirmed. Thank you for choosing our service.</p>
                <?php
                /*
                <p>Here are the details of your booking:</p>
                <p>Pet Name: <?php echo $petName; ?></p>
                <p>Date: <?php echo $bookingDate; ?></p>
                <p>Time: <?php echo $bookingTime; ?></p>
                <p>Service: <?php echo $serviceName; ?></p>
                */
                ?>
                <a href="bookinghistory.php" class="btn btn-primary">Back to Booking History</a>
            </div>
        </div>
    </div>

    <?php
    include 'footer.php';
    ?>

</html>
