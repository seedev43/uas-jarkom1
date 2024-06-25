<?php
require_once("../../config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $cover = htmlspecialchars($_POST['cover']);
    $title = htmlspecialchars($_POST['title']);
    $slug = slug($title);
    $description = $_POST['description'];
    $author_id = $_POST['author_id'];
    $publisher_id = $_POST['publisher_id'];
    $publication_year_id = $_POST['publication_year_id'];

    // Cek apakah data sudah ada
    // $query = "SELECT * FROM books WHERE title = '$title'";
    // $result = mysqli_query($conn, $query);
    $query = "UPDATE books SET author_id = '$author_id', publisher_id = '$publisher_id', publication_year_id = '$publication_year_id',
        cover = '$cover', title = '$title', slug = '$slug', description = '$description' WHERE id = '$id' ";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $_SESSION['update_success'] = true;
        header("Location: ../../pages/index.php"); // redirect ke halaman utama(index.php)
    } else {
        die("Gagal update data"); // program akan berhenti di file ini
    }
}
