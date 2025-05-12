<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .btn-login {
            background: #DE6262;
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            transition: background 0.3s ease;
        }
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background-color: #f0f8ff;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.5);
            height: 68px;
        }

        .navbar-brand img {
            width: 100px;
        }

        .navbar-text {
            color: white;
            font-weight: bold;
            font-size: 20px;
            font-family: sans-serif;
        }

        .login-block {
            background: linear-gradient(to bottom, #74ebd5, #ACB6E5);
            padding: 100px 0;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .login-sec,
        .carousel-container {
            width: 500px;
            height: 450px;
            border-radius: 12px;
            box-shadow: 0 0px 20px rgba(0, 0, 0, 0.1);
            background: white;
        }

        .login-sec {
            padding: 30px 25px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form {
            width: 100%;
        }

        .carousel-container {
            overflow: hidden;
        }

        .carousel-inner,
        .carousel-item {
            height: 100%;
        }

        .carousel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="login_page.php">
                <!-- <img src="https://github.com/subhasis-sahoo/final_project/blob/main/public/assets/silicon_logo.png?raw=true"
                    alt="Silicon University Logo"> -->
            </a>
            <div class="ms-auto navbar-text">
                SiliconTech is a Unit of Silicon University
            </div>
        </div>
    </nav>

    <!-- Login Section -->
    <section class="login-block">
        <div class="container">
        <div class="login-container">
    <!-- Login Form -->
    <div class="login-sec">
        <h2 class="text-center mb-4">Login</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
        <form class="login-form" id="loginform" name="loginform" method="post" action="login.php">
            <div class="mb-3">
                <label for="username" class="form-label text-uppercase">User Name</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label text-uppercase">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="cmbInstitute" class="form-label text-uppercase">Institute</label>
                <select class="form-select" id="cmbInstitute" name="cmbInstitute" required>
                    <option value="">--Select Institute--</option>
                    <option value="SITWEST">Silicon Institute of Technology Sambalpur</option>
                    <option value="SITBBS" selected>SiliconTech is a Unit of Silicon University</option>
                    <option value="SITTRST">Silicon Institute Trust</option>
                </select>
            </div>
            <div class="forgot-password text-end">
                <a href="#">Forgot Password?</a>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-login">Sign in</button>
            </div>
        </form>
    </div>

    <!-- Image Slider -->
    <div class="carousel-container">
        <div id="loginCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="" alt="Campus">
                </div>
                <div class="carousel-item">
                    <img src="" alt="Students">
                </div>
                <div class="carousel-item">
                    <img src="" alt="Library">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#loginCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#loginCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</div>

        </div>
    </section>

    <!-- Bootstrap 5 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>