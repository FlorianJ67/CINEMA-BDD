<?php ob_start(); ?>

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
                        <td><a href="index.php?action=detailFilm&id=<?= $film['id']?>"><?= $film['titre'] ?></a></td>
                        <td><?= $film["realisateur"] ?></td>
                        <td><?= $film["duree"] ?> min</td>
                        <td><?= $film["sortie"] ?></td>
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
