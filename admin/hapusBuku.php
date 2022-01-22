<?php
session_start();
require '../config/functions.php';
require 'config/functions.php';

$id_buku = $_GET['id_buku'];

CRUD("DELETE from buku where id_buku='$id_buku'");

header("location:buku.php");
