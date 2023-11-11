<!DOCTYPE html>
<html lang="en">

<?php
include 'admin-header.php';

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

            header('location:admin-bookinghistory.php');
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
            <div class="col-6 mb-5 mx-auto text-center">
                <div class="contact-form">
                    <div id="success"></div>
                    <?php
                    if (!isset($_SESSION['Staff_ID'])) { ?>
                        <form method='POST' action='login.php'>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example1">Username</label>
                                <input type="text" id="form2Example1" class="form-control" name="username"/>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example2">Password</label>
                                <input type="password" id="form2Example2" class="form-control" name="password" />
                            </div>
                            <input class="btn btn-primary" type='submit' name='login' value='Login'>
                        </form>

                        <a href='login.php'>Back</a>
                    <?php }?>

                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <?php
    include 'footer.php';
    ?>

</html>
