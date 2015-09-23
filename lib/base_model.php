<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
      }
      return $errors;
    }


    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Game (book_name, writer, publisher, published, genre, status)
                                            VALUES (:book_name, :writer, :publisher, :published, :genre, :status) RETURNING id');
        $query->execute(array('book_name' => $this->book_name,
                                'writer' => $this->writer,
                                'publisher' => $this->publisher,
                                'published' => $this->published,
                                'genre' => $this->genre,
                                'status' => $this->status));
        $row = $query->fetch();
        $this->id = $row['id'];

    }


  }


