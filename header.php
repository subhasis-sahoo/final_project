<?php
session_start();
$_SESSION['sic'] = "25MMCI24";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiliconTech Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../loader.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./style/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./style/common.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./style/dashboard.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./style/registration_card.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./style/application_history.css?v=<?php echo time(); ?>">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
    </style>

    <!-- Script for download exam registration form as pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

</head>

<body>
    <!-- Header Section -->
    <header>
        <!-- Top Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid position-relative">
                <!-- University Logo and Name -->
                <div class="d-flex align-items-center">
                    <a class="navbar-brand" href="https://silicon.ac.in" target="_blank">
                        <img src="../public/assets/silicon_logo.png" alt="Silicon University Logo" class="university-logo">
                    </a>
                </div>

                <!-- Unit/Department Banner -->
                <div class="unit-banner">
                    <h1>SiliconTech is a Unit of Silicon University</h1>
                </div>

                <!-- Loading indicator (initially hidden) -->
                <div id="mainLoadingIndicator" class="position-absolute start-50 top-100 d-flex gap-3 my-4 d-none">
                    <div class="loader"></div>
                    <p class="text-dark fw-medium" style="letter-spacing: .05cm;">Loading...</p>
                </div>

                <!-- User Information and Actions -->
                <div class="user-actions d-flex align-items-center">
                    <!-- Notification Icon -->
                    <div class="notification-icon me-3">
                        <a href="notifications.php" class="position-relative">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">2</span>
                        </a>
                    </div>

                    <!-- Grievance Link -->
                    <div class="grievance-link me-3">
                        <a href="grievance.php" class="text-light">
                            <i class="fas fa-comment-alt"></i> Grievance
                        </a>
                    </div>

                    <!-- User Profile -->
                    <div class="user-profile dropdown">
                        <a class="dropdown-toggle text-light text-decoration-none d-flex align-items-center gap-2" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../public/assets/Subhasis_Sahoo-Photo.jpg" alt="user_image" height="36px" class="user_image">
                            <div class="my-auto fs-6 text-white user_name">Subhasis Sahoo</div>
                            <div class="my-auto fs-6 text-white user_roll">(Student)</div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item d-flex justify-content-center align-items-center gap-3 p-1" href="">
                                    <img src="../public/assets/Subhasis_Sahoo-Photo.jpg" alt="" width="50">
                                    <div>
                                        <div>Subhasis Sahoo (Student)</div>
                                        <div>23MMCI50</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item p-1" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <?php
    // include_once "sidebar.php";
    // include_once "dashboard.php";
    ?>
    <!-- <script src="../sidebar.js?v=<?php // echo time(); ?>"></script> -->

    // Bootstrap CDN for JavaScript
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>