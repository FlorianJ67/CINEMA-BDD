<?php ob_start(); ?>

<?php 
    $genre= $requete->fetch(); 
    $filmlist= $requete2->fetchAll(); 
?>

<!-- Vérifie si l'id de l'url existe -->
<?php if(isset($genre["id"])) : ?>

<div class='header'>
    <h3 class="uk-label uk-label-warning"><?= $genre["nom"] ?></h3>
</div>

<div class='container'>
    <div class="detailView">
                    <p>Liste des Films</p>
                    <ul>
                    <?php
                        foreach($filmlist as $film) {
                            echo "<li><a href='index.php?action=detailFilm&id=" . $film['id'] ."'>" . $film['titre'] . "</a></li>";
                        }
                    ?>
                    </ul>
    </div>

</div>

<!-- Message d'erreur -->
<?php else: ?>
    <div class='error container' style="border-radius: 8px; padding: 2%;">
        <p style='text-align: center; font-size: 60px'>Le Genre n'existe pas</p>
    </div>

<?php endif ?>

<?php

$titre = "Détail du Réalisateur";
$titre_secondaire = "Détail du Réalisateur";
$contenu = ob_get_clean();
require "view/template.php";

?>