<?php
/**
 * Created by PhpStorm.
 * User: samiahl
 * Date: 17.9.2015
 * Time: 11:46
 */
class Book extends BaseModel{

    public $id, $book_name, $writer, $publisher, $published, $genre;

    public function __construct($attributes){
        parent::__construct($attributes);
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Book');
        $query->execute();

        $rows = $query->fetchAll();
        $books = array();

        foreach($rows as $row){
            $books[] = new Book(array(
                'book_name' => $row['book_name'],
                'writer' => $row['writer'],
                'publisher' => $row['publisher'],
                'published' => $row['published'],
                'genre' => $row['genre'],
                'status' => $row['status']
            ));
        }
        return $books;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Book WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $book = new Book(array(
                'book_name' => $row['book_name'],
                'writer' => $row['writer'],
                'publisher' => $row['publisher'],
                'published' => $row['published'],
                'genre' => $row['genre'],
                'status' => $row['status']
            ));
            return $book;
        }
        return null;
    }
}