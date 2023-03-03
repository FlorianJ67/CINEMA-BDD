<?php ob_start(); ?>

<?php 
    $realisateur= $requete->fetch(); 
    $filmographie= $requete2->fetchAll(); 
?>

<div class='header'>
    <h3 class="uk-label uk-label-warning"><?= $realisateur["realisateur"] ?></h3>
</div>

<div class='container'>
    <div class="detailView">
        <div>
            <img src="https://fr.russia.postsen.com/content/uploads/2023/02/12/fb4a0535b4.jpg" alt="photo du réalisateur <?= $realisateur["realisateur"] ?>">
        </div>
            <ul>
                <li>
                    <p>Sex</p>
                    <p>
                        <?php if($realisateur["sex"] == "H") {
                            echo "Homme";
                        } else if($realisateur["sex"] == "H") {
                            echo "Femme";
                        } else {
                            echo "Hélicoptère apache";
                        }
                        ?>
                    </p>
                </li>
                <li>
                    <p>Date de Naissance</p>
                    <p><?= $realisateur["date_de_naissance"] ?></p>
                </li>
                <li>
                    <p>Filmographie</p>
                    <p><?php 
                        $i = 0;
                        $len = count($filmographie) - 1;
                        foreach($filmographie as $film) {
                                echo "<a href='index.php?action=detailFilm&id=" .  $film['id'] ."'>" . $film["titre"] . "</a>";
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

$titre = "Détail du Realisateur";
$titre_secondaire = "Détail du Realisateur";
$contenu = ob_get_clean();
require "view/template.php";

?>