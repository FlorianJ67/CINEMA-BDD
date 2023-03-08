<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?= $titre ?></title>
</head>
<body>
    <header>
        <ul>
        <li>
                <a href="index.php?action=listFilms">Liste des films</a><a href="index.php?action=addFilm"><i class="fa-solid fa-circle-xmark addContent"></i></a>
        </li>
        <li>
                <a href="index.php?action=listActeurs">Liste des acteurs</a><a href="index.php?action=addActeur"><i class="fa-solid fa-circle-xmark addContent"></i></a>            
        </li>
        <li>
                <a href="index.php?action=listRealisateurs">Liste des réalisateurs</a><a href="index.php?action=addRealisateur"><i class="fa-solid fa-circle-xmark addContent"></i></a>                 
        </li>

        </ul>
    </header>
    <main>
        <div id="contenu">
            <h1 class="uk-heading-divider">PDO Cinema</h1>
            <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>
            <?= $contenu ?>
        </div>
    </main>
    <footer>

    </footer>   
</body>
</html>
