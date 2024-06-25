<?php
require_once("../../config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $publisher = htmlspecialchars($_POST['publisher']);
    $slug = slug($publisher);

    // Cek apakah data sudah ada
    $query = "SELECT * FROM publishers WHERE name = '$publisher'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        die("Data sudah ada di database");
    } else {
        $query = "INSERT INTO publishers (name, slug) VALUES ('$publisher', '$slug')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['add_success'] = true;
            header("Location: " . $base_url . "pages/publisher.php");
        } else {
            die("Gagal tambah data");
        }
    }
}
