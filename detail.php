<?php
session_start();

require 'config/functions.php';
require 'config/conn.php';

if (!isset($_GET["id_buku"])) {
    header("location:index.php");
}

// ambil data di URL
$id_buku = $_GET["id_buku"];

// query data buku berdasarkan id buku
$buku = query("SELECT * FROM buku WHERE id_buku = $id_buku")[0];

if (isset($_POST['preview'])) {
    $preview = $buku['preview'];
    $pathPreview = "assets/books/$preview";

    // Header content type
    header("Content-type: application/pdf");
    header("Content-Length: " . filesize($pathPreview));

    // Send the file to the browser.
    readfile($pathPreview);
}

if (isset($_POST['add'])) {
    if (!isset($_SESSION['login'])) {
        header("location:login.php");
    } else {
        $username = $_SESSION['username'];
        $quantity = $_POST['quantity'];
        $result = mysqli_query($conn, "SELECT * FROM cart WHERE username='$username' AND status='Cart'");
        $jumlah = mysqli_num_rows($result);
        $rows = mysqli_fetch_array($result);
        $id_order = $rows['id_order'];

        if ($jumlah > 0) {

            // cek buku serupa
            $cek_buku_sama = mysqli_query($conn, "SELECT * FROM detail_order WHERE id_buku='$id_buku' AND id_order='$id_order'");
            $jumlah_buku_sama = mysqli_num_rows($cek_buku_sama);
            $buku_sama = mysqli_fetch_array($cek_buku_sama);

            // jika sudah ada di cart
            if ($jumlah_buku_sama > 0) {
                $quantity_sama = $buku_sama['quantity'];
                $quantity_baru = $quantity_sama + $quantity;

                $update_cart = mysqli_query($conn, "UPDATE detail_order SET quantity=$quantity_baru WHERE id_order='$id_order'");

                if ($update_cart) {
                    echo "
                        <div class='alert alert-success'>
                            Buku sudah pernah dimasukkan ke keranjang, jumlah akan ditambahkan
                        </div>
                        <meta http-equiv='refresh' content='1; url= detail.php?id_buku=" . $id_buku . "'/>
                    ";
                } else {
                    echo "
                        <div class='alert alert-warning'>
                            Gagal menambahkan ke keranjang
                        </div>
                        <meta http-equiv='refresh' content='1; url= detail.php?id_buku=" . $id_buku . "'/>
                    ";
                }
            } else {
                $buku_baru = mysqli_query($conn, "INSERT INTO detail_order (id_order, id_buku, quantity) VALUES ('$id_order', '$id_buku', $quantity)");

                if ($buku_baru) {
                    echo "
                        <div class='alert alert-success'>
                            Berhasil menambahkan ke keranjang
                        </div>
                        <meta http-equiv='refresh' content='1; url= detail.php?id_buku=" . $id_buku . "'/>
                    ";
                } else {
                    echo "
                        <div class='alert alert-warning'>
                            Gagal menambahkan ke keranjang
                        </div>
                        <meta http-equiv='refresh' content='1; url= detail.php?id_buku=" . $id_buku . "'/>
                    ";
                }
            }
        } else {
            $id_order_baru = crypt(rand(22, 999), time());

            $cart_baru = mysqli_query($conn, "INSERT INTO cart (id_order, username) VALUES ('$id_order_baru', '$username')");

            if ($cart_baru) {
                $order_baru = mysqli_query($conn, "INSERT INTO detail_order (id_order, id_buku, quantity) VALUES ('$id_order_baru', '$id_buku', $quantity)");
                if ($order_baru) {
                    echo "
                        <div class='alert alert-success'>
                            Berhasil menambahkan keranjang
                        </div>
                        <meta http-equiv='refresh' content='1; url= detail.php?id_buku=" . $id_buku . "'/>
                    ";
                } else {
                    echo "
                        <div class='alert alert-warning'>
                            Gagal menambahkan keranjang
                        </div>
                        <meta http-equiv='refresh' content='1; url= detail.php?id_buku=" . $id_buku . "'/>
                    ";
                }
            } else {
                echo "Gagal membuat cart";
            }
        }
    }
}

?>


<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Detail Produk</title>
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

