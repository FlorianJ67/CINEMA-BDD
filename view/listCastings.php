<?php
ob_start();
require('Service/fonction.php');

?>

<div class='header'>
    <p class="uk-label uk-label-warning">Il y a <?= $listCastings->rowCount() ?> castings</p>
</div>

<div class='container'>

    <table class="uk-table uk-table-striped">
        <thead>
            <tr>
                <th>FILM</th>
                <th>ACTEUR</th>
                <th>ROLE</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($listCastings->fetchAll() as $casting) { ?>
                    <tr>
                        <td><a href="index.php?action=detailFilm&id=<?= $casting['film_id']?>"><?= $casting['film'] ?></a></td>
                        <td><a href="index.php?action=detailActeur&id=<?= $casting['acteur_id']?>"><?= $casting["acteur"] ?></a></td>
                        <td><p><?= $casting["role"] ?></p></td>
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
