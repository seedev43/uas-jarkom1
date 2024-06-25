<?php
require_once("../../config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $year = htmlspecialchars($_POST['year']);

    $query = "UPDATE publication_years SET year = '$year' WHERE id = '$id' ";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $_SESSION['update_success'] = true;
        header("Location: ../../pages/publication_year.php"); // redirect ke halaman utama(index.php)
    } else {
        die("Gagal update data"); // program akan berhenti di file ini
    }
}
