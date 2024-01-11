<?php
include 'koneksi.php';

// Ambil peminjaman_id dari parameter URL
$peminjaman_id = $_GET['id'];

// Ambil data peminjaman berdasarkan peminjaman_id
$sql_peminjaman = "SELECT * FROM peminjaman WHERE peminjaman_id='$peminjaman_id'";
$result_peminjaman = $mysqli->query($sql_peminjaman);

// Tampilkan konfirmasi untuk menghapus data peminjaman
if ($result_peminjaman->num_rows == 1) {
    $row = $result_peminjaman->fetch_assoc();
?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Konfirmasi Hapus Data Peminjaman</title>
    </head>
    <body>
        <h2>Konfirmasi Hapus Data Peminjaman</h2>
        <p>Apakah Anda yakin ingin menghapus data peminjaman dengan ID: <?= $peminjaman_id ?>?</p>
        <form action="" method="POST">
            <input type="submit" name="delete" value="Hapus">
            <a href="peminjaman.php">Batal</a>
        </form>

        <?php
        // Proses penghapusan data setelah form disubmit
        if (isset($_POST['delete'])) {
            $sql_delete = "DELETE FROM peminjaman WHERE peminjaman_id=$peminjaman_id";
            if ($mysqli->query($sql_delete) === TRUE) {
                header("Location: peminjaman.php"); // Redirect ke tampilan awal setelah berhasil menghapus data
                exit;
            } else {
                echo "Error: " . $sql_delete . "<br>" . $mysqli->error;
            }
            $mysqli->close();
        }
        ?>
    </body>
    </html>
<?php
} else {
    echo "Data peminjaman tidak ditemukan.";
}
?>