<body class="template-product belle">
    <div class="pageWrapper">

        <!--Top Header-->
        <?php require 'assets/php/top-header.php'; ?>
        <!--End Top Header-->
        <!--Header-->
        <?php require 'assets/php/nav.php'; ?>
        <!--End Header-->

        <!--Body Content-->
        <div id="page-content">
            <!--MainContent-->
            <div id="MainContent" class="main-content" role="main">
                <!--Breadcrumb-->
                <div class="bredcrumbWrap">
                    <div class="container breadcrumbs">
                        <a href="index.php" title="Back to the home page">Home</a><span aria-hidden="true">›</span><span><?= $buku["judul"]; ?></span>
                    </div>
                </div>
                <!--End Breadcrumb-->

                <div id="ProductSection-product-template" class="product-template__container prstyle1 container">
                    <!--product-single-->
                    <div class="product-single">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="product-details-img">
                                    <div class="product-thumb">
                                        <div id="gallery" class="product-dec-slider-2 product-tab-left">
                                            <a data-image="assets/img/covers/<?= $buku["gambar"]; ?>" data-zoom-image="assets/img/covers/<?= $buku["gambar"]; ?>" class="slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" tabindex="-1">
                                                <img class="blur-up lazyload" src="assets/img/covers/<?= $buku["gambar"]; ?>" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="zoompro-wrap product-zoom-right pl-20">
                                        <div class="zoompro-span">
                                            <img class="zoompro blur-up lazyload" data-zoom-image="assets/img/covers/<?= $buku["gambar"]; ?>" alt="" src="assets/img/covers/<?= $buku["gambar"]; ?>" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="product-single__meta">
                                    <h1 class="product-single__title"><?= $buku["judul"]; ?></h1>
                                    <p class="product-single__price product-single__price-product-template">
                                        <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                            <span id="ProductPrice-product-template"><span class="money">Rp.<?= $buku["harga"]; ?></span></span>
                                        </span>
                                    </p>
                                </div>
                                <div class="product-single__description rte">
                                    <label class="header">Penulis : <span class="slVariant"><?= $buku["penulis"]; ?></span></label>
                                    <br>
                                    <label class="header">Penerbit : <span class="slVariant"><?= $buku["penerbit"]; ?></span></label>
                                    <br>
                                    <label class="header">Tahun Terbit : <span class="slVariant"><?= $buku["tahun_terbit"]; ?></span></label>
                                    <br>
                                    <label class="header">Kategori : <span class="slVariant"><?= $buku["kategori"]; ?></span></label>
                                </div>

                                <form method="post" action="" class="product-form product-form-product-template hidedropdown" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $buku['id_buku']; ?>">
                                    <button class="btn-primary" name="preview">Preview</button>
                                    <!-- <p class="infolinks"><a href="#sizechart" class="btn" name="preview">Preview</a></p> -->
                                    <!-- Product Action -->
                                    <div class="product-action clearfix">
                                        <div class="product-form__item--quantity">
                                            <div class="wrapQtyBtn">
                                                <div class="qtyField">
                                                    <a class="qtyBtn minus" href="javascript:void(0);"><i class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                                    <input type="text" id="Quantity" name="quantity" value="1" class="product-form__input qty">
                                                    <a class="qtyBtn plus" href="javascript:void(0);"><i class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-form__item--submit">
                                            <button type="submit" name="add" class="btn product-form__cart-submit">
                                                <span>Add to cart</span>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- End Product Action -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End-product-single-->
                    <!--Product Fearure-->
                    <div class="prFeatures">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 feature">
                                <img src="assets/images/credit-card.png" alt="Safe Payment" title="Safe Payment" />
                                <div class="details">
                                    <h3>Safe Payment</h3>Pay with the world's most payment methods.
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 feature">
                                <img src="assets/images/shield.png" alt="Confidence" title="Confidence" />
                                <div class="details">
                                    <h3>Confidence</h3>Protection covers your purchase and personal data.
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 feature">
                                <img src="assets/images/worldwide.png" alt="Worldwide Delivery" title="Worldwide Delivery" />
                                <div class="details">
                                    <h3>Worldwide Delivery</h3>FREE &amp; fast shipping to over 200+ countries &amp; regions.
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 feature">
                                <img src="assets/images/phone-call.png" alt="Hotline" title="Hotline" />
                                <div class="details">
                                    <h3>Hotline</h3>Talk to help line for your question on 4141 456 789, 4125 666 888
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Product Fearure-->
                    <!--Product Tabs-->
                    <div class="tabs-listing">
                        <ul class="product-tabs">
                            <li rel="tab1"><a class="tablink">Sinopsis</a></li>
                        </ul>
                        <div class="tab-container">
                            <div id="tab1" class="tab-content">
                                <div class="product-description rte">
                                    <p><?= $buku["sinopsis"]; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Product Tabs-->

                </div>
                <!--#ProductSection-product-template-->
            </div>
            <!--MainContent-->
        </div>
        <!--End Body Content-->

        <!-- Footer -->
        <?php require 'assets/php/footer.php'; ?>
        <!-- End Footer -->
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
        <!-- Photoswipe Gallery -->
        <script src="assets/js/vendor/photoswipe.min.js"></script>
        <script src="assets/js/vendor/photoswipe-ui-default.min.js"></script>
        <script>
            $(function() {
                var $pswp = $('.pswp')[0],
                    image = [],
                    getItems = function() {
                        var items = [];
                        $('.lightboximages a').each(function() {
                            var $href = $(this).attr('href'),
                                $size = $(this).data('size').split('x'),
                                item = {
                                    src: $href,
                                    w: $size[0],
                                    h: $size[1]
                                }
                            items.push(item);
                        });
                        return items;
                    }
                var items = getItems();

                $.each(items, function(index, value) {
                    image[index] = new Image();
                    image[index].src = value['src'];
                });
                $('.prlightbox').on('click', function(event) {
                    event.preventDefault();

                    var $index = $(".active-thumb").parent().attr('data-slick-index');
                    $index++;
                    $index = $index - 1;

                    var options = {
                        index: $index,
                        bgOpacity: 0.9,
                        showHideOpacity: true
                    }
                    var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
                    lightBox.init();
                });
            });
        </script>
    </div>

    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button><button class="pswp__button pswp__button--share" title="Share"></button><button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button><button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button><button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>