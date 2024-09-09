<?php
include 'db.php';

// Mengambil data kategori
$categories = $pdo->query('SELECT * FROM categories')->fetchAll(PDO::FETCH_ASSOC);

// Mengambil data artikel
$articles = $pdo->query('SELECT * FROM articles')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lauil.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <h1 style="text-align:center;">Lautan Ilmu</h1>
    <p style="text-align:center;">Menyelam dan temukan pengetahuan</p>
</head>
<body>
    <div class="container">
        <!-- Navigasi Kategori -->
        <nav>
            <h3>Menu</h3>
            <ul class="nav-categories">
                <?php foreach ($categories as $category): ?>
                    <p><a href="articles.php?category_id=<?= $category['id'] ?>"style="text-decoration:none;"><?= $category['category_name'] ?></a></p>
                <?php endforeach; ?>
            </ul>
        </nav>

        <!-- Daftar Artikel -->
        <div class="articles-list">
            <?php foreach ($articles as $article): ?>
                <div class="article-item">
                    <img src="image/lauil.com.png" alt="Thumbnail" class="article-thumb">
                    <div class="article-info">
                        <h2><a href="article_detail.php?id=<?= $article['id'] ?>"style="text-decoration:none;"><?= $article['title'] ?></a></h2>
                        <p><?= $article['content'] ?></p>
                        <span class="article-meta">100 Suka • 28 Komentar • 23 Menit yang Lalu</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
