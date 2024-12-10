<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kitap Kiralama Sistemi</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
      }

      .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
      }

      h1 {
        text-align: center;
        color: #333;
      }

      .kitap {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: #fafafa;
      }

      .kitap button {
        padding: 5px 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
      }

      .kitap button:disabled {
        background-color: #ccc;
        cursor: not-allowed;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1>Kitap Kiralama Sistemi</h1>
      <div id="kitap-listesi">
        <!-- Kitaplar buraya dinamik olarak eklenecek -->
      </div>
    </div>
    <script>
      // Kitapları get_books.php'den çek
      async function fetchBooks() {
        try {
          const response = await fetch("../php/get_books.php");
          console.log("response geldi", response);
          const kitaplar = await response.json();
          console.log(kitaplar);
          // Kitapları listele
          const kitapListesi = document.getElementById("kitap-listesi");
          kitaplar.forEach((kitap) => {
            const kitapDiv = document.createElement("div");
            kitapDiv.classList.add("kitap");
            kitapDiv.innerHTML = `
                        <span>${kitap.kitap_adi} - ${kitap.yazar} (${
              kitap.tur
            })</span>
                        <button onclick="kirala(${
                          kitap.kitap_id
                        })" id="kirala-${kitap.kitap_id}" ${
              kitap.adet > 0 ? "" : "disabled"
            }>
                            ${kitap.adet > 0 ? "Kirala" : "Stok Yok"}
                        </button>
                    `;
            kitapListesi.appendChild(kitapDiv);
          });
        } catch (error) {
          console.error("Kitaplar yüklenirken bir hata oluştu:", error);
        }
      }

      // Kitap kirala
      function kirala(kitapId) {
        fetch("../php/kirala.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ kitap_id: kitapId }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              alert("Kitap başarıyla kiralandı!");
              disableAllButtons();
            } else {
              alert(
                data.message || "Kitap kiralanamadı. Lütfen tekrar deneyin."
              );
            }
          })
          .catch((error) => console.error("Hata:", error));
      }

      // Tüm butonları devre dışı bırak
      function disableAllButtons() {
        const buttons = document.querySelectorAll("button");
        buttons.forEach((button) => (button.disabled = true));
      }

      // Sayfa yüklendiğinde kitapları çek
      document.addEventListener("DOMContentLoaded", fetchBooks);
    </script>
  </body>
</html>
