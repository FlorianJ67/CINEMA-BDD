<?php ob_start(); ?>

<?php 

?> 

<div class='header'>
    <h3 class="uk-label uk-label-warning">Formulaire d'ajout</h3>
</div>

<div class='container'>
    <div class="detailView">

            <form action="index.php?action=addRealisateur" method="post">
                <label for="prenom">Prenom: </label>
                <input type="text" name="firstname" id="prenom">

                <label for="nom">Nom: </label>
                <input type="text" name="name" id="nom">

                <label for="sex">Sex: </label>
                <select name="sex" id="sex">
                    <option value="H">Homme</option>
                    <option value="F">Femme</option>
                </select>

                <label for="birthday" name="birthday" id="birthday">Date de naissance: </label>
                <input type="date" name="birthday" id="birthday">

                <input type="submit" name="submit">
            </form>
    </div>
    <div >

    </div>

</div>

<?php

$titre = "Ajout d'acteur";
$titre_secondaire = "Ajout d'acteur";
$contenu = ob_get_clean();
require "view/template.php";

?>