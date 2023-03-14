<?php

use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php' ;
});

$ctrlCinema = new CinemaController();

// $type = (isset($_GET["type"])) ? $_GET["type"] : null
$id = filter_var((isset($_GET["id"])), FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE) ? $_GET["id"] : null;


if(isset($_GET["action"])){
    switch ($_GET["action"]) {

      //liste:
      case "listFilms" : $ctrlCinema->listFilms(); break;
      case "listActeurs" : $ctrlCinema->listActeurs(); break;
      case "listRealisateurs" : $ctrlCinema->listRealisateurs(); break;
      case "listGenres" : $ctrlCinema->listGenres(); break;
      case "listCastings" : $ctrlCinema->listCastings(); break;

      //détail: 
      case "detailFilm" : $ctrlCinema->detailFilm($id); break;
      case "detailActeur" : $ctrlCinema->detailActeur($id); break;
      case "detailRealisateur" : $ctrlCinema->detailRealisateur($id); break;
      case "detailGenre" : $ctrlCinema->detailGenre($id); break;

      //ajout:
      case "addFilm" : $ctrlCinema->addFilm(); break;
      case "addActeur" : $ctrlCinema->addActeur(); break;
      case "addRealisateur" : $ctrlCinema->addRealisateur(); break;
      case "addGenre" : $ctrlCinema->addGenre(); break;
      case "addCasting" : $ctrlCinema->addCasting(); break;

    }
}

?>