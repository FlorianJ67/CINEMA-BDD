<?php

namespace Controller;
use Model\Connect;

class CinemaController {


    //Liste:

    public function listFilms() {
        
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT film.id AS filmID, titre, realisateur.id as realID, CONCAT(realisateur.nom, ' ',realisateur.prenom) AS 'realisateur', duree, sortie
            FROM film   
            INNER JOIN realisateur ON realisateur.id = realisateur_id     
        ");
        require "view/listFilms.php";
    }

    public function listActeurs() {
        
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT acteur.id, CONCAT(nom,' ',prenom) AS 'acteur', date_de_naissance, sex
            FROM acteur       
        ");
      
        require "view/listActeurs.php";
    }

    public function listRealisateurs() {
        
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT realisateur.id, CONCAT(nom,' ',prenom) AS 'realisateur', date_de_naissance, sex
            FROM realisateur       
        ");
      
        require "view/listRealisateurs.php";
    }

    //détail:
    public function detailFilm($id) {
        
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT titre, CONCAT(realisateur.nom, ' ',realisateur.prenom) AS 'realisateur', duree, sortie, note, affiche, synopsis, GROUP_CONCAT(CONCAT(UCASE(LEFT(genre.nom,1)),LCASE(SUBSTRING(genre.nom,2))) SEPARATOR ', ' ) as genres
            FROM film   
            INNER JOIN realisateur ON realisateur.id = realisateur_id  
            INNER JOIN filmGenre ON film.id = filmGenre.film_id  
            INNER JOIN genre ON genre.id = genre_id
            WHERE film.id = :id   
        ");
        $requete->execute(["id" => $id]);

        $requete2 = $pdo->prepare("
            SELECT acteur.id, CONCAT(acteur.nom, ' ',acteur.prenom) AS 'acteur'
            FROM film   
            INNER JOIN casting ON film.id = film_id   
            INNER JOIN acteur ON acteur.id = acteur_id   
            WHERE film.id = :id   
        ");
        $requete2->execute(["id" => $id]);

        require "view/detailFilm.php";
    }

    public function detailActeur($id) {
        
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT id, CONCAT(acteur.nom, ' ',acteur.prenom) AS 'acteur', sex, date_de_naissance
            FROM acteur 
            WHERE acteur.id = :id   
        ");
        $requete->execute(["id" => $id]);

        $requete2 = $pdo->prepare("
            SELECT film.id, film.titre, role.nom
            FROM film   
            INNER JOIN casting ON film.id = casting.film_id  
            INNER JOIN acteur ON acteur.id = casting.acteur_id  
            INNER JOIN role ON role.id = casting.role_id   
            WHERE acteur.id = :id   
        ");
        $requete2->execute(["id" => $id]);

        require "view/detailActeur.php";
    }

    public function detailRealisateur($id) {
        
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT id, CONCAT(realisateur.nom, ' ',realisateur.prenom) AS 'realisateur', sex, date_de_naissance
            FROM realisateur
            WHERE realisateur.id = :id   
        ");
        $requete->execute(["id" => $id]);

        $requete2 = $pdo->prepare("
            SELECT DISTINCT film.id, film.titre
            FROM film   
            WHERE realisateur_id = :id   
        ");
        $requete2->execute(["id" => $id]);

        require "view/detailRealisateur.php";
    }

    //Ajout:
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

                $ajoutActeur = $pdo->prepare("
                    INSERT INTO acteur (prenom, nom, sex, date_de_naissance)
                        VALUES (:firstname, :name, :sex, :birthday)  
                ");
                $ajoutActeur->execute([
                    ":firstname" => ucfirst($firstname),
                    ":name" => ucfirst($name),
                    ":sex" => $sex,
                    ":birthday" => $birthday            
                ]);
                header("Location:index.php?action=listActeurs");
                die();
            }
        }

        require "view/ajoutActeur.php";
    }

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

                $ajoutRealisateur = $pdo->prepare("
                    INSERT INTO realisateur (prenom, nom, sex, date_de_naissance)
                        VALUES (:firstname, :name, :sex, :birthday)  
                ");
                $ajoutRealisateur->execute([
                    ":firstname" => ucfirst($firstname),
                    ":name" => ucfirst($name),
                    ":sex" => $sex,
                    ":birthday" => $birthday            
                ]);
                header("Location:index.php?action=listRealisateurs");
                die();
            }
        }

        require "view/ajoutRealisateur.php";
    }

    public function addFilm() {

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
            //note
            $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_NUMBER_INT);
            //affiche
            $affiche = filter_input(INPUT_POST, "affiche", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($titre && $realisateur && $duree && $sortie && $synopsis && $note && $affiche){
            $pdo = Connect::seConnecter();

                $ajoutFilm = $pdo->prepare("
                    INSERT INTO film (titre, realisateur_id, duree, sortie, synopsis, note, affiche)
                        VALUES (:titre, :realisateur_id, :duree, :sortie, :synopsis, :note, :affiche)  
                ");
                $ajoutFilm->execute([
                    ":film" => ucfirst($titre),
                    ":realisateur_id" => $realisateur,
                    ":duree" => $duree,
                    ":sortie" => $sortie,
                    ":synopsis" => $synopsis,
                    ":note" => $note,
                    ":affiche" => $affiche          
                ]);
                header("Location:index.php?action=listFilms");
                die();
            }
        }

        require "view/ajoutFilm.php";
    }
}


?>