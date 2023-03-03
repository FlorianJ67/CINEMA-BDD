<?php ob_start(); ?>

<?php 
    $acteur= $requete->fetch(); 
    $filmographie= $requete2->fetchAll(); 
?>

<div class='header'>
    <h3 class="uk-label uk-label-warning"><?= $acteur["acteur"] ?></h3>
</div>

<div class='container'>
    <div class="detailView">
        <div>
            <img src="https://fr.russia.postsen.com/content/uploads/2023/02/12/fb4a0535b4.jpg" alt="photo de l'acteur <?= $acteur["acteur"] ?>">
        </div>
            <ul>
                <li>
                    <p>Sex</p>
                    <p>
                        <?php if($acteur["sex"] == "H") {
                            echo "Homme";
                        } else if($acteur["sex"] == "H") {
                            echo "Femme";
                        } else {
                            echo "Hélicoptère apache";
                        }
                        ?>
                    </p>
                </li>
                <li>
                    <p>Date de Naissance</p>
                    <p><?= $acteur["date_de_naissance"] ?></p>
                </li>
                <li>
                    <p>Filmographie</p>
                    <p><?php 
                        $i = 0;
                        $len = count($filmographie) - 1;
                        foreach($filmographie as $film) {
                                echo "<a href='index.php?action=detailFilm&id=" .  $film['id'] ."'>" . $film["titre"] . "</a>";
                                echo "<br>Role: " . $film["nom"];
                            if ($i === $len) {
                            } else {
                                echo "<br> "; 
                            $i++;
                        }

                    }?>
                    </p>
                </li>
            </ul>
    </div>

</div>

<?php

$titre = "Détail de l'Acteur";
$titre_secondaire = "Détail de l'Acteur";
$contenu = ob_get_clean();
require "view/template.php";

?>