<?php 
ob_start();
require('Service/fonction.php');

?>

<div class='header'>
    <p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> Acteurs</p>
</div>

<div class='container'>

    <table class="uk-table uk-table-striped">
        <thead>
            <tr>
                <th>Acteur</th>
                <th>Date de naissance</th>
                <th>Sex</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($requete->fetchAll() as $acteur) { ?>
                    <tr>
                        <td><a href="index.php?action=detailActeur&id=<?= $acteur['id']?>"><?= $acteur['acteur'] ?></a></td>
                        <td><?php DateFormatToEU($acteur["date_de_naissance"]) ?></td>
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