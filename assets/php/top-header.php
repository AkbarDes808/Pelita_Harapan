<!--Top Header-->
<div class="top-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-10 col-sm-8 col-md-5 col-lg-4">
                <p class="phone-no"><i class="anm anm-phone-s"></i> +62 0(111) 044 833</p>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">
                <div class="text-center">
                    <p class="top-header_middle-text">Express Shipping</p>
                </div>
            </div>
            <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
                <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
                <?php if (isset($_SESSION['login'])) : ?>
                    <ul class="customer-links list-inline">
                        <?php if ($_SESSION['role'] == "admin") : ?>
                            <li><a href="admin/index.php">Hi, <?= $_SESSION['username']; ?>!</a></li>
                        <?php else : ?>
                            <li><a href="user/index.php">Hi, <?= $_SESSION['username']; ?>!</a></li>
                        <?php endif; ?>
                        <li><a href="wishlist.php">Wishlist</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                <?php else : ?>
                    <ul class="customer-links list-inline">
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Create Account</a></li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!--End Top Header-->