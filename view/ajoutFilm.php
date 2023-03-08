<?php ob_start(); ?>

<?php 

?> 

<div class='header'>
    <h3 class="uk-label uk-label-warning">Formulaire d'ajout</h3>
</div>

<div class='container'>
    <div class="formView">

            <form action="index.php?action=addFilm" method="post" enctype= "multipart/form-data">
            <div class="formInput">
                <label for="titre">Titre: </label>
                <input type="text" name="titre" id="titre">
            </div>
            <div class="formInput">
                <!--use select option -->
                <label for="realisateur">Réalisateur: </label>
                <select name="realisateur" id="realisateur">
                    <?php
                        foreach($listRealisateur->fetchAll() as $realisateur) { 
                            echo '<option value="'. $realisateur['id'] .'">'. $realisateur['realisateurFullName'] .'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="formInput">
                <label for="duree">Durée: </label>
                <input type="int" name="duree" id="duree">
            </div>
            <div class="formInput">
                <label for="sortie" name="sortie" id="sortie">Date de sortie: </label>
                <input type="date" name="sortie" id="sortie">
            </div>
            <div class="formInput">
                <label for="synopsis" name="synopsis" id="synopsisLabel">Synopsis: </label>
                <textarea name="synopsis" id="synopsisInput" rows="3"></textarea>
            </div>
            <div class="formInput" id="inputGenres">
                <label for="genres" name="genres[]" id="genres">Genre: </label>
                <div>
                    <div>
                        <p>Maintenir CTRL pour choix multiple</p>
                    </div>
                    <select name="genres[]" id="genres" multiple>
                        <?php
                            foreach($listGenre->fetchAll() as $genre) { 
                                echo '<div>
                                        <option value="'. $genre['id'] .'">'. $genre['nom'] .'</option>
                                    </div>';
                            }
                        ?>
                    </select>
                </div>

            </div>
            <div class="formInput">
                <label for="note" name="note" id="note">Note: </label>
                <input type="int" name="note" id="note">
            </div>
            <div class="formInput">
                <label for="affiche" name="affiche" id="affiche">Affiche: </label>
                <input type="file" name="affiche" id="affiche" accept="image/png, image/jpeg">
            </div>
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