<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<?php
include 'config.php';
include 'admin-header.php';

if (!isset($_SESSION['Staff_ID'])) {
    header("Location: admin-login.php");
    exit;
}
    // Check if form is submitted
    if (isset($_POST['update'])) {
        // Assuming you have established a database connection ($con)

        // Check if 'quantity' index is set in $_POST
        if (isset($_POST['quantity']) && is_array($_POST['quantity'])) {
            // Iterate over the submitted quantities and update the database
            foreach ($_POST['quantity'] as $suppliesId => $newQuantity) {
                // Validate and sanitize input if necessary

                // Update the database
                $updateQuantityQuery = "UPDATE inventory SET Quantity='$newQuantity' WHERE Supplies_ID='$suppliesId'";

                if (!mysqli_query($con, $updateQuantityQuery)) {
                    echo '<div class="alert alert-danger"><strong>Quantity update failed!</strong> Please try again later.</div>';
                    // Handle the error as needed
                }
            }

            echo '<div class="alert alert-success"><strong>Quantities updated successfully!</strong></div>';
        } else {
            // Handle the case when 'quantity' index is not set
            echo '<div class="alert alert-warning"><strong>No quantities submitted for update.</strong></div>';
        }
    }

    $select_inventory = mysqli_query($con, "SELECT * FROM `inventory`");
?>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span class="text-primary">Safety</span>First</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <!-- Add your navigation links here -->
            </div>
        </nav>
    </div>
    <!-- Navbar End -->




    <div class="container">
        <form method="POST" action="supplies.php">
            <h1 class="display-4 m-0">Supplies <span class="text-primary">Inventory</span></h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Supplies ID</th>
                        <th>Supplies Name</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($select_inventory)) {
                        echo "<tr>";
                        echo "<td>{$row['Supplies_ID']}</td>";
                        echo "<td>{$row['Supplies_Name']}</td>";
                        echo "<td>{$row['Price']}</td>";
                        echo "<td>{$row['Date']}</td>";
                        echo "<td class='quantity-cell'>
                                <span id='quantity_{$row['Supplies_ID']}'>{$row['Quantity']}</span>
                                <input type='hidden' name='quantity[{$row['Supplies_ID']}]' value='{$row['Quantity']}' id='hidden_quantity_{$row['Supplies_ID']}'>
                              </td>";
                        ?>
                        <td>
                            <div class="input-group plus-minus-input">
                                <div class="input-group-button">
                                    <button type="button" class="btn btn-primary" onclick="adjustQuantity(<?php echo $row['Supplies_ID']; ?>, 'minus')">
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary" onclick="adjustQuantity(<?php echo $row['Supplies_ID']; ?>, 'plus')">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td>
                        <input type="submit" name="update" value="Update" class="btn btn-primary">
                        </form>
                        </td>
                        <?php
                        echo "</tr>";
                    }
                    ?>
                    <td>
                    </td>
                </tbody>
            </table>
    </div>

    <script>
        function adjustQuantity(suppliesId, operation) {
            var quantityElement = document.getElementById('quantity_' + suppliesId);
            var hiddenInput = document.getElementById('hidden_quantity_' + suppliesId);

            var currentQuantity = parseInt(quantityElement.textContent);
            var newQuantity;

            if (operation === 'plus') {
                newQuantity = currentQuantity + 1;
            } else if (operation === 'minus' && currentQuantity > 0) {
                newQuantity = currentQuantity - 1;
            } else {
                return; // Do nothing for unknown operations or when trying to decrease below 0
            }

            quantityElement.textContent = newQuantity;
            hiddenInput.value = newQuantity; // Update the hidden input field value
        }
    </script>
    
</body>
<?php
include 'footer.php';
?>
</html>