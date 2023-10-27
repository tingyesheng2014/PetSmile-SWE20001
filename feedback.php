<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerID = $_SESSION['Cust_ID'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $insertFeedbackQuery = "INSERT INTO feedback (Cust_ID, Feedback_Desc, Feedback_Date) VALUES ('$customerID', '$description', '$date')";

    if (mysqli_query($con, $insertFeedbackQuery)) {
        echo '<div class="alert alert-success"><strong>Feedback submitted successfully!</strong></div>';
    } else {
        echo '<div class="alert alert-danger"><strong>Feedback submission failed!</strong> Please try again later.</div>';
    }
}
?>

    <!-- Feedback Start -->
    <div class="container-fluid pt-5">
        <div class="d-flex flex-column text-center mb-5 pt-5">
            <h4 class="text-secondary mb-3">Feedback</h4>
            <h1 class="display-4 m-0">Feedback For <span class="text-primary">Our Service</span></h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 mb-5">
                <form action="feedback.php" method="POST">
                    <div class="control-group">
                        <input type="date" class="form-control p-4" id="date" name="date" placeholder="Feedback Date" required="required" data-validation-required-message="Please enter date" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <textarea class="form-control p-4" rows="6" id="description" name="description" placeholder="Your Feedback" required="required" data-validation-required-message="Please enter your feedback"></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div>
                        <button class="btn btn-primary py-3 px-5" type="submit" id="sendFeedbackButton">Submit Feedback</button>
                    </div>
                </form>
        </div>
    </div>
    <!-- Feedback End -->

    <?php
    include 'footer.php';
    ?>

</html>
