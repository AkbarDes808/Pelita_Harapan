<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Pelita Harapan</a> -->
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="delete.php?username=<?= $user['username']; ?>" onclick="return confirm('Yakin untuk menghapus akun anda?');">Delete Account</a>
            <a class="nav-link px-3" href="../index.php">Back</a>
        </div>
    </div>
</header>