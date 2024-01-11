<?php
include 'koneksi.php';

// Ambil peminjaman_id dari parameter URL
$peminjaman_id = $_GET['id'];

// Ambil data peminjaman berdasarkan peminjaman_id
$sql_peminjaman = "SELECT * FROM peminjaman WHERE peminjaman_id='$peminjaman_id'";
$result_peminjaman = $mysqli->query($sql_peminjaman);

// Query untuk mengambil daftar buku dari tabel buku
$query_buku = "SELECT buku_id, judul FROM buku";
$result_buku = $mysqli->query($query_buku);

// Query untuk mengambil daftar anggota dari tabel anggota
$query_anggota = "SELECT anggota_id, nama FROM anggota";
$result_anggota = $mysqli->query($query_anggota);

// Query untuk mendapatkan nilai ENUM dari kolom 'status'
$sql_enum = "SHOW COLUMNS FROM peminjaman LIKE 'status'";
$result_enum = $mysqli->query($sql_enum);

if ($result_enum) {
    $row_enum = $result_enum->fetch_assoc();
    preg_match("/^enum\(\'(.*)\'\)$/", $row_enum['Type'], $matches);
    $enum_list = explode("','", $matches[1]); // Mendapatkan daftar ENUM

    // Tampilkan form untuk mengedit data peminjaman
    if ($result_peminjaman->num_rows == 1) {
        $row = $result_peminjaman->fetch_assoc();
?>
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <title>Edit Data Peminjaman</title>
        </head>
        <body>
            <h2>Edit Data Peminjaman</h2>
            <form action="" method="POST">
                Buku:
                <select name="buku_id">
                    <?php
                    while ($row_buku = $result_buku->fetch_assoc()) {
                        $selected_buku = ($row['buku_id'] == $row_buku['buku_id']) ? 'selected' : '';
                        echo "<option value=\"" . $row_buku['buku_id'] . "\" $selected_buku>" . $row_buku['judul'] . "</option>";
                    }
                    ?>
                </select><br>
                Anggota:
                <select name="anggota_id">
                    <?php
                    while ($row_anggota = $result_anggota->fetch_assoc()) {
                        $selected_anggota = ($row['anggota_id'] == $row_anggota['anggota_id']) ? 'selected' : '';
                        echo "<option value=\"" . $row_anggota['anggota_id'] . "\" $selected_anggota>" . $row_anggota['nama'] . "</option>";
                    }
                    ?>
                </select><br>
                Tanggal Peminjaman: <input type="date" name="tanggal_peminjaman" value="<?= $row['tanggal_peminjaman'] ?>"><br>
                Status:
                <select name="status">
                    <?php
                    foreach ($enum_list as $enum_value) {
                        $selected_status = ($row['status'] == $enum_value) ? 'selected' : '';
                        echo "<option value=\"$enum_value\" $selected_status>$enum_value</option>";
                    }
                    ?>
                </select><br>

                <input type="hidden" name="peminjaman_id" value="<?= $peminjaman_id ?>">
                <input type="submit" name="update" value="Update">
            </form>
            <br>
            <a href="peminjaman.php">Kembali ke Daftar Peminjaman</a>
        </body>
        </html>
<?php
    } else {
        echo "Data peminjaman tidak ditemukan.";
    }
} else {
    echo "Error: " . $mysqli->error;
}

// Tutup koneksi database
$mysqli->close();

// Proses pembaruan data setelah form disubmit
if (isset($_POST['update'])) {
    include 'koneksi.php';

    $buku_id = $_POST['buku_id'];
    $anggota_id = $_POST['anggota_id'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $status = $_POST['status'];

    $sql_update = "UPDATE peminjaman SET buku_id='$buku_id', anggota_id='$anggota_id', tanggal_peminjaman='$tanggal_peminjaman', status='$status' WHERE peminjaman_id=$peminjaman_id";

    if ($mysqli->query($sql_update) === TRUE) {
        header("Location: peminjaman.php"); // Redirect ke tampilan awal setelah berhasil update data
        exit;
    } else {
        echo "Error: " . $sql_update . "<br>" . $mysqli->error;
    }
    $mysqli->close();
}
?>
