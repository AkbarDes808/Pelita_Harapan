<?php
session_start();
require '../config/functions.php';
require 'config/functions.php';

$kategori = $_GET['kategori'];

CRUD("DELETE from kategori where kategori='$kategori'");

header("location:kategori.php");
