<?php
    session_start();
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
    <link rel="stylesheet" href="../sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./style/dashboard.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./style/exam_registration.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./style/registration_card.css?v=<?php echo time(); ?>">

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
            <div class="container-fluid">
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
                    <div class="d-flex justify-content-center align-item-center gap-2 user-profile dropdown">
                        <img src="../public/assets/Subhasis_Sahoo-Photo.jpg" alt="user_image" height="36px" class="user_image">
                        <div class="my-auto fs-6 text-white user_name">Subhasis Sahoo</div>
                        <div class="my-auto fs-6 text-white user_roll">(Student)</div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <?php
    include_once "sidebar.php";
    // include_once "dashboard.php";
    ?>
    <script src="../sidebar.js?v=<?php echo time(); ?>"></script>
</body>

</html>