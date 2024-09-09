<?php
include 'db.php';  // Koneksi database

// Ambil ID kategori dari URL
$category_id = $_GET['category_id'] ?? null;

// Periksa apakah ID kategori ada
if ($category_id) {
    // Ambil kategori berdasarkan ID
    $category = $pdo->prepare('SELECT * FROM categories WHERE id = ?');
    $category->execute([$category_id]);
    $category = $category->fetch(PDO::FETCH_ASSOC);

    // Jika kategori ditemukan
    if ($category) {
        // Ambil artikel yang terkait dengan kategori
        $articles = $pdo->prepare('SELECT * FROM articles WHERE category_id = ?');
        $articles->execute([$category_id]);
        $articles = $articles->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Kategori tidak ditemukan.";
        exit;
    }
} else {
    echo "Kategori tidak dipilih.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles in <?= htmlspecialchars($category['category_name']) ?></title>
    <style>
        .container {
            display: grid;
            max-width: px;
            margin: 0 auto;
            padding: 20px;
            background-color: #b1d7eb;
            nav {
            width: 100%;
}

.nav-categories {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-categories li {
    margin-bottom: 10px;
}

.articles-list {
    width: 70%;
}

.article-item {
    display: flex;
    margin-bottom: 20px;
    padding: 10px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.article-thumb {
    width: 150px;
    height: 100px;
    margin-right: 20px;
    object-fit: cover;
    border-radius: 8px;
}

.article-info {
    flex: 1;
}
        }

    </style>
</head>
<body>
    <div class="container">
        <!-- Judul Kategori -->
        <h1><?= htmlspecialchars($category['category_name']) ?></h1>

        <!-- Daftar Artikel Berdasarkan Kategori -->
        <div class="articles-list"><br><br>
            <?php if ($articles): ?>
                <?php foreach ($articles as $article): ?>
                    <div class="article-item">
                        <img src="https://media.suara.com/pictures/970x544/2022/09/30/94653-paus-fransiskus-penguasa-vatikan.jpg" alt="Thumbnail" class="article-thumb">
                        <div class="article-info">
                            <h2><a href="article_detail.php?id=<?= $article['id'] ?>"style="text-decoration:none;"><?= htmlspecialchars($article['title']) ?></a></h2>
                            <p><?= substr(htmlspecialchars($article['content']), 0, 100) ?>...</p>  <!-- Menampilkan potongan artikel -->
                            <span class="article-meta">1020 Suka • 261 Komentar • 23 Menit yang Lalu</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No articles found in this category.</p>
            <?php endif; ?>
        </div>

        <!-- Kembali ke Beranda -->
        <button><a href="index.php" style="text-decoration:none;">Back to all categories</a></button>
    </div>
</body>
</html>
