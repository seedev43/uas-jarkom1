<?php
require_once("../../config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $publisher = htmlspecialchars($_POST['publisher']);
    $slug = slug($publisher);

    $query = "UPDATE publishers SET name = '$publisher', slug = '$slug' WHERE id = '$id' ";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $_SESSION['update_success'] = true;
        header("Location: ../../pages/publisher.php"); // redirect ke halaman utama(index.php)
    } else {
        die("Gagal update data"); // program akan berhenti di file ini
    }
}
