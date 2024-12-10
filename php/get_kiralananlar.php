<?php
session_start(); // Oturum başlat

// Kullanıcı oturumu kontrol et
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(["success" => false, "message" => "Kullanıcı oturumu bulunamadı."]);
    exit;
}

$kullanici_id = $_SESSION['user_id'];

include 'baglan.php';

// Kullanıcıya ait kiralanan kitapları çek
$sql = "
    SELECT 
        k.kitap_adi, 
        k.yazar, 
        k.tur, 
        r.rezervasyon_tarihi, 
        r.iade_tarihi
    FROM kitap_rezervasyonlar r
    INNER JOIN kitaplar k ON r.kitap_id = k.kitap_id
    WHERE r.kullanici_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $kullanici_id);
$stmt->execute();
$result = $stmt->get_result();

$kiralananlar = [];
while ($row = $result->fetch_assoc()) {
    $kiralananlar[] = $row;
}

// JSON formatında çıktı
header('Content-Type: application/json');
echo json_encode($kiralananlar);

$stmt->close();
$conn->close();
?>
