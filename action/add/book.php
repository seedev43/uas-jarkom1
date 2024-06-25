<?php
require_once("../../config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $cover = htmlspecialchars($_POST['cover']);
    $title = htmlspecialchars($_POST['title']);
    $slug = slug($title);
    $description = $_POST['description'];
    $author_id = $_POST['author_id'];
    $publisher_id = $_POST['publisher_id'];
    $publication_year_id = $_POST['publication_year_id'];

    // Cek apakah data sudah ada
    $query = "SELECT * FROM books WHERE title = '$title'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        die("Data sudah ada di database");
    } else {
        $query = "INSERT INTO books (author_id, publisher_id, publication_year_id, cover, title, slug, description) 
        VALUES ('$author_id', '$publisher_id', '$publication_year_id', '$cover', '$title', '$slug', '$description')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $_SESSION['add_success'] = true;
            header("Location: ../../pages/index.php"); // redirect ke halaman utama(index.php)
        } else {
            die("Gagal tambah data"); // program akan berhenti di file ini
        }
    }
}
