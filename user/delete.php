<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != "user") {
    header("location:index.php");
    exit;
}

require '../config/functions.php';

$username = $_GET['username'];

if (delete_account($username) > 0) {
    $_SESSION = [];
    session_unset();
    session_destroy();
    echo "
            <script>
                alert('Akun berhasil dihapus');
                document.location.href = '../index.php';
            </script>
        ";
} else {
    echo "
            <script>
                alert('Akun gagal dihapus');
                document.location.href = '../index.php';
            </script>
        ";
}
