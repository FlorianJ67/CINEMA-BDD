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
            SELECT titre, CONCAT(realisateur.nom, ' ',realisateur.prenom) as 'realisateur', duree, sortie
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
            SELECT CONCAT(nom,' ',prenom) as 'acteur', sex
            FROM acteur       
        ");
      
        require "view/listActeur.php";
    }
}
