<?php
$con = mysqli_connect('localhost', 'root', '', 'petsmile');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$selectedServiceType = $_POST['serviceType'];

$selectServiceNamesQuery = "SELECT Service_Name FROM service WHERE Service_Type = '$selectedServiceType'";
$serviceNamesResult = mysqli_query($con, $selectServiceNamesQuery);

$serviceNames = array();

if ($serviceNamesResult) {
    while ($row = mysqli_fetch_assoc($serviceNamesResult)) {
        $serviceNames[] = $row['Service_Name'];
    }
}

echo json_encode($serviceNames);

mysqli_close($con);
?>
