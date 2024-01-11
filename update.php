<?php
include 'koneksi.php';

$id = $_GET['id'];

// cek apakah form telah disubmit untuk melakukan pembaruan data
if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];

//  pembaruan data
    $result = mysqli_query($mysqli, "UPDATE buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun_terbit' WHERE buku_id=$id");

    header("Location: read.php");
}

// ambil data buku berdasarkan ID
$sql = "SELECT * FROM buku WHERE buku_id='$id'";
$result = $mysqli->query($sql);

// tampilkan form untuk mengedit data buku
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Edit Data Buku</title>
    </head>
    <body>

        <form action="update.php?id=<?php echo $id; ?>" method="POST">
            Judul: <input type="text" name="judul" value="<?php echo $row['judul']; ?>"><br>
            Pengarang: <input type="text" name="pengarang" value="<?php echo $row['pengarang']; ?>"><br>
            Penerbit: <input type="text" name="penerbit" value="<?php echo $row['penerbit']; ?>"><br>
            Tahun Terbit: <input type="text" name="tahun_terbit" value="<?php echo $row['tahun_terbit']; ?>"><br>
            <input type="hidden" name="id" value="<?php echo $row['buku_id']; ?>">
            <input type="submit" name="update" value="Update">
        </form>

    </body>
    </html>

<?php
} else {
    echo "Data tidak ditemukan.";
}

// tutup koneksi database
$mysqli->close();
?>
