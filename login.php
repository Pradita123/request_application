<?php 
session_start();
include 'config.php'; // Koneksi ke database
include 'navbar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mengambil data pengguna dari database
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Memeriksa apakah password cocok
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;  // Menyimpan username di session
        header("Location: index.php");  // Arahkan ke halaman utama
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body class="body-background">
    <div class="login-container">
        <div class="login-card">
            <img src="img/logo portal.png" class="logo-portal mb-5" alt="Logo Portal">
            <h2>Masukkan Kredensial Anda</h2>
            <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
            <form method="POST">
                <div class="input-container">
                    <i class="bi bi-person"></i>
                    <input type="text" class="form-control" name="username" placeholder="Masukkan Username Disini" required>
                </div>
                <div class="input-container">
                    <i class="bi bi-lock"></i>
                    <input type="password" class="form-control" name="password" placeholder="Masukkan Password Disini" required>
                </div>
                <button type="submit" class="btn login-button">Login</button>
            </form>
            <div class="divider"></div>
            <div class="register-link">
                <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
