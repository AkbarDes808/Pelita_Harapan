<?php
$nav_cats = query("SELECT * FROM kategori");

?>

<!--Search Form Drawer-->
<div class="search">
    <div class="search__form">
        <form class="search-bar__form" action="search.php" method="GET">
            <button class="go-btn search__button" type="submit" name="search"><i class="icon anm anm-search-l"></i></button>
            <input class="search__input" type="search" name="q" placeholder="Search entire store..." aria-label="Search" autocomplete="off">
        </form>
        <button type="button" class="search-trigger close-btn"><i class="anm anm-times-l"></i></button>
    </div>
</div>
<!--End Search Form Drawer-->


<div class="header-wrap classicHeader animated d-flex">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!--Desktop Logo-->
            <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                <a href="index.php">
                    <img src="assets/img/logo.png" alt="Toko Buku Pelita Harapan" title="Toko Buku Pelita Harapan" />
                </a>
            </div>
            <!--End Desktop Logo-->
            <div class="col-2 col-sm-3 col-md-3 col-lg-8">
                <div class="d-block d-lg-none">
                    <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                        <i class="icon anm anm-times-l"></i>
                        <i class="anm anm-bars-r"></i>
                    </button>
                </div>
                <!--Desktop Menu-->
                <nav class="grid__item" id="AccessibleNav">
                    <!-- for mobile -->
                    <ul id="siteNav" class="site-nav medium center hidearrow">
                        <li class="lvl1 parent megamenu"><a href="index.php">Home <i class="anm anm-angle-down-l"></i></a>
                        </li>
                        <li class="lvl1 parent dropdown"><a href="#">Category <i class="anm anm-angle-down-l"></i></a>
                            <ul class="dropdown">
                                <?php foreach ($nav_cats as $cat) : ?>
                                    <li><a href="kategori.php?kategori=<?= $cat['kategori']; ?>" class="site-nav"><?= $cat['kategori']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li class="lvl1 parent dropdown"><a href="#">Pages <i class="anm anm-angle-down-l"></i></a>
                            <ul class="dropdown">
                                <li><a href="cart.php" class="site-nav">Cart Page</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!--End Desktop Menu-->
            </div>
            <div class="col-4 col-sm-3 col-md-3 col-lg-2">
                <div class="site-cart">
                    <a href="cart.php" class="site-header__cart" title="Cart">
                        <i class="icon anm anm-bag-l"></i>
                    </a>
                </div>
                <div class="site-header__search">
                    <button type="button" class="search-trigger"><i class="icon anm anm-search-l"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>