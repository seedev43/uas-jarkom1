<?php
require_once("../../config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $author = htmlspecialchars($_POST['author']);
    $slug = slug($author);

    // Cek apakah data sudah ada
    $query = "SELECT * FROM authors WHERE name = '$author'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        die("Data sudah ada di database");
    } else {
        $query = "INSERT INTO authors (name, slug) VALUES ('$author', '$slug')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['add_success'] = true;
            header("Location: " . $base_url . "pages/author.php");
        } else {
            die("Gagal tambah data");
        }
    }
}
