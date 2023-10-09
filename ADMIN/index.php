<?php
session_start();
include '../koneksi.php';


if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $cari = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$id'"));
    $nama = $cari['nama'];
} else {
    header("Location: ../login/login.php");
}
$result = mysqli_query($koneksi, "SELECT * FROM `tb_judul`");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/style.css" />

    <!-- link Jquery 3.6.4 -->
    <script src="../library/jquery-3.6.4.min.js"></script>

    <!-- link icon bootstrap -->
    <!-- <link rel="stylesheet" href="../library/bootstrap-icon.css"> -->

    <!-- link Sweet Allert -->
    <script src="../library/sweetAllert2.min.js"></script>



    <!--link chart.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!--akhir link chart.js-->
    <title>Pengolahan Data</title>


    <style>
    main .kuesioner .add-button {
        background-color: #116D6E !important;
        color: white;
    }

    main .kuesioner .add-button:hover {
        background-color: #116D6E !important;
        color: white;
    }

    .bg-custom {
        background-color: #116D6E !important
    }

    .button .bg-custom:hover {
        background-color: #0a5a5c !important
    }
    </style>

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample"><span class="navbar-toggler-icon"></span></button>
            <a class="navbar-brand fw-bold me-auto text-uppercase" href="#">Kuisioner</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form action="" method="GET" class="d-flex ms-auto">
                    <div class="input-group my-3 my-lg-0">
                        <input type="text" class="form-control" placeholder="Masukkan Nama" aria-label="Masukkan"
                            aria-describedby="button-addon2" name="cari" />
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i
                                class="bi bi-search"></i></button>
                    </div>
                </form>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-fill"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"><span class="me-2">
                                        <i class="bi bi-person-lines-fill"></i></span><?= $nama; ?></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="../login/logout.php"><span class="me-2"><i
                                            class="bi bi-box-arrow-right"></i></span>Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->

    <!-- OffCanvas -->

    <div class="offcanvas offcanvas-start bg-dark text-white sidebar-nav hide" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-body p-0">
            <nav class="navbar-dark">
                <ul class="navbar-nav">
                    <li>
                        <div class="text-muted small fw-bold text-uppercase px-3">CORE</div>
                    </li>
                    <!-- <img src="person.jpg" class="rounded-circle " width="50%"  alt=""> -->
                    <li>
                        <a href="index.php" class="nav-link px-3 active">
                            <span class="me-2">
                                <i class="bi bi-speedometer2"></i>
                            </span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="my-4">
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <div class="text-muted small fw-bold text-uppercase px-3">Menu</div>
                    </li>
                    <li>
                        <a href="index.php" class="nav-link px-3">
                            <span class="me-2">
                                <i class="bi bi-pie-chart-fill"></i>
                            </span>
                            <span>Kuisioner</span>
                        </a>
                        <a href="#" id="responden" class="nav-link px-3">
                            <span class="me-2">
                                <i class="bi bi-people-fill"></i>
                            </span>
                            <span>Responden</span>
                        </a>
                        <a href="#" id="pengolahan" class="nav-link px-3">
                            <span class="me-2">
                                <i class="bi bi-people-fill"></i>
                            </span>
                            <span>Olah Data</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- OffCanvas -->

    <main class="mt-5 pt-3" id="menu">

    </main>
    <script src="../css/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#menu').load('kuisioner/index.php');

        // menu responden
        $('#responden').on('click', function(e) {
            $('#menu').load('responden/index.php');
        })
        // menu pengolahan
        $('#pengolahan').on('click', function(e) {
            $('#menu').load('pengolahan-data/tabel-olah.php');
        })
    })
    </script>
</body>



</html>