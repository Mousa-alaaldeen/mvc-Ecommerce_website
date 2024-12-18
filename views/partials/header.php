<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../public/images/Logo (2).png">
    <meta name="keywords" content="bootstrap, bootstrap4"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link href="../public/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="../public/css/tiny-slider.css" rel="stylesheet">
    <link href="../public/css/style.css" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <title> Nest & Buy </title>
</head>

<body>

<!-- Start Header/Navigation -->
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href=' '>
            <img class="logo-img" src="../public/images/Logo.png" style="max-width:150px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item active">
                    <a class="nav-link" href='/customers/index'>Home</a>
                </li>
                <li><a class="nav-link" href="/customers/shop">Shop</a></li>
                <li><a class="nav-link" href="/customers/about">About us</a></li>
                <li><a class="nav-link" href="/customers/contact">Contact us</a></li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
<!--                --><?php //session_start(); ?>
                <nav>
                    <ul class="navbar-nav">
                        <?php if (isset($_SESSION['user'])): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo $_SESSION['user']['image_url'] ?: 'https://cdn.icon-icons.com/icons2/2030/PNG/512/user_icon_124042.png'; ?>"
                                         alt="User Image" style="width: 30px; height: 30px; border-radius: 50%;">
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    <li>
                                        <a class="dropdown-item" href="/customers/profile">Profile</a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="/customers/logout"
                                           onclick="confirmLogout()">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li>
                                <a class="nav-link" href="/customers/login_and_register" style="margin-right: -15px;">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a class="nav-link" href="/customers/cart">
                                <img src="../public/images/cart.svg">
                                <span class="cart-count">
                            <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                        </span>
                            </a>
                        </li>
                        <li><a class="nav-link" href="#">
                                <i class="fa-solid fa-heart"></i>
                                <span class="wishlist-count"><?php echo isset($_SESSION['wishlists']) ? count($_SESSION['wishlists']) : 0; ?></span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </ul>
        </div>
    </div>

</nav>
<!-- End Header/Navigation -->