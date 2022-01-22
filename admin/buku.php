<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != "admin") {
    header("location:../index.php");
    exit;
}

require '../config/functions.php';
require 'config/functions.php';

$books = query("SELECT * FROM kategori, buku WHERE kategori.kategori = buku.kategori");

$kategori = query("SELECT * FROM kategori");

$date = date('Y-m-d H:i:s');


if (isset($_POST["tambah"])) {
    $judul = $_POST["judul"];
    $penulis = $_POST["penulis"];
    $tahunTerbit = $_POST["tahunTerbit"];
    $kategori = $_POST["kategori"];
    $penerbit = $_POST["penerbit"];
    $sinopsis = $_POST["sinopsis"];
    $gambar = $_FILES['gambar']['name'];
    $harga = $_POST['harga'];

    $ekstensi_diperbolehkan    = array('png', 'jpg');
    $x = explode('.', $gambar);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar']['tmp_name'];

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, '../assets/img/covers/' . $gambar);
        $tambahbuku = CRUD("INSERT INTO buku (judul, penulis, tahun_terbit, kategori, penerbit, sinopsis, gambar, harga, tanggalMasuk) VALUES ('$judul','$penulis','$tahunTerbit','$kategori','$penerbit','$sinopsis','$gambar','$harga','$date')");
        if ($tambahbuku) {
            echo "<meta http-equiv='refresh' content='1; url= buku.php'/>";
        } else {
            echo "<meta http-equiv='refresh' content='1; url= buku.php'/>";
        }
    } else {
        echo "gagal";
    }
}

if (isset($_POST["edit"])) {
    $id_buku = $_POST['id_buku'];
    $judul = $_POST["judul"];
    $penulis = $_POST["penulis"];
    $tahunTerbit = $_POST["tahunTerbit"];
    $kategori = $_POST["kategori"];
    $penerbit = $_POST["penerbit"];
    $sinopsis = $_POST["sinopsis"];
    $harga = $_POST['harga'];
    $gambarLama = $_POST['gambarLama'];

    if ($_FILES['gambar']['error'] == 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = $_FILES['gambar']['name'];
    }

    $ekstensi_diperbolehkan    = array('png', 'jpg');
    $x = explode('.', $gambar);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar']['tmp_name'];

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, '../assets/img/covers/' . $gambar);
        $editbuku = CRUD("UPDATE buku set judul='$judul', penulis='$penulis', tahun_terbit='$tahunTerbit', kategori='$kategori', penerbit='$penerbit', sinopsis='$sinopsis', gambar='$gambar', harga='$harga' where id_buku='$id_buku'");
        if ($editbuku) {
            echo "<meta http-equiv='refresh' content='1; url= buku.php'/>";
        } else {
            echo "Gagal";
        }
    } else {
        echo "gagal";
    }
}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kelola Buku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">

    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <?php require 'assets/php/sidebar.php'; ?>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li>
                                <h3>
                                    <div class="date">
                                        <script type='text/javascript'>
                                            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                                                'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                            ];
                                            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                            var date = new Date();
                                            var day = date.getDate();
                                            var month = date.getMonth();
                                            var thisDay = date.getDay(),
                                                thisDay = myDays[thisDay];
                                            var yy = date.getYear();
                                            var year = (yy < 1000) ? yy + 1900 : yy;
                                            document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                                        </script></b>
                                    </div>
                                </h3>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- page title area end -->
            <div class="main-content-inner">

                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <h2>Daftar Buku</h2>
                                    <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2">Tambah Buku</button>
                                </div>
                                <div class="data-tables datatable-dark">
                                    <table id="dataTable3" class="display" style="width:100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No.</th>
                                                <th>Gambar</th>
                                                <th>Judul</th>
                                                <th>Penulis</th>
                                                <th>Tahun Terbit</th>
                                                <th>Kategori</th>
                                                <th>Penerbit</th>
                                                <th>Harga</th>
                                                <th>Tanggal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($books as $book) : ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><img src="../assets/img/covers/<?= $book['gambar']; ?>" width="30px">
                                                    </td>
                                                    <td><?= $book['judul']; ?></td>
                                                    <td><?= $book['penulis']; ?></td>
                                                    <td><?= $book['tahun_terbit']; ?></td>
                                                    <td><?= $book['kategori']; ?></td>
                                                    <td><?= $book['penerbit']; ?></td>
                                                    <td>Rp. <?= number_format($book['harga']); ?></td>
                                                    <td><?= $book['tanggalMasuk']; ?></td>
                                                    <td>
                                                        <a href="" data-toggle="modal" data-target="#myModal2<?php echo $book['id_buku']; ?>" class="text-warning">Edit</a>
                                                        <a href="hapusBuku.php?id_buku=<?php echo $book['id_buku']; ?>" class="
                                                        text-danger">Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row area start-->
        </div>
    </div>
    <!-- main content area end -->
    </div>
    <!-- page container area end -->

    <!-- modal input -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Produk</h4>
                </div>

                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Judul</label>
                            <input name="judul" type="text" class="form-control" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Penulis</label>
                            <input name="penulis" type="text" class="form-control" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Tahun Terbit</label>
                            <input name="tahunTerbit" type="number" class="form-control" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Nama Kategori</label>

                            <select name="kategori" class="form-control">
                                <option selected>Pilih Kategori</option>
                                <?php foreach ($kategori as $kate) { ?>
                                    <option value="<?= $kate['kategori'] ?>"><?php echo $kate['kategori'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Penerbit</label>
                            <input name="penerbit" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Sinopsis</label>
                            <input name="sinopsis" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input name="gambar" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input name="harga" type="number" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input name="tambah" type="submit" class="btn btn-primary" value="Tambah">
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- edit -->

    <?php foreach ($books as $book) : ?>
        <div id="myModal2<?php echo $book['id_buku']; ?>" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Produk</h4>
                    </div>

                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_buku" value="<?php echo $book['id_buku']; ?>">
                            <input type="hidden" name="gambarLama" value="<?php echo $book['gambar']; ?>">
                            <div class=" form-group">
                                <label>Judul</label>
                                <input name="judul" type="text" class="form-control" required autofocus value="<?php echo $book['judul']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Penulis</label>
                                <input name="penulis" type="text" class="form-control" required autofocus value="<?php echo $book['penulis']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Tahun Terbit</label>
                                <input name="tahunTerbit" type="number" class="form-control" required autofocus value="<?php echo $book['tahun_terbit']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Nama Kategori</label>

                                <select name="kategori" class="form-control" id="kategori">
                                    <option>Pilih Kategori</option>
                                    <?php
                                    foreach ($kategori as $kate) {
                                        if ($book['kategori'] == $kate['kategori']) { ?>
                                            <option selected value="<?= $kate['kategori'] ?>"><?php echo $kate['kategori'] ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Penerbit</label>
                                <input name="penerbit" type="text" class="form-control" value="<?php echo $book['penerbit']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Sinopsis</label>
                                <input name="sinopsis" type="text" class="form-control" value="<?php echo $book['sinopsis']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Gambar</label><br>
                                <div class="card" style="width: 15rem;">
                                    <img class="card-img-top" src="../assets/img/covers/<?php echo $book['gambar']; ?>" alt="">
                                    <div class="card-body">
                                        <input name="gambar" type="file" class="form-control">
                                    </div>
                                </div>



                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input name="harga" type="number" class="form-control" value="<?php echo $book['harga']; ?>">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input name="edit" type="submit" class="btn btn-primary" value="Edit">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <script>
        $(document).ready(function() {
            $('#dataTable3').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            });
        });
    </script>

    <!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
        zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>