<?php 
    ob_start(); 

    require('Service/fonction.php');

    $realisateur= $requete->fetch(); 
    $filmographie= $requete2->fetchAll(); 
?>

<!-- Vérifie si l'id de l'url existe -->
<?php if(isset($realisateur["id"])) : ?>

<div class='header'>
    <h3 class="uk-label uk-label-warning"><?= $realisateur["realisateur"] ?></h3>
</div>

<div class='container'>
    <div class="detailView">
        <div>
            <img src="<?= $realisateur["portrait"] ?>" alt="affiche de l'acteur <?= $realisateur["realisateur"] ?>">
        </div>
            <ul>
                <li>
                    <p>Sex</p>
                    <p>
                        <?php if($realisateur["sex"] == "H") {
                            echo "Homme";
                        } else if($realisateur["sex"] == "F") {
                            echo "Femme";
                        } else {
                            echo "Hélicoptère apache";
                        }
                        ?>
                    </p>
                </li>
                <li>
                    <p>Date de Naissance</p>
                    <p><?php DateFormatToEU($realisateur["date_de_naissance"]) ?></p>
                </li>
                <li>
                    <p>Filmographie</p>
                    <p>
                    <?php 
                        $i = 0;
                        $len = count($filmographie) - 1;
                        foreach($filmographie as $film) {
                                echo "<a href='index.php?action=detailFilm&id=" . $film['id'] ."'>" . $film['titre'] . "</a>";
                            if ($i === $len) {
                            } else {
                                echo "<br> "; 
                            $i++;
                            }
                        }
                    ?>
                    </p>
                </li>
            </ul>
    </div>

</div>

<!-- Message d'erreur -->
<?php else: ?>
    <div class='error container' style="border-radius: 8px; padding: 2%;">
        <p style='text-align: center; font-size: 60px'>Le Réalisateur n'existe pas</p>
    </div>

<?php endif ?>

<?php

$titre = "Détail du Réalisateur";
$titre_secondaire = "Détail du Réalisateur";
$contenu = ob_get_clean();
require "view/template.php";

?>