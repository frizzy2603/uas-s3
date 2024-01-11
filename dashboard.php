<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Jika sudah login, tampilkan halaman dashboard
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

p {
    color: #666;
}

ul {
    list-style-type: none;
    padding: 0;
}

ul li {
    margin-bottom: 10px;
}

a {
    text-decoration: none;
    color: #3498db;
    transition: color 0.3s ease;
}

a:hover {
    color: #1c87c9;
}

/* Tambahkan gaya untuk tombol logout */
.logout-btn {
    background-color: #e74c3c;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.logout-btn:hover {
    background-color: #c0392b;
}

/* Gaya untuk daftar buku */
ul.book-list {
    padding: 0;
}

ul.book-list li {
    background-color: #ecf0f1;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 8px;
}

/* Gaya untuk tautan dalam daftar buku */
ul.book-list li a {
    color: #3498db;
}

ul.book-list li a:hover {
    color: #1c87c9;
}

</style>
</head>
<body>

<h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
<p> dashboard .</p>

    <ul>
        <li><a href="read.php">daftar buku </a></li>
        <li><a href="peminjaman.php">peminjaman </a></li>
        <li><a href="anggota.php">anggota </a></li>
        <li><a href="logout.php">Logout</a></li> <!-- Tambahkan tautan logout -->

    </ul>

</body>
</html>
