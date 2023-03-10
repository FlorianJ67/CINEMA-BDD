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
                <label for="titre">Titre *</label>
                <input type="text" name="titre" id="titre" placeholder="Titre" required>
            </div>
            <div class="formInput">
                <label for="realisateur">Réalisateur *</label>
                <select name="realisateur" id="realisateur" >
                    <option value="" disabled selected>Réalisateur</option>
                    <?php
                        foreach($listRealisateur->fetchAll() as $realisateur) { 
                            echo '<option value="'. $realisateur['id'] .'">'. $realisateur['realisateurFullName'] .'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="formInput">
                <label for="duree">Durée *</label>
                <input type="number" min="0" step="1" name="duree" id="duree" placeholder="Durée" required>
            </div>
            <div class="formInput">
                <label for="sortie" name="sortie" id="sortie">Date de sortie *</label>
                <input type="date" name="sortie" id="sortie" placeholder="Sortie" required>
            </div>
            <div class="formInput">
                <label for="synopsis" name="synopsis" id="synopsisLabel">Synopsis </label>
                <textarea name="synopsis" id="synopsisInput" rows="3" placeholder="Synopsis"></textarea>
            </div>
            <div class="formInput" id="inputGenres">
                <label for="genres" name="genres[]" id="genres">Genre *</label>
                <div>
                    <div style="width: 47%;">
                        <p style="text-align: end;">Maintenir CTRL pour choix multiple</p>
                    </div>
                    <select name="genres[]" id="genres" size="" multiple required>
                        <?php
                            foreach($listGenre->fetchAll() as $genre) { 
                                echo    '<div>
                                            <option value="'. $genre['id'] .'">'. $genre['nom'] .'</option>
                                        </div>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div id="ajoutGenreInFilmSpace">

            </div>
            <div class="formInput">
                <label for="note" name="note" id="note">Note *</label>
                <div style="display: flex; align-items: flex-end; justify-content: flex-end;">
                    <input type="number" min="0" max="5" step="0.5" name="note" id="note" placeholder="Note" required style="max-width: 90%; min-width: 60%;">
                    <p>/5</p>
                </div>

            </div>
            <div class="formInput">
                <label for="affiche" name="affiche" id="affiche">Affiche *</label>
                <input type="file" name="affiche" id="affiche" accept="image/png, image/jpeg" required>
            </div>
            <input type="submit" name="submit">
        </form>
    </div>
</div>
<div id="ajoutGenreInFilm">
    <form action="index.php?action=addGenre" method="post">
        <div class="formInput">
            <label for="nom">Ajout de genre: </label>
            <input type="text" name="name" id="nom" placeholder="nom du genre" required>
        </div>
        <input style="display: none" type="text" name="action" id="action" value="<?= $_GET['action']?>">
        <input type="submit" name="submit">
    </form>
</div>

<?php

$titre = "Ajout de Film";
$titre_secondaire = "Ajout de Film";
$contenu = ob_get_clean();
require "view/template.php";

?>