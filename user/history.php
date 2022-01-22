<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != "user") {
    header("location:../index.php");
    exit;
}

require '../config/functions.php';

$username = $_SESSION['username'];

$books = query("SELECT DISTINCT(id_cart), cart.id_order, tgl_order, total, status FROM cart, detail_order WHERE cart.username='$username' AND detail_order.id_order=cart.id_order AND status!='Cart' ORDER BY tgl_order DESC");

// var_dump($_SESSION);
// exit;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    <!-- Icon -->
    <link rel="shortcut icon" href="../assets/img/logo-header.png" />

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="src/user.css">
</head>

<body>

    <div class="container-fluid">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">
                            <span data-feather="home"></span>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="history.php">
                            <span data-feather="file"></span>
                            History
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="keluhan.php">
                            <span data-feather="file"></span>
                            Keluhan
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row gutters">
                <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Tanggal Order</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($books as $book) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $book['id_order']; ?></td>
                                    <td><?= $book['tgl_order']; ?></td>
                                    <td>Rp. <?= number_format($book['total']); ?></td>
                                    <td><?= $book['status']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


</body>

</html>