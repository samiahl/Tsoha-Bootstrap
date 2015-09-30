<?php
/**
 * Created by PhpStorm.
 * User: samiahl
 * Date: 17.9.2015
 * Time: 11:46
 */

class Book extends BaseModel{

    public $book_name, $writer, $publisher, $published, $genre, $validators;

    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_book_name', 'validate_writer', 'validate_publisher', 'validate_published');
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
                'genre' => $row['genre']
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
                'genre' => $row['genre']

            ));
            return $book;
        }
        return null;
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Book (book_name, writer, publisher, published, genre )
                                            VALUES (:book_name, :writer, :publisher, :published, :genre ) RETURNING id');

        $query->execute(array(
            'book_name' => $this->book_name,
            'writer' => $this->writer,
            'publisher' => $this->publisher,
            'published' => $this->published,
            'genre' => $this->genre
        ));


        $row = $query->fetch();
        $this->id = $row['id'];

    }

}