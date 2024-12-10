<?php
header("Content-Type: application/json");

// Veritabanı bağlantısını dahil et
include 'baglan.php';

try {
    // Kitapları veritabanından çekmek için sorgu
    $sql = "SELECT kitap_id, kitap_adi, yazar, mevcut, tur FROM kitaplar";
    $result = $conn->query($sql);

    // Eğer kitaplar varsa, JSON formatında döndür
    if ($result->num_rows > 0) {
        $kitaplar = [];
        while($row = $result->fetch_assoc()) {
            $kitaplar[] = $row;
        }
        echo json_encode($kitaplar);
    } else {
        echo json_encode(["error" => "Tabloda veri yok."]);
    }
} catch (Exception $e) {
    // Hata durumunda
    http_response_code(500);
    echo json_encode(["error" => "Veritabanından veriler alınamadı. Hata: " . $e->getMessage()]);
}
?>
