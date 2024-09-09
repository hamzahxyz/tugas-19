<?php
include 'db.php';  // Koneksi database

// Ambil ID artikel dari URL
$article_id = $_GET['id'] ?? null;

// Periksa apakah ID artikel ada
if ($article_id) {
    // Ambil artikel berdasarkan ID
    $article = $pdo->prepare('SELECT * FROM articles WHERE id = ?');
    $article->execute([$article_id]);
    $article = $article->fetch(PDO::FETCH_ASSOC);

    // Jika artikel ditemukan
    if ($article) {
        // Ambil data kategori dari artikel (opsional, jika ingin menampilkan kategori)
        $category_id = $article['category_id'];
        $category = $pdo->prepare('SELECT * FROM categories WHERE id = ?');
        $category->execute([$category_id]);
        $category = $category->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Artikel tidak ditemukan.";
        exit;
    }
} else {
    echo "Artikel tidak dipilih.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['title']) ?></title>
    <h1 style="text-align:center;">Lautan Ilmu</h1>
    <p style="text-align:center;">Menyelam dan temukan pengetahuan</p>
    <style>
        html {
            background-color:rgb(177, 215, 235);
        }
        .container {
            display:grid;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            width: 500px;
            background-color:white;

            
        }

        .tgl {
            color:gray;
        }

        

    </style>
</head>
<body>
    <div class="container">
        <!-- Judul Artikel -->
        <h1 style="text-align:center;"><?= htmlspecialchars($article['title']) ?></h1>
    <p>
    Hari ini, Jakarta akan menjadi saksi sejarah saat Paus Fransiskus mengunjungi ibu kota dan menggelar Misa Akbar di Stadion Gelora Bung Karno (GBK).<br>
Momen langka ini tidak hanya mengundang antusiasme ribuan umat Katolik, tetapi juga menuntut perhatian khusus dari pengguna jalan di Jakarta. Agar perjalanan Anda tetap lancar, penting untuk memahami rekayasa lalu lintas yang diterapkan oleh kepolisian guna mengantisipasi kepadatan kendaraan di beberapa ruas jalan utama.
<br><p>Pada sore hari, mulai pukul 15.30 WIB, rekayasa lalu lintas akan difokuskan di sekitar kawasan Senayan. Paus Fransiskus dijadwalkan memimpin Misa Suci di GBK pada pukul 17.00 WIB, yang diperkirakan akan dihadiri oleh 80 ribu umat. Bagi pengguna jalan yang biasanya melewati area ini, sebaiknya memperhatikan beberapa perubahan rute. Misalnya, pengendara dari Selatan (Cipete) yang menuju ke Barat (Slipi) dapat melalui Jalan Kyai Maja dan Jalan Kebayoran Baru, sedangkan mereka yang datang dari Utara (Harmoni) menuju ke Selatan (Blok M) dapat melewati Jalan Medan Merdeka Barat dan Jalan KH Mas Mansyur.</p>
<br><p class="tgl">Kamis 05 September 2024</p>
    </p>

        <!-- Kembali ke Daftar Artikel -->
        <a href="index.php?category_id=<?= $category['id'] ?>" style="text-decoration:none;">Back to category>></a>
    </div>
</body>
</html>
