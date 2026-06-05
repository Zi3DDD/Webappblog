<?php
session_start();
require('classblog.php');
require_once('classuser.php');
$_User->requireLogin(2,2);
include('header.php');

$blog_id = $_GET['id'] ?? 0; 
$blog = null;
// Zoek de juiste blog in de lijst
foreach ($_Blog->readBlog(100, 0) as $b) {
    if ($b['id'] == $blog_id) $blog = $b;
}

// Geen blog gevonden terug naar index.
if (!$blog) { header("Location: index.php"); exit; }
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($blog['titel']) ?> - Mijn Blog</title>
    <link rel="stylesheet" href="styles/blog.css">
</head>
<body>

    <header class="blog-header">
        <h1><a href="index.php" style="text-decoration: none; color: inherit;">Vakantie Blogs</a></h1>
        <p>De laatste artikelen en tips</p>
    </header>

    <main class="artikel-container">
        <a href="index.php" class="terug-knop">&larr; Terug naar overzicht</a>
        
        <article class="volledig-artikel">
            <h1 class="artikel-titel"><?= htmlspecialchars($blog['titel']) ?></h1>
            
        <p class="meta-tekst">
                <?= date('d-m-Y', strtotime($blog['created_at'])) ?> | <?= htmlspecialchars($blog['categorie']) ?>
            </p>
            
            <img src="uploads/<?= htmlspecialchars($blog['filename']) ?>" alt="<?= htmlspecialchars($blog['titel']) ?>" class="artikel-hoofdfoto">
            
            <div class="artikel-tekst">
                <?= nl2br(htmlspecialchars($blog['text'])) ?>
            </div>

    <div class="delen-opties">
        <h3>Deel dit artikel</h3>
            <a href="#" class="deel-knop">Facebook</a>
        <a href="#" class="deel-knop">Instagram</a>
        <a href="#" class="deel-knop">Tiktok</a> 
            <a href="blog.php?id=<?= $blog['id'] ?>" class="deel-knop">Kopieer link</a>
        </div>               

            <section class="reactie-sectie">
                <h3>Reacties</h3>
                <p>Er zijn nog geen reacties voor dit bericht.</p>

            <div class="reactie-formulier-container">
                <h4>Laat een reactie achter</h4>
                <form action="#" method="POST" class="reactie-formulier">
                        <label for="naam">Naam:</label>
                        <input type="text" id="naam" name="naam" required placeholder="Jouw naam">

                        <label for="bericht">Reactie:</label>
                        <textarea id="bericht" name="bericht" rows="4" required placeholder="Schrijf hier je reactie..."></textarea>

                        <button type="submit" class="verstuur-knop">Plaats reactie</button>
                    </form>
                </div>
            </section>
        </article>
    </main>

</body>
</html>


