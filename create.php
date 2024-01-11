<?php
include 'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $judul = $_POST['judul'];
 $pengarang = $_POST['pengarang'];
 $penerbit = $_POST['penerbit'];
 $tahun_terbit = $_POST['tahun_terbit'];
 $sql = "INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit) VALUES ('$judul', 
'$pengarang', '$penerbit', '$tahun_terbit')";
 
 if ($mysqli->query($sql) === TRUE) {
 header("Location: read.php"); // Redirect ke tampilan Read setelah berhasil tambah data
 exit;
 } else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
 }
 $mysqli->close();
}
?>
<form action="create.php" method="POST">
 Judul: <input type="text" name="judul"><br>
 Pengarang: <input type="text" name="pengarang"><br>
 Penerbit: <input type="text" name="penerbit"><br>
 Tahun Terbit: <input type="text" name="tahun_terbit"><br>
 <input type="submit" value="Tambah">
</form>