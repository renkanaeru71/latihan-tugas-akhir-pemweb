<?php
if (isset($_GET['id'])) {
    include("koneksi.php");
    session_start();

    $id = $_GET['id'];

        // Hapus data dari database
        $sql = "DELETE FROM latihan WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION["delete"] = "Data berhasil dihapus!";
            header("Location: index.php");
            exit();
        } else {
            die("Ada kesalahan saat menghapus data!");
        }
    } else {
        echo "Data tidak ditemukan!";
    }
?>