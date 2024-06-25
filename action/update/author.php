<?php
require_once("../../config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $author = htmlspecialchars($_POST['author']);
    $slug = slug($author);

    $query = "UPDATE authors SET name = '$author', slug = '$slug' WHERE id = '$id' ";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $_SESSION['update_success'] = true;
        header("Location: ../../pages/author.php"); // redirect ke halaman utama(index.php)
    } else {
        die("Gagal update data"); // program akan berhenti di file ini
    }
}
