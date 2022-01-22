<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit;
}

require 'config/functions.php';
require 'config/conn.php';


$username = $_SESSION['username'];
$user = query("SELECT * FROM users WHERE username = '$username'")[0];

$username = $_SESSION['username'];
$user_cart = query("SELECT * FROM cart WHERE username='$username' AND status='Cart'")[0];
$id_order = $user_cart['id_order'];

$books = query("SELECT * FROM detail_order d, buku b WHERE id_order='$id_order' AND d.id_buku=b.id_buku ORDER BY d.id_buku ASC");
$payment = query("SELECT * FROM payment");

if (isset($_POST['select_payment'])) {
    $_SESSION['select_id'] = $_POST['id_payment'];
    $_SESSION['bank'] = payment($_SESSION['select_id']);
    // var_dump($_SESSION['total_harga']);
    // exit;
}

if (isset($_POST['buy'])) {
    $total = $_POST['total'];

    $query = mysqli_query($conn, "UPDATE cart SET total = $total, status = 'Confirmed' WHERE id_order = '$id_order'");

    if ($query) {
        echo "
                Berhasil Check Out
                <script>
                    document.location.href='nota.php';
                </script>
            ";
    } else {
        echo "Gagal Check Out
		<meta http-equiv='refresh' content='1; url= index.php'/>";
    }
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
                        <h1 class="page-width">CHECKOUT</h1>
                    </div>
                </div>
            </div>
            <!--End Page Title-->

            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                        <div class="cart style2">
                            <h1>Shipping Address</h1>
                            <hr><br>

                            <h2> <?= $user['first_name']; ?> <?= $user['last_name']; ?> </h2>
                            <h3><?= $user['alamat']; ?></h3>
                            <hr><br>

                            <h1>product in order</h1>



                            <table>
                                <thead class="cart__row cart__header">
                                    <tr>
                                        <th colspan="2" class="text-center">Book</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($books as $book) : ?>
                                        <tr class="cart__row border-bottom line1 cart-flex border-top">
                                            <td class="cart__image-wrapper cart-flex-item">
                                                <a href="#"><img class="cart__image" src="assets/img/covers/<?= $book['gambar']; ?>" alt=""></a>
                                            </td>
                                            <td class="cart__meta small--text-left cart-flex-item">
                                                <div class="list-view-item__title">
                                                    <a href="#"><?= $book['judul']; ?></a>
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
                                                        <input class="qty" type="text" name="updates[]" id="qty" value="<?= $book['quantity']; ?>" pattern="[0-9]*">
                                                    </div>
                                                </div>
                                            </td>
                                            <?php $harga_buku = $book['harga'] * $book['quantity']; ?>
                                            <td class="text-right small--hide cart-price">
                                                <div><span class="money">Rp.<?= $harga_buku; ?></span></div>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                                <h5>Bank Name</h5>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <select id="payment" name="id_payment">
                                            <option value="">Select payment</option>
                                            <?php foreach ($payment as $pymt) : ?>
                                                <option value="<?= $pymt['id_payment']; ?>"><?= $pymt['nama_bank']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="actionRow">
                                        <div><button type="submit" class="btn btn-secondary btn--small" name="select_payment">Select Payment</button></div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">
                                <div class="solid-border">
                                    <div class="row border-bottom pb-2 pt-2">
                                        <span class="col-12 col-sm-6 cart__subtotal-title mb-2"><b>Shopping
                                                Summary</b></span>
                                    </div>
                                    <div class="row border-bottom pb-2 pt-2">
                                        <span class="col-12 col-sm-6 cart__subtotal-title">Total</span>
                                        <span class="col-12 col-sm-6 text-right">
                                            <?= $_SESSION['total_harga'] ?> </span>
                                    </div>
                                    <div class="row border-bottom pb-2 pt-2">
                                        <span class="col-12 col-sm-6 cart__subtotal-title">Payment</span>
                                        <span class="col-12 col-sm-6 text-right">
                                            <?php $payment_method = (isset($_SESSION['select_id']) ?  $_SESSION['bank']['nama_bank'] : "");
                                            echo $payment_method;  ?> </span>
                                    </div>
                                    <div class="row border-bottom pb-2 pt-2">
                                        <span class="col-12 col-sm-6 cart__subtotal-title">shipping insurance</span>
                                        <span class="col-12 col-sm-6 text-right">Rp.
                                            <?php $asuransi = 500;
                                            echo number_format($asuransi) ?> </span>
                                    </div>
                                    <div class="row border-bottom pb-2 pt-2">
                                        <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Grand
                                                Total</strong></span>
                                        <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money">Rp.
                                                <?= number_format($grandTotal = $_SESSION['total_harga'] + $asuransi) ?></span></span>
                                    </div>
                                    <form action="" method="post">
                                        <input type="hidden" name="total" value="<?= $grandTotal; ?>">
                                        <button type="submit" class="btn btn--small-wide checkout" name="buy">Buy</button>
                                    </form>
                                    <div class="paymnet-img"><img src="assets/images/payment-img.jpg" alt="Payment">
                                    </div>
                                </div>

                            </div>
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