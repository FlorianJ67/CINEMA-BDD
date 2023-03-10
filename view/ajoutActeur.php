<?php ob_start(); ?>

<?php 

?> 

<div class='header'>
    <h3 class="uk-label uk-label-warning">Formulaire d'ajout</h3>
</div>

<div class='container'>
    <div class="formView">

        <form action="index.php?action=addActeur" method="post" enctype= "multipart/form-data">
            <div class="formInput">
                <label for="prenom">Prenom *</label>
                <input type="text" name="firstname" id="prenom" placeholder="Prenom" required>
            </div>
            <div class="formInput">
                <label for="nom">Nom *</label>
                <input type="text" name="name" id="nom" placeholder="Nom" required>
            </div>
            <div class="formInput">
                <label for="sex">Sex *</label>
                <select name="sex" id="sex" required>
                    <option value="H">Homme</option>
                    <option value="F">Femme</option>
                </select>
            </div>
            <div class="formInput">
                <label for="birthday" name="birthday" id="birthday">Date de naissance *</label>
                <input type="date" name="birthday" id="birthday" required>
            </div>
            <div class="formInput">
                <label for="portrait" name="portrait" id="portrait">Portrait *</label>
                <input type="file" name="portrait" id="portrait" accept="image/png, image/jpeg" required>
            </div>

            <input type="submit" name="submit">
        </form>
    </div>

</div>

<?php

$titre = "Ajout d'Acteur";
$titre_secondaire = "Ajout d'Acteur";
$contenu = ob_get_clean();
require "view/template.php";

?>