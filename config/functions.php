<?php
require 'conn.php';

function query($data)
{
    global $conn;

    $result = mysqli_query($conn, $data);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function create_account($data)
{
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $first_name = htmlspecialchars($data['first_name']);
    $last_name = htmlspecialchars($data['last_name']);
    $email = htmlspecialchars($data['email']);
    $password = mysqli_escape_string($conn, $data['password']);

    // cek apakah username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "
            <script>
                alert('username sudah terdaftar');
            </script>
        ";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO users VALUES('$username', '$first_name', '$last_name', '$email', '$password', 'user')");

    return mysqli_affected_rows($conn);
}

function delete_account($username)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM users WHERE username = '$username'");

    return mysqli_affected_rows($conn);
}

function update_account($data)
{
    global $conn;

    $username = $data['username'];
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT);

    $query = "UPDATE users SET
                first_name = '$first_name',
                last_name = '$last_name',
                email = '$email',
                password = '$password'
              WHERE username = '$username'
            ";

    mysqli_query($conn, $query);
    exit;

    return mysqli_affected_rows($conn);
}

function cari($q)
{
    $query = "SELECT * FROM buku WHERE judul LIKE '%$q%'";

    return query($query);
}

function hapus_buku($q)
{
    global $conn;

    $result = mysqli_query($conn, $q);

    return $result;
}

function ongkir($data)
{

    $result = "SELECT ongkir FROM ongkir WHERE nama_kota = '$data'";

    return query($result)[0];
}

function voucher($data)
{

    $result = "SELECT diskon FROM voucher WHERE id_voucher = '$data'";

    return query($result)[0];
}

function payment($data)
{

    $result = "SELECT nama_bank FROM payment  WHERE id_payment = '$data'";

    return query($result)[0];
}

function CRUD($data)
{
    global $conn;

    $result = mysqli_query($conn, $data);

    return $result;
}
