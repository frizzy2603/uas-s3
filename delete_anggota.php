<?php
include 'koneksi.php';

// Periksa apakah parameter id terkirim
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    $anggota_id = trim($_GET["id"]);
    
    // Persiapkan pernyataan DELETE
    $sql = "DELETE FROM anggota WHERE anggota_id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variabel ke pernyataan persiapan sebagai parameter
        $stmt->bind_param("s", $param_anggota_id);
        
        // Set parameter
        $param_anggota_id = $anggota_id;
        
        // Mencoba menjalankan pernyataan persiapan
        if($stmt->execute()){
            // Jika berhasil dihapus, redirect ke halaman anggota
            header("location: anggota.php");
            exit();
        } else{
            echo "Terjadi kesalahan. Silakan coba lagi nanti.";
        }
    }
     
    // Tutup pernyataan
    $stmt->close();
}

// Tutup koneksi
$mysqli->close();
?>
