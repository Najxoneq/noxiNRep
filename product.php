<?php
include 'config.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if(!$product){
    die("Product not found");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?= $product['title'] ?></title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'nav.php'; ?>

<main class="product-page">

    <a href="browse.php" class="back-btn">← Wróć</a>

    <div class="product-single-card">

        <div class="product-single-image">
            <img src="<?= $product['image'] ?>" alt="<?= $product['title'] ?>">
        </div>

        <div class="product-single-info">
            <span class="single-category"><?= $product['category'] ?></span>
            <h2><?= $product['title'] ?></h2>
            <div class="single-price"><?= $product['price'] ?></div>

            <p class="single-description">
                <?= $product['description'] ?>
            </p>

            <div class="single-meta">
                <span>Batch: <?= $product['batch'] ?></span>
            </div>

            <div class="single-buttons">
                <?php if(!empty($product['product_link'])): ?>
    <a href="<?= htmlspecialchars($product['product_link']) ?>" 
   target="_blank" 
   class="primary-btn">
   Buy Now
</a>

<?php endif; ?>

                <a href="#" class="secondary-btn">
                    Raw Link
                </a>
            </div>
        </div>

    </div>

</main>

</body>
</html>