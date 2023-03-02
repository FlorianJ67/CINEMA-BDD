<?php ob_start(); ?>

<div class='tableHeader'>
    <p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> Acteurs</p>
</div>

<div class='tableContainer'>

    <table class="uk-table uk-table-striped">
        <thead>
            <tr>
                <th>Acteur</th>
                <th>Sex</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($requete->fetchAll() as $acteur) { ?>
                    <tr>
                        <td><?= $acteur["acteur"] ?></td>
                        <td><?= $acteur["sex"] ?></td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "view/template.php";

?>