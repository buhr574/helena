<?php
$host = "localhost";
$dbname = "helana";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $input = json_decode(file_get_contents('php://input'), true);
    $bookId = $input['bookId'];
    $userId = 1; // Şimdilik sabit, oturum açan kullanıcı ID'sini ekleyin.

    // Kitap rezervasyonu ekle
    $stmt = $conn->prepare("INSERT INTO kitap_rezarvasyon (kitap_id, kullanici_id, rezarvasyon_tarihi, bitis_tarihi) VALUES (:book_id, :user_id, NOW(), DATE_ADD(NOW(), INTERVAL 20 DAY))");
    $stmt->bindParam(':book_id', $bookId);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();

    // Kitabın durumunu güncelle
    $updateStmt = $conn->prepare("UPDATE kitaplar SET durum = 'reserved' WHERE kitap_id = :book_id");
    $updateStmt->bindParam(':book_id', $bookId);
    $updateStmt->execute();

    echo "Kitap başarıyla rezerve edildi!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
