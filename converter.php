<?php
session_start();

$lang_file = 'lang/' . ($_SESSION['lang'] ?? 'pl') . '.php';
$TEXT = include($lang_file);

$inputLink = '';
$results = [];

if(isset($_POST['convert'])) {

    $inputLink = trim($_POST['link']);

    if($inputLink){

        // Szukamy itemID (zawsze liczba po itemID= lub na końcu linku)
        preg_match('/itemID=(\d+)/', $inputLink, $match);

        if(!$match){
            preg_match('/\/(\d+)/', $inputLink, $match);
        }

        $itemID = $match[1] ?? null;

        if($itemID){

            $links = [
                "kakobuy" => "https://www.kakobuy.com/item/details?url=" . urlencode("https://weidian.com/item.html?itemID=$itemID"),
                "gtbuy"   => "https://www.gtbuy.com/product/weidian/$itemID",
                "litbuy"  => "https://www.litbuy.com/product/weidian/$itemID",
                "acbuy"   => "https://www.acbuy.com/product?id=$itemID&source=WD",
                "raw"     => "https://weidian.com/item.html?itemID=$itemID"
            ];

            foreach($links as $name => $url){
                if(stripos($inputLink, $name) === false){
                    $results[$name] = $url;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Converter - noxiNReps</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'nav.php'; ?>

<main class="hero">

<div class="hero-content">

<h1 class="hero-title">Link Converter</h1>
<p class="hero-subtitle">CONVERT YOUR AGENT LINKS</p>

<form method="POST" class="converter-box">
    <input type="text" 
           name="link" 
           value="<?= htmlspecialchars($inputLink) ?>"
           placeholder="Wklej link (kakobuy, gtbuy, litbuy, acbuy)" 
           required>
    <button type="submit" name="convert" class="primary-btn">Konwertuj</button>
</form>

<?php if(!empty($results)): ?>
<div class="converter-cards">
    <?php foreach($results as $name => $url): ?>
        <a href="<?= $url ?>" target="_blank" class="converter-card">
            <img src="images/<?= $name ?>.png" alt="<?= $name ?>">
            <span><?= strtoupper($name) ?></span>
        </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>

</div>
</main>
</body>
</html>