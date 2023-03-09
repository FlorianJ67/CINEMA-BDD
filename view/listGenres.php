<?php ob_start(); ?>

<div class='header'>
    <p class="uk-label uk-label-warning">Il y a <?= $listGenres->rowCount() ?> Genres</p>
</div>

<div class='container'>

    <table class="uk-table uk-table-striped">
        <thead>
            <tr>
                <th>Nom</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($listGenres->fetchAll() as $genre) { ?>
                    <tr>
                        <td><a href="index.php?action=detailGenre&id=<?= $genre['id']?>"><?= $genre['nom'] ?></a></td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php

$titre = "Liste des Genres";
$titre_secondaire = "Liste des Genres";
$contenu = ob_get_clean();
require "view/template.php";

?>