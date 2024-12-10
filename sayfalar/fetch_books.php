<?php
$host = "localhost";
$dbname = "helana";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT kitap_id AS id, kitap_adi AS name, yazar AS author FROM kitaplar WHERE durum = 'available'");
    $stmt->execute();

    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($books);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
