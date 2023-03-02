<?php ob_start(); ?>

<div class='tableHeader'>
    <p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> films</p>
</div>

<div class='tableContainer'>

    <table class="uk-table uk-table-striped">
        <thead>
            <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($requete->fetchAll() as $film) { ?>
                    <tr>
                        <td><?= $film["titre"] ?></td>
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
