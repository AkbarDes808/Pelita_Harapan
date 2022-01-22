<?php
session_start();

if (isset($_COOKIE['username']) && isset($_COOKIE['role'])) {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['role'] = $_COOKIE['role'];
}

require 'config/functions.php';

$categories = query("SELECT * FROM kategori");

$books = query("SELECT * FROM buku WHERE tanggalMasuk IN (SELECT MAX(tanggalMasuk) FROM buku) ORDER BY id_buku ASC, tanggalMasuk DESC;");

$book_history = query("SELECT * FROM buku WHERE kategori = 'History' ORDER BY id_buku DESC LIMIT 5");
$book_comic = query("SELECT * FROM buku WHERE kategori = 'Comic' ORDER BY id_buku DESC LIMIT 5");
$book_computers = query("SELECT * FROM buku WHERE kategori = 'Computers' ORDER BY id_buku DESC LIMIT 5");
$book_psychology = query("SELECT * FROM buku WHERE kategori = 'Psychology' ORDER BY id_buku DESC LIMIT 5");
$book_science = query("SELECT * FROM buku WHERE kategori = 'Science' ORDER BY id_buku DESC LIMIT 5");

// var_dump($_COOKIE);
// exit;

?>


<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Toko Buku Pelita Harapan</title>
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/logo-header.png" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    <!-- Bootstap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body class="template-index belle template-index-belle">

    <div class="pageWrapper">

        <div id="pre-loader">
            <img src="assets/images/loader.gif" alt="Loading..." />
        </div>

        <!-- Top Header -->
        <?php require 'assets/php/top-header.php'; ?>

        <!--Header-->
        <?php require 'assets/php/nav-index.php'; ?>
        <!--End Header-->

        <!--Body Content-->
        <div id="page-content">
            <!--Home slider-->
            <div class="slideshow slideshow-wrapper pb-section sliderFull">
                <div class="home-slideshow">
                    <div class="slide">
                        <div class="blur-up lazyload bg-size">
                            <img class="blur-up lazyload bg-img" data-src="assets/img/banner/banner-1.png" src="assets/img/banner/banner-1.png" alt="Shop Our New Collection" title="Shop Our New Collection" />
                            <div class="slideshow__text-wrap slideshow__overlay classic bottom">
                                <div class="slideshow__text-content bottom">
                                    <div class="wrap-caption center">
                                        <h2 class="h1 mega-title slideshow__title">Shop Our New Catalog Book</h2>
                                        <span class="mega-subtitle slideshow__subtitle">From High to low, classic or modern. We have you covered</span>
                                        <span class="btn">Shop now</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="blur-up lazyload bg-size">
                            <img class="blur-up lazyload bg-img" data-src="assets/img/banner/banner-2.jpg" src="assets/img/banner/banner-2.jpg" alt="Summer Bikini Collection" title="Summer Bikini Collection" />
                            <div class="slideshow__text-wrap slideshow__overlay classic bottom">
                                <div class="slideshow__text-content bottom">
                                    <div class="wrap-caption center">
                                        <h2 class="h1 mega-title slideshow__title">History Book Collection</h2>
                                        <span class="mega-subtitle slideshow__subtitle">Save up to 50% off this weekend only</span>
                                        <span class="btn">Shop now</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Home slider-->
            <!--Collection Tab slider-->
            <div class="product-rows section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="section-header text-center">
                                <h2 class="h2">New Arrivals</h2>
                                <p>Browse the variety of our book categories</p>
                            </div>
                        </div>
                    </div>
                    <div class="grid-products">
                        <div class="row">
                            <?php foreach ($books as $book) : ?>
                                <div class="col-6 col-sm-2 col-md-3 col-lg-3 item">
                                    <div class="product-image">
                                        <!-- start product image -->
                                        <a href="detail.php?id_buku=<?= $book['id_buku']; ?>">
                                            <!-- image -->
                                            <img class="primary blur-up lazyload" data-src="assets/img/covers/<?= $book['gambar']; ?>" src="assets/img/covers/<?= $book['gambar']; ?>" alt="image" title="product">
                                            <!-- End image -->
                                            <!-- Hover image -->
                                            <img class="hover blur-up lazyload" data-src="assets/img/covers/<?= $book['gambar']; ?>" src="assets/img/covers/<?= $book['gambar']; ?>" alt="image" title="product">
                                            <!-- End hover image -->
                                        </a>
                                        <!-- end product image -->

                                        <!-- Start product button -->
                                        <form class="variants add" action="#" onclick="window.location.href='cart.html'" method="post">
                                            <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                                        </form>
                                        <div class="button-set">
                                            <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                <i class="icon anm anm-search-plus-r"></i>
                                            </a>
                                            <div class="wishlist-btn">
                                                <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                    <i class="icon anm anm-heart-l"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- end product button -->
                                    </div>
                                    <!-- end product image -->

                                    <!--start product details -->
                                    <div class="product-details text-center">
                                        <!-- product name -->
                                        <div class="product-name">
                                            <a href="detail.php?id_buku=<?= $book['id_buku']; ?>"><?= $book['judul']; ?></a>
                                        </div>
                                        <!-- End product name -->
                                        <!-- product price -->
                                        <div class="product-price">
                                            <span class="price">Rp.<?= $book['harga']; ?></span>
                                        </div>
                                        <!-- End product price -->
                                    </div>
                                    <!-- End product details -->
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--Collection Tab slider-->

            <!--Collection Box slider-->
            <div class="collection-box section">
                <div class="container-fluid">
                    <div class="collection-grid">
                        <?php foreach ($categories as $category) : ?>
                            <div class="collection-grid-item">
                                <a href="kategori.php?kategori=<?= $category['kategori']; ?>" class="collection-grid-item__link">
                                    <img data-src="assets/img/collection/<?= $category['gambar']; ?>" src="assets/img/collection/<?= $category['gambar']; ?>" alt="History" class="blur-up lazyload" />
                                    <div class="collection-grid-item__title-wrapper">
                                        <h3 class="collection-grid-item__title btn btn--secondary no-border"><?= $category['kategori']; ?></h3>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                        <div class="collection-grid-item">
                            <a href="kategori.php?kategori=history" class="collection-grid-item__link">
                                <img data-src="assets/img/collection/History.jpg" src="assets/img/collection/History.jpg" alt="History" class="blur-up lazyload" />
                                <div class="collection-grid-item__title-wrapper">
                                    <h3 class="collection-grid-item__title btn btn--secondary no-border">History</h3>
                                </div>
                            </a>
                        </div>
                        <div class="collection-grid-item">
                            <a href="kategori.php?kategori=comic" class="collection-grid-item__link">
                                <img class="blur-up lazyload" data-src="assets/img/collection/Comic.jpg" src="assets/img/collection/Comic.jpg" alt="Comic" />
                                <div class="collection-grid-item__title-wrapper">
                                    <h3 class="collection-grid-item__title btn btn--secondary no-border">Comic</h3>
                                </div>
                            </a>
                        </div>
                        <div class="collection-grid-item blur-up lazyloaded">
                            <a href="kategori.php?kategori=computers" class="collection-grid-item__link">
                                <img data-src="assets/img/collection/Computers.jpg" src="assets/img/collection/Computers.jpg" alt="Computers" class="blur-up lazyload" />
                                <div class="collection-grid-item__title-wrapper">
                                    <h3 class="collection-grid-item__title btn btn--secondary no-border">Computers</h3>
                                </div>
                            </a>
                        </div>
                        <div class="collection-grid-item">
                            <a href="kategori.php?kategori=psychology" class="collection-grid-item__link">
                                <img data-src="assets/img/collection/Psychology.jpg" src="assets/img/collection/Psychology.jpg" alt="Psychology" class="blur-up lazyload" />
                                <div class="collection-grid-item__title-wrapper">
                                    <h3 class="collection-grid-item__title btn btn--secondary no-border">Psychology</h3>
                                </div>
                            </a>
                        </div>
                        <div class="collection-grid-item">
                            <a href="kategori.php?kategori=science" class="collection-grid-item__link">
                                <img data-src="assets/img/collection/Science.jpg" src="assets/img/collection/Science.jpg" alt="Science" class="blur-up lazyload" />
                                <div class="collection-grid-item__title-wrapper">
                                    <h3 class="collection-grid-item__title btn btn--secondary no-border">Science</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Collection Box slider-->


            <!--Store Feature-->
            <div class="store-feature section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <ul class="display-table store-info">
                                <li class="display-table-cell">
                                    <i class="icon anm anm-truck-l"></i>
                                    <h5>Free Shipping &amp; Return</h5>
                                    <span class="sub-text">Free shipping on all US orders</span>
                                </li>
                                <li class="display-table-cell">
                                    <i class="icon anm anm-dollar-sign-r"></i>
                                    <h5>Money Guarantee</h5>
                                    <span class="sub-text">30 days money back guarantee</span>
                                </li>
                                <li class="display-table-cell">
                                    <i class="icon anm anm-comments-l"></i>
                                    <h5>Online Support</h5>
                                    <span class="sub-text">We support online 24/7 on day</span>
                                </li>
                                <li class="display-table-cell">
                                    <i class="icon anm anm-credit-card-front-r"></i>
                                    <h5>Secure Payments</h5>
                                    <span class="sub-text">All payment are Secured and trusted.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Store Feature-->
        </div>
        <!--End Body Content-->

        <!--Footer-->
        <?php require 'assets/php/footer.php'; ?>
        <!--End Footer-->
        <!--Scoll Top-->
        <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
        <!--End Scoll Top-->

        <!-- Including Jquery -->
        <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
        <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
        <script src="assets/js/vendor/jquery.cookie.js"></script>
        <script src="assets/js/vendor/wow.min.js"></script>
        <!-- Including Javascript -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/lazysizes.js"></script>
        <script src="assets/js/main.js"></script>
    </div>
</body>

</html>