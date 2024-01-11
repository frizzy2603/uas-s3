<?php
include 'koneksi.php';

$id = $_GET['id'];

// cek apakah form telah disubmit untuk melakukan pembaruan data
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

//  pembaruan data
    $result = mysqli_query($mysqli, "UPDATE anggota SET nama='$nama', alamat='$alamat', email='$email', telepon='$telepon' WHERE anggota_id=$id");

    header("Location: anggota.php");
}

// ambil data anggota berdasarkan ID
$sql = "SELECT * FROM anggota WHERE anggota_id='$id'";
$result = $mysqli->query($sql);

// tampilkan form untuk mengedit data anggota
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Edit Data anggota</title>
    </head>
    <body>

        <form action="" method="POST">
            nama: <input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br>
            alamat: <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>"><br>
            email: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br>
            telepon: <input type="text" name="telepon" value="<?php echo $row['telepon']; ?>"><br>
            <input type="hidden" name="id" value="<?php echo $row['anggota_id']; ?>">
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
