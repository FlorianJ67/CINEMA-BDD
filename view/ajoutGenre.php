<?php ob_start(); ?>

<?php 
    session_start();
?> 

<div class='header'>
    <h3 class="uk-label uk-label-warning">Formulaire d'ajout</h3>
</div>

<div class='container'>
    <div class="formView">

            <form action="index.php?action=addGenre" method="post">
            <div class="formInput">
                <label for="nom">Nom: </label>
                <input type="text" name="name" id="nom" placeholder="nom du genre">
            </div>
                <input type="submit" name="submit">
            </form>
    </div>

    <!-- Error displayer -->
    <?php if(isset($_SESSION["error"])) {
        echo '<div id="pop up" class="error">
                <p>'. $_SESSION["error"] .'</p>
            </div>';
        $_SESSION["error"] = null;
    }
?>



</div>

<?php

$titre = "Ajout de Genre";
$titre_secondaire = "Ajout de Genre";
$contenu = ob_get_clean();
require "view/template.php";

?>