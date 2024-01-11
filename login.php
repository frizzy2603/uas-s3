<?php
session_start();

// Koneksi ke database
$host = "localhost"; // Ganti dengan host database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$database = "perpustakaan"; // Ganti dengan nama database Anda

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi untuk memeriksa login
function check_login($conn, $username, $password)
{
    // Lindungi dari serangan SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query untuk mencari pengguna dengan username dan password yang sesuai
    $query = "SELECT * FROM users WHERE username='$username' AND password=MD5('$password')";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        return true; // Login berhasil
    } else {
        return false; // Login gagal
    }
}

// Proses login jika formulir dikirim
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (check_login($conn, $username, $password)) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // Ganti dengan halaman setelah login berhasil
    } else {
        echo "Login gagal. Periksa kembali username dan password Anda.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<h2>Login Form</h2>
<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" name="submit" value="Login">
</form>

</body>
</html>
