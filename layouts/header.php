<?php
require_once("../config.php");

$path = $_SERVER['REQUEST_URI']; // mengambil url path
$segments = explode('/', $path); // memecah string menjadi array
$lastSegment = end($segments); // mengambil elemen terakhir dari array $segments
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?> - CRUD Sederhana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <style>
        .deskripsi {
            max-width: 200px;
            /* Atur lebar maksimum kolom deskripsi */
            white-space: nowrap;
            /* Mencegah wrapping teks */
            overflow: hidden;
            /* Menyembunyikan teks yang melebihi lebar maksimum */
            text-overflow: ellipsis;
            /* Menampilkan tanda elipsis (...) jika teks terpotong */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Selamat Datang <?php echo $_SESSION['username']; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($lastSegment == 'index.php') ? 'active' : ''; ?>" href="<?php echo $base_url; ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item <?php echo ($lastSegment == 'author.php') ? 'active' : ''; ?>" href="<?php echo $base_url; ?>pages/author.php">Daftar Pengarang</a></li>
                            <li><a class="dropdown-item <?php echo ($lastSegment == 'publisher.php') ? 'active' : ''; ?>" href="<?php echo $base_url; ?>pages/publisher.php">Daftar Penerbit</a></li>
                            <li><a class="dropdown-item <?php echo ($lastSegment == 'publication_year.php') ? 'active' : ''; ?>" href="<?php echo $base_url; ?>pages/publication_year.php">Daftar Tahun Terbit</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../action/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>