<?php

  class BaseController{

    public static function get_reader_logged_in(){
        if(isset($_SESSION['reader'])){
            $reader_id = $_SESSION['reader'];
            $reader = Reader::find($reader_id);
            return $reader;
        }
      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }

  }
