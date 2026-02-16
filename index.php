<?php
session_start();

if(!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'pl';
}

if(isset($_GET['lang']) && in_array($_GET['lang'], ['pl','en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang_file = 'lang/' . $_SESSION['lang'] . '.php';
$TEXT = include($lang_file);
?>

<?php
include 'config.php';

// Pobierz wszystkie produkty
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>noxiNReps</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'nav.php'; ?>

<main class="hero">

    <div class="hero-content">
        
        <h1 class="hero-title">noxiNReps</h1>
        <p class="hero-subtitle">
    <?= $TEXT['hero_subtitle'] ?>
</p>


        <p class="hero-description">
    <?= $TEXT['hero_description'] ?>
</p>


        <a href="browse.php" class="primary-btn">
    <?= $TEXT['browse_button'] ?>
</a>

    </div>

    <div class="cards">

    <a href="https://ikako.vip/r/q5nr4">
        <div class="card">
        <div class="card-tag"><?= $TEXT['card2_tag'] ?></div>
        <h3><?= $TEXT['card2_title'] ?></h3>
        <p><?= $TEXT['card2_desc'] ?></p>
    </div>
    </a>

    <a href="converter.php" class="card-link">
    <div class="card">
        <div class="card-tag"><?= $TEXT['card3_tag'] ?></div>
        <h3><?= $TEXT['card3_title'] ?></h3>
        <p><?= $TEXT['card3_desc'] ?></p>
    </div>
    </a>

    <a href="">
        <div class="card">
        <div class="card-tag"><?= $TEXT['card4_tag'] ?></div>
        <h3><?= $TEXT['card4_title'] ?></h3>
        <p><?= $TEXT['card4_desc'] ?></p>
    </div>
    </a>

    
</div>


</main>


</body>
</html>