<?php
require_once("../../config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $year = htmlspecialchars($_POST['year']);
    $slug = slug($year);

    // Cek apakah data sudah ada
    $query = "SELECT * FROM publication_years WHERE year = '$year'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        die("Data sudah ada di database");
    } else {
        $query = "INSERT INTO publication_years (year) VALUES ('$year')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['add_success'] = true;
            header("Location: " . $base_url . "pages/publication_year.php");
        } else {
            die("Gagal tambah data");
        }
    }
}
