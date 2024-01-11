<?php
include 'koneksi.php';
$sql = "SELECT * FROM peminjaman";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
 echo "<table border='1'>";
 echo "<tr><th>ID</th><th>peminjaman_id</th><th>judul_id</th><th>anggota_id</th><th>tanggal_peminjaman</th><th>Action</th></tr>";
 while ($row = $result->fetch_assoc()) {
 echo "<tr>";
 echo "<td>".$row["peminjaman_id"]."</td>";
 echo "<td>".$row["buku_id"]."</td>";
 echo "<td>".$row["anggota_id"]."</td>";
 echo "<td>".$row["tanggal_peminjaman"]."</td>";
 echo "<td>".$row["status"]."</td>";
 echo "<td><a href='update_peminjaman.php?id=".$row["peminjaman_id"]."'>Edit</a> |
<a href='delete_peminjaman.php?id=".$row["peminjaman_id"]."'>Hapus</a></td>";
 echo "</tr>";
 }
 echo "</table>";
} else {
 echo "Tidak ada data peminjaman.";
}
$mysqli->close();
?><br>

<a href="create_peminjaman.php">Tambah</a>
