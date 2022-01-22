<?php
require '../config/conn.php';

function tambahKategori($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);

    return $result;
}
