<?php

namespace Controller;
use Model\Connect;

class CinemaController {

    /**
     * Lister les films
     */
    public function listFilms() {
        
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre, CONCAT(realisateur.nom, ' ',realisateur.prenom) AS 'realisateur', duree, sortie
            FROM film   
            INNER JOIN realisateur ON realisateur.id = realisateur_id     
        ");
        require "view/listFilms.php";
    }

    /**
     * Lister les acteurs
     */
    public function listActeurs() {
        
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT CONCAT(nom,' ',prenom) AS 'acteur', date_de_naissance, sex
            FROM acteur       
        ");
      
        require "view/listActeur.php";
    }

    public function detailFilm($id) {
        
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT titre, CONCAT(realisateur.nom, ' ',realisateur.prenom) AS 'realisateur', CONCAT(acteur.nom, ' ',acteur.prenom) AS 'acteur', duree, sortie, note, affiche, synopsis
            FROM film   
            INNER JOIN realisateur ON realisateur.id = realisateur_id  
            INNER JOIN casting ON film.id = film_id  
            INNER JOIN acteur ON acteur.id = acteur_id
            WHERE film.id = :id   
        ");
        $requete->execute(["id" => $id]);
        require "view/detailFilm.php";
    }
    
}
