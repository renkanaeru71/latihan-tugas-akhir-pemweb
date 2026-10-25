<?php
include("koneksi.php");
session_start();

if (!isset($_GET['id'])) {
    echo "<h3>Data tidak ditemukan</h3>";
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM product WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<h3>Data tidak ditemukan</h3>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Edit Data</title>
</head>
<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Edit Data</h1>
            <div><a href="index.php" class="btn btn-primary">Kembali</a></div>
        </header>
        
        <form action="process.php" method="post" enctype="multipart/form-data">
            <div class="form-group my-3">
                <label>Nama:</label>
                <input type="text" class="form-control" name="nama" value="<?= $row['name'] ?>" required>
            </div>

            <div class="form-group my-3">
                <label>Kategori:</label>
                <select name="category" class="form-control" required>
                    <option value="makanan" <?= $row['category'] == "Makanan" ? "selected" : "" ?>>Makanan</option>
                    <option value="minuman" <?= $row['category'] == "Minuman" ? "selected" : "" ?>>Minuman</option>
                </select>
            </div>

            <div class="form-group my-3">
                <label>Price:</label>
                <textarea name="Masukkan Harga" class="form-control" required><?= $row['price'] ?></textarea>
            </div>

            <div class="form-group my-3">
                <label>Stok:</label>
                <textarea name="Masukkan Jumlah Stok" class="form-control" required><?= $row['stock'] ?></textarea>
            </div>
            </div>

            <div class="form-group my-3">
                <input type="submit" name="edit" value="Edit Database" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>