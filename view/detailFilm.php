<?php ob_start(); ?>

<?php 
    $film= $requete->fetch(); 
    $casting= $requete2->fetchAll(); 
?>

<div class='header'>
    <h3 class="uk-label uk-label-warning"><?= $film["titre"] ?></h3>
</div>

<div class='container'>
    <div class="detailView">
        <div>
            <img src="<?= $film["affiche"] ?>" alt="affiche du film <?= $film["titre"] ?>">
            <div id="note">
                <?php 
                    $note = intval($film["note"]);
                    $leftover = 5 - $note ;
                    echo str_repeat('<i class="fa-solid fa-star"></i>',$note);
                    echo str_repeat('<i class="fa-regular fa-star"></i>',$leftover); 
                ?>
            </div>
        </div>
            <ul>
                <li>
                    <p>Réalisateur</p>
                    <p><?= $film["realisateur"] ?></p>
                </li>
                <li>
                    <p>Durée</p>
                    <p><?= $film["duree"] ?> min</p>
                </li>
                <li>
                    <p>Sortie</p>
                    <p><?= $film["sortie"] ?></p>
                </li>
                <li>
                    <p>Genre</p>
                    <p><?= $film["genres"] ?></p>
                </li>
                <li>
                    <p>Casting</p>
                    <p><?php 
                        $i = 0;
                        $len = count($casting);
                        foreach($casting as $acteur) {
                            if ($i === $len - 1) {
                                echo $acteur["acteur"];
                            } else {
                                echo $acteur["acteur"] .", "; 
                            $i++;
                        }

                    }?>
                    </p>
                </li>
            </ul>
    </div>
    <div >
        <p id="synopsis"><?= $film["synopsis"] ?></p>
    </div>

</div>

<?php

$titre = "Détail du Film";
$titre_secondaire = "Détail du Film";
$contenu = ob_get_clean();
require "view/template.php";

?>