<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit;
}

require 'config/functions.php';

$username = $_SESSION['username'];
$user_cart = query("SELECT * FROM cart WHERE username='$username' AND status='Cart'")[0];
$id_order = $user_cart['id_order'];

$books = query("SELECT * FROM detail_order d, buku b WHERE id_order='$id_order' AND d.id_buku=b.id_buku ORDER BY d.id_buku ASC");

if (isset($_POST['remove'])) {
    $id_buku = $_POST['id_buku'];
    if (hapus_buku("DELETE FROM detail_order WHERE id_buku=$id_buku AND id_order='$id_order'")) {
        echo "<meta http-equiv='refresh' content='1; url= cart.php'/>";
    } else {
        echo "Gagal dihapus";
    }
}

$ongkos_kirim = query("SELECT * FROM ongkir");


if (isset($_POST['calculate_shipping'])) {
    $_SESSION['select_city'] = $_POST['address'];
    $_SESSION['biaya_ongkir'] = ongkir($_SESSION['select_city']);
}

$dsc = query("SELECT * FROM voucher");

if (isset($_POST['apply_coupon'])) {
    $_SESSION['coupon'] = $_POST['coupon'];
    $_SESSION['jumlahDiskon'] = voucher($_SESSION['coupon']);
}

if (isset($_POST['checkout'])) {
    $_SESSION['total_harga'] = $_POST['totalHarga'];
    header("location:checkout.php");
    exit;
}

?>


<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cart Page</title>
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

