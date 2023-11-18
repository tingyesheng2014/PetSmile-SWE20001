<head>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
        <div class="row py-3 px-lg-5">
            <div class="col-lg-4">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-capitalize"><span class="text-primary">Pet</span>Smile</h1>
                </a>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="d-inline-flex flex-column text-center pr-3 border-right">
                        <h6>Opening Hours</h6>
                        <p class="m-0">10.00AM - 6.00PM</p>
                    </div>
                    <div class="d-inline-flex flex-column text-center px-3 border-right">
                        <h6>Email Us</h6>
                        <p class="m-0">petsmileofficial@gmail.com</p>
                    </div>
                    <div class="d-inline-flex flex-column text-center pl-3">
                        <h6>Call Us</h6>
                        <p class="m-0">+012 345 6789</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span class="text-primary">Safety</span>First</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="admin-home.php" class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin-home.php') ? 'active' : ''; ?>">Home</a>
                    <a href="admin-bookinghistory.php" class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin-bookinghistory.php') ? 'active' : ''; ?>">Booking</a>
                    <a href="supplies.php" class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'supplies.php') ? 'active' : ''; ?>">Supplies</a>
                    <a href="sales.php" class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'supplies.php') ? 'active' : ''; ?>">Sales</a>
                </div>
                <?php
                if (isset($_SESSION['Staff_ID'])) {
                    echo '<a href="admin-editprofile.php" class="btn btn-lg btn-primary px-3 d-none d-lg-block">Hi, ' . $_SESSION['Staff_ID'] . '</a>';
                } else {
                  echo'<a href="admin-login.php" class="btn btn-lg btn-primary px-3 d-none d-lg-block">Admin Login</a>';
                }
                ?>

            </div>
        </nav>
    </div>
    <!-- Navbar End -->
