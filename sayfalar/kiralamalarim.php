<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiralanan Kitaplarım</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kiralanan Kitaplarım</h1>
        <table>
            <thead>
                <tr>
                    <th>Kitap Adı</th>
                    <th>Yazar</th>
                    <th>Tür</th>
                    <th>Alış Tarihi</th>
                    <th>İade Tarihi</th>
                </tr>
            </thead>
            <tbody id="kiralananlar-listesi">
                <!-- Kiralanan kitaplar buraya eklenecek -->
            </tbody>
        </table>
    </div>
    <script>
        // Kiralanan kitapları çek
        async function fetchKiralananlar() {
            try {
                const response = await fetch('../php/get_kiralananlar.php');
                const data = await response.json();
                const list = document.getElementById('kiralananlar-listesi');

                if (data.length === 0) {
                    list.innerHTML = '<tr><td colspan="5">Hiç kiralanan kitap yok.</td></tr>';
                } else {
                    data.forEach(item => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${item.kitap_adi}</td>
                            <td>${item.yazar}</td>
                            <td>${item.tur}</td>
                            <td>${item.rezervasyon_tarihi}</td>
                            <td>${item.iade_tarihi}</td>
                        `;
                        list.appendChild(row);
                    });
                }
            } catch (error) {
                console.error('Veriler yüklenirken hata oluştu:', error);
            }
        }

        // Sayfa yüklendiğinde kitapları çek
        document.addEventListener('DOMContentLoaded', fetchKiralananlar);
    </script>
</body>
</html>