<body class="page-template belle cart-variant1">
    <div class="pageWrapper">
        <!--Top Header-->
        <?php require 'assets/php/top-header.php'; ?>
        <!--End Top Header-->

        <!--Header-->
        <?php require 'assets/php/nav.php'; ?>
        <!--End Header-->

        <!--Body Content-->
        <div id="page-content">
            <!--Page Title-->
            <div class="page section-header text-center">
                <div class="page-title">
                    <div class="wrapper">
                        <h1 class="page-width">Shopping Cart</h1>
                    </div>
                </div>
            </div>
            <!--End Page Title-->

            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                        <div class="cart style2">

                            <table>
                                <thead class="cart__row cart__header">
                                    <tr>
                                        <th colspan="2" class="text-center">Book</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Total</th>
                                        <th class="action">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $subtotal = 0; ?>

                                    <?php foreach ($books as $book) : ?>
                                        <tr class="cart__row border-bottom line1 cart-flex border-top">
                                            <td class="cart__image-wrapper cart-flex-item">
                                                <a href="#"><img class="cart__image" src="assets/img/covers/<?= $book['gambar']; ?>" alt=""></a>
                                            </td>
                                            <td class="cart__meta small--text-left cart-flex-item">
                                                <div class="list-view-item__title">
                                                    <a href="detail.php?id_buku=<?= $book['id_buku']; ?>"><?= $book['judul']; ?></a>
                                                </div>

                                                <div class="cart__meta-text">
                                                    Kategori: <?= $book['kategori']; ?>
                                                </div>
                                            </td>
                                            <td class="cart__price-wrapper cart-flex-item">
                                                <span class="money">Rp.<?= $book['harga']; ?></span>
                                            </td>
                                            <td class="cart__update-wrapper cart-flex-item text-right">
                                                <div class="cart__qty text-center">
                                                    <div class="qtyField">
                                                        <a class="qtyBtn minus" href="javascript:void(0);"><i class="icon icon-minus"></i></a>
                                                        <input class="cart__qty-input qty" type="text" name="updates[]" id="qty" value="<?= $book['quantity']; ?>" pattern="[0-9]*">
                                                        <a class="qtyBtn plus" href="javascript:void(0);"><i class="icon icon-plus"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <?php $harga_buku = $book['harga'] * $book['quantity']; ?>
                                            <td class="text-right small--hide cart-price">
                                                <div><span class="money">Rp.<?= $harga_buku; ?></span></div>
                                            </td>
                                            <form action="#" method="post" class="cart style2">
                                                <input type="hidden" name="id_buku" value="<?= $book['id_buku']; ?>">
                                                <td class="text-center small--hide">
                                                    <button type="submit" class="btn btn--secondary cart__remove" name="remove"><i class="icon icon anm anm-times-l"></i></button>
                                                </td>
                                            </form>
                                        </tr>
                                        <?php $subtotal = $subtotal + $harga_buku; ?>
                                    <?php endforeach; ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-left"><a href="" class="btn btn-secondary btn--small cart-continue">Continue shopping</a>
                                        </td>
                                        <td colspan="3" class="text-right">
                                            <button type="submit" name="clear" class="btn btn-secondary btn--small  small--hide">Clear Cart</button>
                                            <button type="submit" name="update" class="btn btn-secondary btn--small cart-continue ml-2">Update
                                                Cart</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>

                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                                <h5>Discount Codes</h5>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="address_zip">Enter your coupon code if you have one.</label>
                                        <input type="text" name="coupon" autocomplete="off">
                                    </div>
                                    <div class="actionRow">
                                        <button type="submit" class="btn btn-secondary btn--small" name="apply_coupon">Apply Coupon</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                                <h5>Estimate Shipping and Tax</h5>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="address">Kota</label>
                                        <select id="address" name="address">
                                            <?php foreach ($ongkos_kirim as $ongkir) : ?>
                                                <option value="<?= $ongkir['nama_kota']; ?>"><?= $ongkir['nama_kota']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="actionRow">
                                        <div><button type="submit" class="btn btn-secondary btn--small" name="calculate_shipping">Calculate shipping</button></div>
                                    </div>
                                </form>
                            </div>

                            <!-- <form action="checkout.php" method="post"> -->
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">
                                <div class="solid-border">
                                    <div class="row border-bottom pb-2">
                                        <span class="col-12 col-sm-6 cart__subtotal-title">Subtotal</span>
                                        <span class="col-12 col-sm-6 text-right"><span class="money"><?= $subtotal; ?></span></span>
                                    </div>
                                    <div class="row border-bottom pb-2 pt-2">
                                        <span class="col-12 col-sm-6 cart__subtotal-title">Tax</span>
                                        <span class="col-12 col-sm-6 text-right"><?= $pajak = $subtotal * 0.1; ?></span>
                                    </div>
                                    <div class="row border-bottom pb-2 pt-2">
                                        <span class="col-12 col-sm-6 cart__subtotal-title">Coupon</span>
                                        <span class="col-12 col-sm-6 text-right"><?php $jumlah_diskon = (isset($_SESSION['coupon']) ?  $_SESSION['jumlahDiskon']['diskon'] : "0");
                                                                                    echo $jumlah_diskon  ?></span>
                                    </div>
                                    <div class="row border-bottom pb-2 pt-2">
                                        <span class="col-12 col-sm-6 cart__subtotal-title">Shipping</span>
                                        <span class="col-12 col-sm-6 text-right"><?php $biaya_ongkir = (isset($_SESSION['select_city']) ?  $_SESSION['biaya_ongkir']['ongkir'] : "0");
                                                                                    echo $biaya_ongkir;  ?></span>
                                    </div>
                                    <div class="row border-bottom pb-2 pt-2">
                                        <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Grand
                                                Total</strong></span>
                                        <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money"><?= $totalHarga = $subtotal + $biaya_ongkir + $pajak - $jumlah_diskon; ?></span></span>
                                    </div>
                                    <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div>
                                    <p class="cart_tearm">
                                        <label>
                                            <input type="checkbox" name="tearm" class="checkbox" value="tearm" required="">
                                            I agree with the terms and conditions
                                        </label>
                                    </p>
                                    <form action="" method="post">
                                        <input type="hidden" name="totalHarga" value="<?= $totalHarga; ?>">
                                        <input type="submit" name="checkout" id="cartCheckout" class="btn btn--small-wide checkout" value="Proceed To Checkout">
                                    </form>
                                    <div class="paymnet-img"><img src="assets/images/payment-img.jpg" alt="Payment">
                                    </div>
                                    <!-- <p><a href="checkout.php">PROCEED TO CHECKOUT</a></p> -->
                                </div>
                            </div>
                            <!-- </form> -->
                        </div>
                    </div>

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
</body>

</html>