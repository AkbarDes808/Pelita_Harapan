<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie("username", "", time() - 3600);
setcookie("role", "", time() - 3600);

header("location:index.php");
