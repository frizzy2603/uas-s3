<?php
include 'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $anggota_id = $_POST['anggota_id'];
 $nama = $_POST['nama'];
 $alamat = $_POST['alamat'];
 $email = $_POST['email'];
 $telepon = $_POST['telepon'];
 $sql = "INSERT INTO anggota ( anggota_id,nama, alamat, email, telepon) VALUES ('$anggota_id','$nama', '$alamat', '$email','$telepon')";
 
 if ($mysqli->query($sql) === TRUE) {
 header("Location: anggota.php"); // Redirect ke tampilan Read setelah berhasil tambah data
 exit;
 } else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
 }
 $mysqli->close();
}
?>
<form action="create_anggota.php" method="POST">
 anggota_id: <input type="text" name="anggota_id"><br>
 Nama: <input type="text" name="nama"><br>
 Alamat: <input type="text" name="alamat"><br>
 Email: <input type="text" name="email"><br>
 Telepon: <input type="text" name="telepon"><br>
 <input type="submit" value="Tambah">
</form>