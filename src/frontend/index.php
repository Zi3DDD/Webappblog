<?php 
session_start();
require_once 'classblog.php'; 
require('classuser.php');
$_User->requireLogin(1,2);
include('header.php');
// functie blog aanroepen
$blogs = $_Blog->readBlog();

if(isset($_GET['q'])) {
    $blogs = $_Blog->zoek($_GET['q']);
}

if (isset($_GET['cat']) && $_GET['cat'] != '') {
    $blogs = $_Blog->filtercategorie($_GET['cat']);
}

if(isset($_POST['naam']) && isset($_POST['email'])) {
    $_Blog->nieuwsbrief($_POST['naam'], $_POST['email']);
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vakantie Blogs</title>
    <link rel="stylesheet" href="styles/index.css">
</head>
<div class="pagina-container">
<body>

    <header class="site-header">
        <h1><a href="index.php" style="text-decoration: none; color: inherit;">Vakantie Blogs</a></h1>
        <p>De laatste artikelen en tips</p>
    </header>

    <div class="categorie-filters">

        <form method="get" action="index.php" style="display: inline-block;">
            <input class="filter-input" placeholder="Zoeken..." type="search" id="site-search" name="q" />
            <button type="submit" class="filter-knop">Zoeken</button>
        </form>

<a href="index.php" class="filter-knop <?= empty($_GET['cat']) && empty($_GET['q']) ? 'actief' : '' ?>">Alle Hotels</a>
        <a href="index.php? cat=Bergen" class="filter-knop   <?= (isset($_GET['cat']) && $_GET['cat'] == 'Bergen') ? 'actief' : '' ?>">Bergen</a>
        <a href="index.php? cat=Zee" class="filter-knop      <?= (isset($_GET['cat']) && $_GET['cat'] == 'Zee') ? 'actief' : '' ?>">Zee</a>
        <a href="index.php? cat=Stad" class="filter-knop     <?= (isset($_GET['cat']) && $_GET['cat'] == 'Stad') ? 'actief' : '' ?>">Stad</a>
        <a href="index.php? cat=Bossen" class="filter-knop   <?= (isset($_GET['cat']) && $_GET['cat'] == 'Bossen') ? 'actief' : '' ?>">Bossen</a>
    </div>

    <main class="blog-lijst">


        <?php if (count($blogs) > 0): ?>
            <?php foreach ($blogs as $blog): ?>
                <article class="blog-kaart">
                    <div class="kaart-foto">

                    <img src="uploads/<?php echo $blog['filename']; ?>">
                    </div>
                    
                   <div class="kaart-inhoud">
                    <h2><?= /* htmlspecialchars geen code in velden kunnen invoeren */ htmlspecialchars($blog['titel']) ?></h2>
                        <p class="meta-tekst">
                            <?= date('d-m-Y', strtotime($blog['created_at'])) ?> | <?= htmlspecialchars($blog['categorie']) ?>
                        </p>
                        <p class="beschrijving">
                            <?php 
                            $korte_tekst = substr(strip_tags($blog['text']), 0, 150); 
                            echo htmlspecialchars($korte_tekst) . '...'; 
                            ?>
                        </p>
                        <a href="blog.php?id=<?= $blog['id'] ?>" class="lees-meer-knop">Lees meer</a>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Er zijn op dit moment nog geen blogs gevonden.</p>
        <?php endif; ?>

<div class="nieuwsbrief-sectie">
    <form class="nieuwsbrief-balk"method="post" action="index.php" style="display: inline-block;">
            <input class="filter-input" placeholder="Naam" type="text" id="" name="naam" />
            <input class="filter-input" type="email" placeholder="E-mail adres" name="email">
            <button class="filter-knop">Submit</button>
        </form>
        </div>

    </main>

</body>
        </div>
</html>