<?php ob_start(); ?>

<div class='header'>
    <p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> réalisateur</p>
</div>

<div class='container'>

    <table class="uk-table uk-table-striped">
        <thead>
            <tr>
                <th>RÉALISATEUR</th>
                <th>SEX</th>
                <th>DATE DE NAISSANCE</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($requete->fetchAll() as $realisateur) { ?>
                    <tr>
                        <td><a href="index.php?action=detailRealisateur&id=<?= $realisateur['id']?>"><?= $realisateur['realisateur'] ?></a></td>
                        <td><?= $realisateur["sex"] ?></td>
                        <td><?= $realisateur["date_de_naissance"] ?></td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php

$titre = "Liste des réalisateurs";
$titre_secondaire = "Liste des réalisateurs";
$contenu = ob_get_clean();
require "view/template.php";

?>