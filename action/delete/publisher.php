<?php
require_once("../../config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];

    $query = "DELETE FROM publishers WHERE id = '$id' ";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['delete_success'] = true;
        header("Location: " . $base_url . "pages/publisher.php");
    } else {
        die("Gagal hapus data");
    }
}
