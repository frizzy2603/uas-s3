<?php
include 'koneksi.php';
$sql = "SELECT * FROM buku";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
 echo "<table border='1'>";
 echo "<tr><th>ID</th><th>Judul</th><th>Pengarang</th><th>Penerbit</th><th>Tahun
Terbit</th><th>Action</th></tr>";
 while ($row = $result->fetch_assoc()) {
 echo "<tr>";
 echo "<td>".$row["buku_id"]."</td>";
 echo "<td>".$row["judul"]."</td>";
 echo "<td>".$row["pengarang"]."</td>";
 echo "<td>".$row["penerbit"]."</td>";
 echo "<td>".$row["tahun_terbit"]."</td>";
 echo "<td><a href='update.php?id=".$row["buku_id"]."'>Edit</a> |
<a href='delete.php?id=".$row["buku_id"]."'>Hapus</a></td>";
 echo "</tr>";
 }
 echo "</table>";
} else {
 echo "Tidak ada data buku.";
}
$mysqli->close();
?><br>

<a href="create.php">Tambah</a>
