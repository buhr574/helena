<?php
session_start();
if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    header("Location: adminGiris.php"); // Yetkisiz kullanıcıları giriş sayfasına yönlendir
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/adminPanel.css">
</head>

<body>
    <h1>Admin Panel</h1>
    <p>Admin olarak giriş yaptınız.</p>
    <a href="../php/adminLogout.php">Çıkış Yap</a>
</body>

</html>