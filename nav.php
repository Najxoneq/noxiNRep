<?php 

// domyślny język
if(!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'pl';
}

// zmiana języka po kliknięciu
if(isset($_GET['lang']) && in_array($_GET['lang'], ['pl','en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// wczytanie pliku językowego
$lang_file = 'lang/' . $_SESSION['lang'] . '.php';
$TEXT = include($lang_file);
?>

<header>
    <div class="header-left">
        <div class="logo">noxiNReps</div>
        <div class="language-switch">
            <a href="?lang=pl"><img src="images/pl.jpg" alt="PL"></a>
            <a href="?lang=en"><img src="images/uk.jpg" alt="EN"></a>
        </div>
    </div>

    <nav class="header-center">
        <a href="index.php"><?= $TEXT['Home'] ?></a>
        <a href="converter.php"><?= $TEXT['Link Converter'] ?></a>
        <a href="browse.php"><?= $TEXT['Browse Products'] ?></a>
    </nav>

    <div class="header-right">
        <form class="search-bar" method="GET" action="browse.php">
            <input type="text" name="search" placeholder="<?= $TEXT['search_placeholder'] ?>">
        </form>
    </div>
</header>
