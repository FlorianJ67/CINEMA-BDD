<?php
ob_start();
require('Service/fonction.php');

?>

<div class='header'>
    <p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> films</p>
</div>

<div class='container'>

    <table class="uk-table uk-table-striped">
        <thead>
            <tr>
                <th>TITRE</th>
                <th>RÉALISATEUR</th>
                <th>DURÉE</th>
                <th>ANNEE SORTIE</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($requete->fetchAll() as $film) { ?>
                    <tr>
                        <td><a href="index.php?action=detailFilm&id=<?= $film['filmID']?>"><?= $film['titre'] ?></a></td>
                        <td><a href="index.php?action=detailRealisateur&id=<?= $film['realID']?>"><?= $film["realisateur"] ?></a></td>
                        <td><?php ConvertMinToHour($film["duree"]) ?></td>
                        <td><?php DateFormatToEU($film["sortie"]) ?></td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";

?>
