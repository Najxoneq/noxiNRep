<?php
include 'config.php';

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$sql = "SELECT * FROM products WHERE 1";
$params = [];

if($search) {
    $sql .= " AND (title LIKE ? OR category LIKE ? OR batch LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if($category && $category !== 'all') {
    $sql .= " AND category = ?";
    $params[] = $category;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Products - noxiNReps</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'nav.php'; ?>


<main class="catalog">

    <div class="catalog-top">
        <h2>Catalog</h2>
        <div class="catalog-info">
            <span>Browse all categories</span>
            <span>Total products: <?= count($products) ?></span>
        </div>
    </div>

    <div class="categories">
    <?php
    $categories = ['all','hoodie','sweatpants','shorts','shoes','other stuff','electronics','socks','denim','accesories'];
    foreach($categories as $cat):
    ?>
        <a href="?category=<?= $cat ?>" 
           class="category <?= ($category === $cat || (!$category && $cat==='all')) ? 'active' : '' ?>">
            <?= ucfirst($cat) ?>
        </a>
    <?php endforeach; ?>
</div>

    <div class="catalog-search">
        <form method="GET">
            <input type="text" name="search" placeholder="Search by name..." value="<?= htmlspecialchars($search) ?>">
        </form>
    </div>

    <?php if(empty($products)): ?>
        <p class="no-products">No products found.</p>
    <?php else: ?>
        <div class="product-grid">
            <?php foreach($products as $product): ?>
                <div class="product-card" onclick="location.href='product.php?id=<?= $product['id'] ?>'">
                    <div class="product-image">
                        <img src="<?= $product['image'] ?>" alt="<?= $product['title'] ?>">
                    </div>
                    <div class="product-info">
                        <h3><?= $product['title'] ?></h3>
                        <span class="product-category"><?= $product['category'] ?></span>
                        <div class="product-price"><?= $product['price'] ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</main>


</body>
</html>