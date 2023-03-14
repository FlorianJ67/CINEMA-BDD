<?php 
    ob_start(); 

    require('Service/fonction.php');

    $film= $requete->fetch(); 
    $casting= $requete2->fetchAll(); 
?>

<!-- Vérifie si l'id de l'url existe -->
<?php if(isset($film["id"])) : ?>

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
                    $floatNote = floatval($film["note"]);

                    $leftover = 5 - $note ;
                    if ($note != $floatNote) {
                        echo str_repeat('<i class="fa-solid fa-star"></i>',ceil($note));
                        echo '  <i class="fa-solid fa-star" aria-hidden="true" style=" clip-path: polygon(50% 0%, 50% 100%, 0% 100%, 0% 0%);"></i>
                                <i class="fa-regular fa-star" aria-hidden="true" style=" clip-path: polygon(50% 100%, 50% 0%, 100% 0%, 100% 100%); position: relative; left: -31.9px;"></i>';
                        echo str_repeat('<i class="fa-regular fa-star" style="position: relative; left: -31.9px;"></i>',floor($leftover)-1);
                    } else {
                        echo str_repeat('<i class="fa-solid fa-star"></i>',$note);
                        echo str_repeat('<i class="fa-regular fa-star"></i>',$leftover); 
                    }

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
                    <p><?php ConvertMinToHour($film["duree"]) ?></p>
                </li>
                <li>
                    <p>Sortie</p>
                    <p><?php DateFormatToEU($film["sortie"]) ?></p>
                </li>
                <li>
                    <p>Genre</p>
                    <p><?= $film["genres"] ?></p>
                </li>
                <li>
                    <p>Casting</p>
                    <p class="castingFilm">
                    <?php 
                        $i = 0;
                        $len = count($casting) - 1;
                        foreach($casting as $acteur) {
                            echo "<a href='index.php?action=detailActeur&id=" .  $acteur['id'] ."'>" . $acteur["acteur"] . "</a>";
                            if ($i === $len) {
                            } else {
                                echo ", "; 
                            }
                            $i++;
                        }
                    ?>
                    </p>
                </li>
            </ul>
    </div>
    <div >
        <p id="synopsis"><?= $film["synopsis"] ?></p>
    </div>

</div>

<!-- Message d'erreur -->
<?php else: ?>

    <div class='error container' style="border-radius: 8px; padding: 2%;">
        <p style='text-align: center; font-size: 60px'>Le Film n'existe pas</p>
    </div>

<?php endif ?>

<?php

$titre = "Détail du Film";
$titre_secondaire = "Détail du Film";
$contenu = ob_get_clean();
require "view/template.php";

?>