<?php
// error_reporting(0);
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

session_start();
$title = "Aplikasi Daftar Buku";
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$domain = $protocol . "://" . $_SERVER['HTTP_HOST'];

// Mengambil path folder
$path = dirname($_SERVER['PHP_SELF']);

$directory = "/";
$base_url = $domain . $directory;
$servername = "localhost";
$username = "root";
$password = "ok";
$dbname = "crud";

// buat koneksi database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// cek koneksi database
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


function slug($string)
{
    $slug = strtolower(trim($string)); // Mengubah string menjadi lowercase dan menghapus spasi di awal dan akhir

    // Menghapus karakter non-alfanumerik kecuali spasi
    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);

    // Menggabungkan beberapa spasi menjadi satu spasi
    $slug = preg_replace('/\s+/', ' ', $slug);

    // Mengganti spasi dengan tanda strip (-)
    $slug = str_replace(' ', '-', $slug);

    return $slug;
}
