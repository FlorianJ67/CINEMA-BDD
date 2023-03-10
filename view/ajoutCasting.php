<?php ob_start(); ?>

<?php 



?> 

<div class='header'>
    <h3 class="uk-label uk-label-warning">Formulaire d'ajout</h3>
</div>

<div class='container'>
    <div class="formView">

        <form action="index.php?action=addCasting" method="post" >
            <div class="formInput">
                <label for="film">Film *</label>
                <select name="film" id="film" >
                    <option value="" disabled selected>Film</option>
                    <?php
                        foreach($listFilm->fetchAll() as $film) { 
                            echo '<option value="'. $film['id'] .'">'. $film['titre'] .'</option>';
                        }
                        ?>
                </select>
            </div>
            <div class="formInput">
                <label for="acteur">Acteur *</label>
                <select name="acteur" id="acteur" >
                    <option value="" disabled selected>Acteur</option>
                    <?php
                        foreach($listActeur->fetchAll() as $acteur) { 
                            echo '<option value="'. $acteur['id'] .'">'. $acteur['acteur'] .'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="formInput">
                <label for="role">Role *</label>
                <select name="role" id="role" >
                    <option value="" disabled selected>Role</option>
                    <?php
                        foreach($listActeur->fetchAll() as $role) { 
                            echo '<option value="'. $role['id'] .'">'. $role['nom'] .'</option>';
                        }
                    ?>
                </select>
            </div>
            

            <input type="submit" name="submit">
        </form>
    </div>

</div>

<?php

$titre = "Ajout casting";
$titre_secondaire = "Ajout casting";
$contenu = ob_get_clean();
require "view/template.php";

?>