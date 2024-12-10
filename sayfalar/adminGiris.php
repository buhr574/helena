<?php
session_start();

define('ADMIN_EMAIL', 'ali@helena.com'); // Admin e-postasını buraya yazın
define('ADMIN_PASSWORD', '1234'); // Admin şifresini buraya yazın

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Admin bilgilerini kontrol et
    if ($email === ADMIN_EMAIL && $password === ADMIN_PASSWORD) {
        $_SESSION['isAdmin'] = true; // Admin oturumunu başlat
        header("Location: adminPanel.php"); // Admin paneline yönlendir
        exit();
    } else {
        $error = "Geçersiz e-posta veya şifre!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş</title>
    <link rel="stylesheet" href="../css/giris.css">
</head>

<body>
    <div class="login-container">
        <img src="../dosyalar/LogoIcon/logo.png" alt="helena">
        <h1>Admin Giriş</h1>
        <form id="login-form" action="adminGiris.php" method="POST">
            <div class="form-group">
                <label for="username">E-posta</label>
                <input type="email" id="username" name="email" placeholder="E-postanızı girin" required>
            </div>
            <div class="form-group">
                <label for="password">Şifre</label>
                <input type="password" id="password" name="password" placeholder="Şifrenizi girin" required>
            </div>
            <button type="submit">Giriş Yap</button>
            <?php if (isset($error)) : ?>
                <p id="error-message" class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>