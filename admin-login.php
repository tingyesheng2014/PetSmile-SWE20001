<!DOCTYPE html>
<html lang="en">

<?php
include 'header.php';

$con = mysqli_connect('localhost', 'root', '', 'petsmile');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {
    $Staff_ID = $_POST['username'];
    $Password = $_POST['password'];

    $cmd = "SELECT * FROM staffAcc WHERE Staff_ID = '$Staff_ID' AND Password = '$Password' LIMIT 1";
    $res = mysqli_query($con, $cmd);

    if ($res) {
        if (mysqli_num_rows($res) > 0) {
            session_start();

            $data = mysqli_fetch_assoc($res);

            $_SESSION['Staff_ID'] = $data['Staff_ID'];

            var_dump($_SESSION['Staff_ID']);

            header('location:admin-index.php');
            exit();
        } else {
            echo '<div class="alert alert-danger"><strong>Login failed!</strong> Check username and password</div>';
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="d-flex flex-column text-center mb-5 pt-5">
            <h4 class="text-secondary mb-3">Login</h4>
            <h1 class="display-4 m-0">Admin<span class="text-primary">Login</span></h1>
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
                    if (!isset($_SESSION['Staff_ID'])) {
                        // User is not logged in, display login form
                        echo "<form method='POST' action='admin-login.php'>";
                        echo "    <label for='username'>Staff ID:</label>";
                        echo "    <input type='text' name='username' required><br><br>";
                        echo "    <label for='password'>Password:</label>";
                        echo "    <input type='password' name='password' required><br><br>";
                        echo "    <input type='submit' name='login' value='Login'>";
                        echo "</form>";

                        echo "<a href='login.php'>Back</a>";

                        //echo "<p>Don't have an account? <a href='register.php'>Register</a></p>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <?php
    include 'footer.php';
    ?>

</html>
