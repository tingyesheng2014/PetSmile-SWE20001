<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'header.php';

if (isset($_POST['register'])) {
    $Cust_ID = $_POST['username'];
    $Password = $_POST['password'];
    $First_Name = $_POST['firstname'];
    $Last_Name = $_POST['lastname'];
    $Phone_No = $_POST['phoneno'];
    $Address = $_POST['address'];
    $City = $_POST['city'];
    $Postcode = $_POST['postcode'];
    $Email = $_POST['email'];

    $insertMemberQuery = "INSERT INTO member (Cust_ID, First_Name, Last_Name, Phone_No, Address, City, Postcode, Email)
    VALUES ('$Cust_ID', '$First_Name', '$Last_Name', '$Phone_No', '$Address', '$City', '$Postcode', '$Email')";

        if (mysqli_query($con, $insertMemberQuery)) {
            $insertMemberAccQuery = "INSERT INTO memberAcc (Cust_ID, Password) VALUES ('$Cust_ID', '$Password')";

            if (mysqli_query($con, $insertMemberAccQuery)) {
                echo '<div class="alert alert-success"><strong>Registration successful!</strong> You can now log in with your username and password.</div>';
            } else {
                echo '<div class="alert alert-danger"><strong>Registration failed!</strong> Please try again later.</div>';
            }
        } else {
            echo '<div class="alert alert-danger"><strong>Registration failed!</strong> Please try again later.</div>';
        }
    }
?>

    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="d-flex flex-column text-center mb-5 pt-5">
            <h4 class="text-secondary mb-3">Register</h4>
            <h1 class="display-4 m-0">Re<span class="text-primary">gister</span></h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <?php
                    /*
                    <form method='POST' action='login.php'>
                        <div class="control-group">
                            <input type="text" class="form-control p-4" id="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control p-4" id="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control p-4" id="subject" placeholder="Subject" required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control p-4" rows="6" id="message" placeholder="Message" required="required" data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit" id="loginButton">Login</button>
                            <button class="btn btn-primary" type="submit" id="signupButton">Signup</button>
                        </div>
                    </form>
                    */
                    ?>
                    <section class="container py-5">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <form method="POST" action="member-register.php">
                                    <label for="username">Customer ID:</label>
                                    <input type="text" name="username" required><br><br>
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" required><br><br>
                                    <label for="firstname">First Name:</label>
                                    <input type="text" name="firstname" required><br><br>
                                    <label for="lastname">Last Name:</label>
                                    <input type="text" name="lastname" required><br><br>
                                    <label for="phoneno">Phone No:</label>
                                    <input type="text" name="phoneno" required><br><br>
                                    <label for="address">Address:</label>
                                    <input type="text" name="address" required><br><br>
                                    <label for="city">City:</label>
                                    <input type="text" name="city" required><br><br>
                                    <label for="postcode">Postcode:</label>
                                    <input type="text" name="postcode" required><br><br>
                                    <label for="email">Email:</label>
                                    <input type="text" name="email" required><br><br>

                                    <a href="login.php" class="btn btn-secondary">Back to Login Page</a>

                                    <input type='submit' name='register' value='Register' class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <?php
    include 'footer.php';
    ?>

</html>
