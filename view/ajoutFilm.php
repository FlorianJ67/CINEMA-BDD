<?php ob_start(); ?>

<?php 

?> 

<div class='header'>
    <h3 class="uk-label uk-label-warning">Formulaire d'ajout</h3>
</div>

<div class='container'>
    <div class="detailView">

            <form action="index.php?action=addFilm" method="post">
                <label for="titre">Titre: </label>
                <input type="text" name="titre" id="titre">

                <!--use select option -->
                <label for="realisateur">Réalisateur: </label>
                <input type="text" name="realisateur" id="realisateur">

                <label for="duree">Durée: </label>
                <input type="text" name="duree" id="duree">

                <label for="sortie" name="sortie" id="sortie">Date de sortie: </label>
                <input type="date" name="sortie" id="sortie">

                <label for="synopsis" name="synopsis" id="synopsis">Synopsis: </label>
                <input type="text" name="synopsis" id="synopsis">

                <label for="sortie" name="sortie" id="sortie">Date de sortie: </label>
                <input type="date" name="sortie" id="sortie">

                <label for="sortie" name="sortie" id="sortie">Date de sortie: </label>
                <input type="date" name="sortie" id="sortie">

                <input type="submit" name="submit">
            </form>
    </div>
    <div >

    </div>

</div>

<?php

$titre = "Ajout de Film";
$titre_secondaire = "Ajout de Film";
$contenu = ob_get_clean();
require "view/template.php";

?>