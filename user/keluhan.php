<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != "user") {
    header("location:../index.php");
    exit;
}

require '../config/functions.php';
require '../config/conn.php';

$username = $_SESSION['username'];

$user = query("SELECT * FROM users WHERE username = '$username'")[0];

if (isset($_POST['submit'])) {
    // var_dump($_POST);
    // exit;
    $isi_keluhan = $_POST['keluhan'];
    $query = "INSERT INTO keluhan (username, isi) VALUES ( '$username', '$isi_keluhan' )";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "
            <div class='alert alert-success'>
                Berhasil mengirimkan keluhan
            </div>

            <meta http-equiv='refresh' content='1; url= index.php'/>
        ";
    } else {
        echo "
            <div class='alert alert-warning'>
                Gagal mengirimkan keluhan
            </div>

            <meta http-equiv='refresh' content='1; url= index.php'/>
        ";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Keluhan</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    <!-- Icon -->
    <link rel="shortcut icon" href="../assets/img/logo-header.png" />

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100vh;
            padding: 0;
            font-family: Roboto, Arial, sans-serif;
        }

        input,
        textarea {
            outline: none;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        h1 {
            margin-top: 0;
            font-weight: 500;
        }

        form {
            position: relative;
            width: 80%;
            border-radius: 30px;
            background: #fff;
        }

        .form-left-decoration,
        .form-right-decoration {
            content: "";
            position: absolute;
            width: 50px;
            height: 20px;
            border-radius: 20px;
            background: #5a7233;
        }

        .form-left-decoration {
            bottom: 60px;
            left: -30px;
        }

        .form-right-decoration {
            top: 60px;
            right: -30px;
        }

        .form-left-decoration:before,
        .form-left-decoration:after,
        .form-right-decoration:before,
        .form-right-decoration:after {
            content: "";
            position: absolute;
            width: 50px;
            height: 20px;
            border-radius: 30px;
            background: #fff;
        }

        .form-left-decoration:before {
            top: -20px;
        }

        .form-left-decoration:after {
            top: 20px;
            left: 10px;
        }

        .form-right-decoration:before {
            top: -20px;
            right: 0;
        }

        .form-right-decoration:after {
            top: 20px;
            right: 10px;
        }

        .circle {
            position: absolute;
            bottom: 80px;
            left: -55px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #fff;
        }

        .form-inner {
            padding: 40px;
        }

        .form-inner input,
        .form-inner textarea {
            display: block;
            width: 100%;
            padding: 15px;
            margin-bottom: 10px;
            border: none;
            border-radius: 20px;
            background: #d0dfe8;
        }

        .form-inner textarea {
            resize: none;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border-radius: 20px;
            border: none;
            border-bottom: 4px solid #3e4f24;
            background: #5a7233;
            font-size: 16px;
            font-weight: 400;
            color: #fff;
        }

        button:hover {
            background: #3e4f24;
        }

        @media (min-width: 568px) {
            form {
                width: 60%;
            }
        }
    </style>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="src/user.css">
</head>

<body>

    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">
                        <span data-feather="home"></span>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="history.php">
                        <span data-feather="file"></span>
                        History
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="keluhan.php">
                        <span data-feather="file"></span>
                        Keluhan
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <form action="" method="post">
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
        <div class="circle"></div>
        <div class="form-inner">
            <h1>Keluhan</h1>
            <input type="text" name="username" value="<?= $user['username']; ?>" readonly>
            <textarea name="keluhan" placeholder="Message..." rows="5"></textarea>
            <button type="submit" name="submit">Submit</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/valueap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="src/user.js"></script>
</body>

</html>