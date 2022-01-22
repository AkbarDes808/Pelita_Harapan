<?php
$footer_cats = query("SELECT * FROM kategori");

?>

<!--Footer-->
<footer id="footer">
    <div class="site-footer">
        <div class="container">
            <!--Footer Links-->
            <div class="footer-top">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                        <h4 class="h4">Quick Shop</h4>
                        <ul>
                            <?php foreach ($footer_cats as $cat) : ?>
                                <li><a href="kategori.php?kategori=<?= $cat['kategori']; ?>"><?= $cat['kategori']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                        <h4 class="h4">Informations</h4>
                        <ul>
                            <li><a href="tentangkami.php">About us</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Privacy policy</a></li>
                            <li><a href="syaratdanketentuan.php">Terms &amp; condition</a></li>
                            <li><a href="#">My Account</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                        <h4 class="h4">Customer Services</h4>
                        <ul>
                            <li><a href="#">Request Personal Data</a></li>
                            <li><a href="#">FAQ's</a></li>
                            <li><a href="footer link/contactus.php">Contact Us</a></li>
                            <li><a href="#">Orders and Returns</a></li>
                            <li><a href="#">Support Center</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 contact-box">
                        <h4 class="h4">Contact Us</h4>
                        <ul class="addressFooter">
                            <li><i class="icon anm anm-map-marker-al"></i>
                                <p>Jl. Padjajaran, Ring Road Utara,<br>Kel. Condongcatur, Kec. Depok, Kab. Sleman</p>
                            </li>
                            <li class="phone"><i class="icon anm anm-phone-s"></i>
                                <p>(0274) 884201 – 207</p>
                            </li>
                            <li class="email"><i class="icon anm anm-envelope-l"></i>
                                <p>sales@pelitaharapan.com</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--End Footer Links-->
        </div>
    </div>
</footer>
<!--End Footer-->