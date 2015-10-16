<?php

  class BaseController{

    public static function get_user_logged_in(){
        if(isset($_SESSION['user'])){
            $id = $_SESSION['user'];
            $reader = Reader::find($id);
            return $reader;
        }
      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
        if(!isset($_SESSION['user'])) {
            Redirect::to('/login', array('message' => 'Kirjautuminen vaaditaan.'));
        }
    }

  }
