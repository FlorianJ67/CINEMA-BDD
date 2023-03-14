<?php

namespace Controller;
use Model\Connect;

class CinemaController {


/*
**  Liste:
*/

    public function listFilms() {
        
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT film.id AS filmID, titre, realisateur.id as realID, CONCAT(realisateur.nom, ' ',realisateur.prenom) AS 'realisateur', duree, sortie
            FROM film   
            INNER JOIN realisateur ON realisateur.id = realisateur_id
            ORDER BY film.titre    
        ");
        require "view/listFilms.php";
    }

    public function listActeurs() {
        
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT acteur.id, CONCAT(nom,' ',prenom) AS 'acteur', date_de_naissance, sex
            FROM acteur 
            ORDER BY acteur.nom       
        ");
      
        require "view/listActeurs.php";
    }

    public function listRealisateurs() {
        
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT realisateur.id, CONCAT(nom,' ',prenom) AS 'realisateur', date_de_naissance, sex
            FROM realisateur
            ORDER BY realisateur.nom    
        ");
      
        require "view/listRealisateurs.php";
    }

    public function listGenres() {
        
        $pdo = Connect::seConnecter();
        $listGenres = $pdo->prepare("
            SELECT DISTINCT genre.id, genre.nom
            FROM genre 
            ORDER BY genre.nom DESC  
        ");
        $listGenres->execute();

        require "view/listGenres.php";
    }

/*
**  Détail:
*/

    public function detailFilm($id) {
        
        //Connexion à la base de donnée
        $pdo = Connect::seConnecter();
        //Préparation de la requete SQL
        $requete = $pdo->prepare("
            SELECT film.id, titre, CONCAT(realisateur.nom, ' ',realisateur.prenom) AS 'realisateur', duree, sortie, note, affiche, synopsis, GROUP_CONCAT(CONCAT(UCASE(LEFT(genre.nom,1)),LCASE(SUBSTRING(genre.nom,2))) SEPARATOR ', ' ) as genres
            FROM film   
            INNER JOIN realisateur ON realisateur.id = realisateur_id  
            INNER JOIN filmGenre ON film.id = filmGenre.film_id  
            INNER JOIN genre ON genre.id = genre_id
            WHERE film.id = :id   
        ");
        //Exécution de la requete SQL
        $requete->execute(["id" => $id]);

        //Préparation de la requete SQL
        $requete2 = $pdo->prepare("
            SELECT acteur.id, CONCAT(acteur.nom, ' ',acteur.prenom) AS 'acteur'
            FROM film   
            INNER JOIN casting ON film.id = film_id   
            INNER JOIN acteur ON acteur.id = acteur_id   
            WHERE film.id = :id   
        ");
        //Exécution de la requete SQL
        $requete2->execute(["id" => $id]);

        require "view/detailFilm.php";
    }

    public function detailActeur($id) {
        
        $pdo = Connect::seConnecter();
        //Préparation de la requete SQL
        $requete = $pdo->prepare("
            SELECT id, CONCAT(acteur.nom, ' ',acteur.prenom) AS 'acteur', sex, date_de_naissance, acteur.portrait
            FROM acteur 
            WHERE acteur.id = :id   
        ");
        //Exécution de la requete SQL
        $requete->execute(["id" => $id]);

        //Préparation de la requete SQL
        $requete2 = $pdo->prepare("
            SELECT film.id, film.titre, role.nom
            FROM film   
            INNER JOIN casting ON film.id = casting.film_id  
            INNER JOIN acteur ON acteur.id = casting.acteur_id  
            INNER JOIN role ON role.id = casting.role_id   
            WHERE acteur.id = :id   
        ");
        //Exécution de la requete SQL
        $requete2->execute(["id" => $id]);

        require "view/detailActeur.php";
    }

    public function detailRealisateur($id) {
        
        $pdo = Connect::seConnecter();
        //Préparation de la requete SQL
        $requete = $pdo->prepare("
            SELECT id, CONCAT(realisateur.nom, ' ',realisateur.prenom) AS 'realisateur', sex, date_de_naissance, realisateur.portrait
            FROM realisateur
            WHERE realisateur.id = :id   
        ");
        //Exécution de la requete SQL
        $requete->execute(["id" => $id]);

        //Préparation de la requete SQL
        $requete2 = $pdo->prepare("
            SELECT DISTINCT film.id, film.titre
            FROM film   
            WHERE realisateur_id = :id   
        ");
        //Exécution de la requete SQL
        $requete2->execute(["id" => $id]);

        require "view/detailRealisateur.php";
    }

    public function detailGenre($id) {
        
        $pdo = Connect::seConnecter();
        //Préparation de la requete SQL
        $requete = $pdo->prepare("
            SELECT id, genre.nom
            FROM genre
            WHERE genre.id = :id   
        ");
        //Exécution de la requete SQL
        $requete->execute(["id" => $id]);

        //Préparation de la requete SQL
        $requete2 = $pdo->prepare("
            SELECT DISTINCT film.id, film.titre
            FROM film   
            INNER JOIN filmgenre ON film.id = film_id
            WHERE genre_id = :id   
        ");
        //Exécution de la requete SQL
        $requete2->execute(["id" => $id]);

        require "view/detailGenre.php";
    }

/*
**  Ajout:
*/

    //Acteur
    public function addActeur() {

        if(isset($_POST['submit'])){
        
            //prenom
            $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //nom
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //sex
            $sex = filter_input(INPUT_POST, "sex", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //date de naissance
            $birthday = filter_input(INPUT_POST, "birthday", FILTER_SANITIZE_SPECIAL_CHARS);
            $datetime = new \DateTime($birthday);
            $birthday = $datetime->format('Y-m-d');

          
            if($firstname && $name && $sex && $birthday){
                $pdo = Connect::seConnecter();

                //Upload de l'image dans public/img
                if(isset($_FILES['portrait'])){
                    $tmpName = $_FILES['portrait']['tmp_name'];
                    $name = $_FILES['portrait']['name'];
                    $size = $_FILES['portrait']['size'];
                    $error = $_FILES['portrait']['error'];

                    //UpLoad + chemain de l'upLoad
                    move_uploaded_file($tmpName, './public/img/'.$name);

                    //Chemain vers portrait
                    $portrait = "public/img/".$name;
                }

                //Préparation de la requete SQL
                $ajoutActeur = $pdo->prepare("
                    INSERT INTO acteur (prenom, nom, sex, date_de_naissance, acteur.portrait)
                        VALUES (:firstname, :name, :sex, :birthday, :portrait)  
                ");
                //Exécution de la requete SQL
                $ajoutActeur->execute([
                    ":firstname" => ucfirst($firstname),
                    ":name" => ucfirst($name),
                    ":sex" => $sex,
                    ":birthday" => $birthday,
                    ":portrait" => $portrait           
                ]);
                header("Location:index.php?action=listActeurs");
                die();
            }
        }

        require "view/ajoutActeur.php";
    }

    //Réalisateur
    public function addRealisateur() {

        if(isset($_POST['submit'])){
        
            //prenom
            $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //nom
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //sex
            $sex = filter_input(INPUT_POST, "sex", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //date de naissance
            $birthday = filter_input(INPUT_POST, "birthday", FILTER_SANITIZE_SPECIAL_CHARS);
            $datetime = new \DateTime($birthday);
            $birthday = $datetime->format('Y-m-d');

          
            if($firstname && $name && $sex && $birthday){
                $pdo = Connect::seConnecter();

                //Upload de l'image dans public/img
                if(isset($_FILES['portrait'])){
                    $tmpName = $_FILES['portrait']['tmp_name'];
                    $name = $_FILES['portrait']['name'];
                    $size = $_FILES['portrait']['size'];
                    $error = $_FILES['portrait']['error'];

                    //UpLoad + chemain de l'upLoad
                    move_uploaded_file($tmpName, './public/img/'.$name);

                    //Chemain vers portrait
                    $portrait = "public/img/".$name;
                }

                //Préparation de la requete SQL
                $ajoutRealisateur = $pdo->prepare("
                    INSERT INTO realisateur (prenom, nom, sex, date_de_naissance, realisateur.portrait)
                        VALUES (:firstname, :name, :sex, :birthday, :portrait)  
                ");
                //Exécution de la requete SQL
                $ajoutRealisateur->execute([
                    ":firstname" => ucfirst($firstname),
                    ":name" => ucfirst($name),
                    ":sex" => $sex,
                    ":birthday" => $birthday,
                    ":portrait" => $portrait            
                ]);
                header("Location:index.php?action=listRealisateurs");
                die();
            }
        }

        require "view/ajoutRealisateur.php";
    }

    //Film
    public function addFilm() {

        $pdo = Connect::seConnecter();

        //Liste des réalisateurs pour input>select
        //Préparation de la requete SQL
        $listRealisateur = $pdo->prepare("
            SELECT DISTINCT realisateur.id, CONCAT(realisateur.prenom, ' ', realisateur.nom) as realisateurFullName, realisateur.nom 
            FROM realisateur
            ORDER BY realisateur.nom 
        ");
        //Exécution de la requete SQL
        $listRealisateur->execute();

        //liste des genres pour input>checkbox
        //Préparation de la requete SQL
        $listGenre = $pdo->prepare("
            SELECT DISTINCT genre.id, genre.nom
            FROM genre 
            ORDER BY genre.nom DESC  
        ");
        //Exécution de la requete SQL
        $listGenre->execute();

        //Post
        if(isset($_POST['submit'])){
            //titre
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //realisateur
            $realisateur = filter_input(INPUT_POST, "realisateur", FILTER_SANITIZE_NUMBER_INT);
            //duree
            $duree = filter_input(INPUT_POST, "duree", FILTER_SANITIZE_NUMBER_INT);
            //date de sortie
            $sortie = filter_input(INPUT_POST, "sortie", FILTER_SANITIZE_SPECIAL_CHARS);
            $datetime = new \DateTime($sortie);
            $sortie = $datetime->format('Y-m-d');
            //synopsis
            $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //genre
            $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_NUMBER_INT);
            //note
            if($_POST['submit']['note'] <= 5 && $_POST['submit']['note'] >= 0 && is_int($_POST['submit']['note']*2) ){
                $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_NUMBER_FLOAT);
            }

            //genre (tableau)
            $genres = filter_input(INPUT_POST, "genres" , FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

            if($titre && $realisateur && $duree && $sortie && $synopsis && $note && $genres){

            //Upload de l'image dans public/img
            if(isset($_FILES['affiche'])){
                $tmpName = $_FILES['affiche']['tmp_name'];
                $name = $_FILES['affiche']['name'];
                $size = $_FILES['affiche']['size'];
                $error = $_FILES['affiche']['error'];

                //UpLoad + chemain de l'upLoad
                move_uploaded_file($tmpName, './public/img/'.$name);

                //Chemain vers affiche
                $affiche = "public/img/".$name;
            }

                //Préparation de la requete SQL
                $ajoutFilm = $pdo->prepare("
                    INSERT INTO film (titre, realisateur_id, duree, sortie, synopsis, note, affiche)
                        VALUES (:titre, :realisateur_id, :duree, :sortie, :synopsis, :note, :affiche)  
                ");
                //Exécution de la requete SQL
                $ajoutFilm->execute([
                    ":titre" => ucfirst($titre),
                    ":realisateur_id" => $realisateur,
                    ":duree" => $duree,
                    ":sortie" => $sortie,
                    ":synopsis" => $synopsis,
                    ":note" => $note,
                    ":affiche" => $affiche
                ]);
                $film_id = $pdo->lastInsertId();

                //Préparation de la requete SQL
                $ajoutCastingFilm = $pdo->prepare("
                    INSERT INTO filmgenre (film_id, genre_id)
                        VALUES (:film_id, :genre_id)  
                ");
                //Exécution de la requete SQL
                foreach($genres as $genre){
                    $ajoutCastingFilm->execute([
                        ":film_id" => $film_id,
                        ":genre_id" => $genre
                    ]);
                }

                header("Location:index.php?action=listFilms");
                die();
            }
        }

        //Page d'affichage
        require "view/ajoutFilm.php";
    }
    
    //Genre
    public function addGenre() {

        if(isset($_POST['submit'])){
        
            //nom
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          
            if($name){
            $pdo = Connect::seConnecter();
            session_start();

                //Vérifie si l'entrée existe déjà
                $dupPrevent = $pdo->prepare("SELECT * FROM genre WHERE nom=?");
                $dupPrevent->execute([$name]);
                $genre = $dupPrevent->fetch();

                if ($genre) {

                    //Le Genre existe déjà
                    $_SESSION["error"] = "Le genre existe déjà";

                    //Recharge la page addGenre pour afficher l'erreur
                    header("Location:index.php?action=addGenre");
                    die();

                } else {

                    //Créer le nouveau Genre
                    //Préparation de la requete SQL
                    $ajoutActeur = $pdo->prepare("
                        INSERT INTO genre (nom)
                            VALUES (:name)  
                    ");
                    //Exécution de la requete SQL
                    $ajoutActeur->execute([
                        ":name" => ucfirst($name)           
                    ]);

                }

                //Si dans addFilm
                if ($action == "addFilm") {
                    header("Location:index.php?action=addFilm");
                    die();

                //Si dans addGenre
                } else {
                    header("Location:index.php?action=listGenres");
                    die();
                }
            }
        }

        require "view/ajoutGenre.php";
    }

    public function addCasting() {

        $pdo = Connect::seConnecter();

        $filmList = $pdo->query("
            SELECT film.id , titre
            FROM film   
            ORDER BY film.titre    
        ");

        $acteurList = $pdo->query("
        SELECT acteur.id, CONCAT(nom,' ',prenom) AS 'acteur'
        FROM acteur 
        ORDER BY 'acteur'       
        ");

        $roleList = $pdo->query("
        SELECT role.id, role.nom
        FROM role 
        ORDER BY role.nom       
        ");

        if(isset($_POST['submit'])){
        
            //film
            $film = filter_input(INPUT_POST, "film", FILTER_SANITIZE_NUMBER_INT);
            //acteur
            $acteur = filter_input(INPUT_POST, "acteur", FILTER_SANITIZE_NUMBER_INT);
            //role
            $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_NUMBER_INT);

          
            if($film && $acteur && $role){
                $pdo = Connect::seConnecter();

                //Préparation de la requete SQL
                $ajoutCasting = $pdo->prepare("
                    INSERT INTO casting (film_id, acteur_id, role_id)
                        VALUES (:film, :acteur, :role)  
                ");
                //Exécution de la requete SQL
                $ajoutCasting->execute([
                    ":film" => $film,
                    ":acteur" => $acteur,
                    ":role" => $role        
                ]);
                header("Location:index.php?action=detailFilm?id='" . $film . "'");
                die();
            }
        }

        require "view/ajoutCasting.php";
    }

    public function addRole() {

        if(isset($_POST['submit'])){
        
            //nom
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          
            if($name){
            $pdo = Connect::seConnecter();
            session_start();

                //Vérifie si l'entrée existe déjà
                $dupPrevent = $pdo->prepare("SELECT * FROM role WHERE nom=?");
                $dupPrevent->execute([$name]);
                $role = $dupPrevent->fetch();

                if ($role) {

                    //Le Role existe déjà
                    $_SESSION["error"] = "Le role existe déjà";

                    //Recharge la page addRole pour afficher l'erreur
                    header("Location:index.php?action=addRole");
                    die();

                } else {

                    //Créer le nouveau Role
                    //Préparation de la requete SQL
                    $ajoutRole = $pdo->prepare("
                        INSERT INTO role (nom)
                            VALUES (:name)  
                    ");
                    //Exécution de la requete SQL
                    $ajoutRole->execute([
                        ":name" => ucfirst($name)           
                    ]);

                }

                //Si dans addCasting
                if ($action == "addCasting") {
                    header("Location:index.php?action=addCasting");
                    die();

                //Si dans addRole
                } else {
                    header("Location:index.php?action=listRole");
                    die();
                }
            }
        }

        require "view/ajoutRole.php";
    }
}


?>