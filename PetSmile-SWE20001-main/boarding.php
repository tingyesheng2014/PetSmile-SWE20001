<?php
include 'config.php';
$selectServicesQuery = "SELECT * FROM service WHERE Service_Type = 'Pet Boarding'";
$servicesResult = mysqli_query($con, $selectServicesQuery);
?>

<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'header.php';
?>

    <div class="container-fluid bg-light pt-5 pb-4">
        <div class="container py-5">
            <div class="d-flex flex-column text-center mb-5">
                <h4 class="text-secondary mb-3">Choose the Services</h4>
                <h1 class="display-4 m-0">Pet <span class="text-primary">Boarding</span></h1>
            </div>
            <div class="row">
                <?php
                while ($row = mysqli_fetch_assoc($servicesResult)) {
                    $serviceID = $row['Service_ID'];
                    $serviceName = $row['Service_Name'];
                    $serviceDesc = $row['Service_Desc'];
                    $price = $row['Price'];
                    $imageFileName = $row['Img'];

                    $imageName = str_replace(' ', '_', $serviceName) . '.jpg';

                    echo '<div class="col-lg-4 mb-4">';
                    echo '<div class="card border-0">';
                    echo '<div class="card-header position-relative border-0 p-0 mb-4">';
                    echo "<img class='card-img-top' src='img/$imageFileName' alt='$serviceName'>";
                    echo '<div class="position-absolute d-flex flex-column align-items-center justify-content-center w-100 h-100" style="top: 0; left: 0; z-index: 1; background: rgba(0, 0, 0, .5);">';
                    echo "<h3 class='text-primary mb-3'>$serviceName</h3>";
                    echo "<h1 class='display-4 text-white mb-0'><small class='align-top' style='font-size: 22px; line-height: 45px;'>$</small>$price<small class='align-bottom' style='font-size: 16px; line-height: 40px;'>/ day</small></h1>";
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="card-footer border-0 p-0">';
                    echo "<a href='booking.php?serviceID=$serviceID' class='btn btn-primary btn-block p-3' style='border-radius: 0;'>Book Now</a>";
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    include 'footer.php';
    ?>

</html>
