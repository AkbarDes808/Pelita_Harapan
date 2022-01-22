<?php
require 'config/functions.php';

if (isset($_GET['search'])) {
    $books = cari($_GET['q']);
    $jumlah = count($books);
}

?>


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Search</title>
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

<body class="template-collection belle">
    <div class="pageWrapper">
        <!--Top Header-->
        <?php require 'assets/php/top-header.php'; ?>
        <!--End Top Header-->
        <!--Header-->
        <?php require 'assets/php/nav.php'; ?>
        <!--End Header-->

        <!--Body Content-->
        <div id="page-content">
            <!--Collection Banner-->
            <div class="collection-header">
                <div class="collection-hero">
                    <div class="collection-hero__image"><img class="blur-up lazyload" data-src="assets/img/banner/banner-category.png" src="assets/img/banner/banner-category.png" alt="Kategori" /></div>
                    <div class="collection-hero__title-wrapper">
                        <h1 class="collection-hero__title page-width">Jumlah Buku : <?= $jumlah; ?></h1>
                    </div>
                </div>
            </div>
            <!--End Collection Banner-->

            <div class="container-fluid">
                <div class="row">

                    <!--Main Content-->
                    <div class="col-12 col-sm-12 col-md-9 col-lg-10 main-col">
                        <div class="productList">

                            <div class="grid-products grid--view-items">
                                <div class="row">
                                    <?php foreach ($books as $book) : ?>
                                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 grid-view-item style2 item">
                                            <div class="grid-view_image">
                                                <!-- start product image -->
                                                <a href="detail.php?id_buku=<?= $book['id_buku']; ?>" class="grid-view-item__link">
                                                    <!-- image -->
                                                    <img class="grid-view-item__image primary blur-up lazyload" data-src="assets/img/covers/<?= $book['gambar']; ?>" src="assets/img/covers/<?= $book['gambar']; ?>" alt="image" title="product">
                                                    <!-- End image -->
                                                    <!-- Hover image -->
                                                    <img class="grid-view-item__image hover blur-up lazyload" data-src="assets/img/covers/<?= $book['gambar']; ?>" src="assets/img/covers/<?= $book['gambar']; ?>" alt="image" title="product">
                                                    <!-- End hover image -->
                                                </a>
                                                <!-- end product image -->

                                                <!--start product details -->
                                                <div class="product-details hoverDetails text-center mobile">
                                                    <!-- product name -->
                                                    <div class="product-name">
                                                        <a href="detail.php?id_buku=<?= $book['id_buku']; ?>"><?= $book['judul']; ?></a>
                                                    </div>
                                                    <!-- End product name -->
                                                    <!-- product price -->
                                                    <div class="product-price">
                                                        <span class="price">Rp. <?= $book['harga']; ?></span>
                                                    </div>
                                                    <!-- End product price -->
                                                    <!-- product button -->
                                                    <div class="button-set">
                                                        <!-- Start product button -->
                                                        <form action="#" method="post">
                                                            <button class="btn btn--secondary cartIcon btn-addto-cart" type="button"><i class="icon anm anm-bag-l"></i></button>
                                                        </form>
                                                        <div class="wishlist-btn">
                                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist">
                                                                <i class="icon anm anm-heart-l"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- end product button -->
                                                </div>
                                                <!-- End product details -->
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <!--End Main Content-->
                    </div>
                </div>
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
            <script src="assets/js/vendor/jquery.cookie.js"></script>
            <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
            <script src="assets/js/vendor/wow.min.js"></script>
            <!-- Including Javascript -->
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/plugins.js"></script>
            <script src="assets/js/popper.min.js"></script>
            <script src="assets/js/lazysizes.js"></script>
            <script src="assets/js/main.js"></script>
        </div>
    </div>
</body>

</html>