<?php
/**
 * Created by PhpStorm.
 * User: samiahl
 * Date: 17.9.2015
 * Time: 11:46
 */

class Book extends BaseModel{

    public $id, $book_name, $writer, $publisher, $published, $genre, $reader_id;

    public function __construct($attributes){
        parent::__construct($attributes);
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT Book.id, Book.book_name, Book.writer, Book.publisher, Book.published,
                                            Book.genre, Book.reader_id
                                            FROM Book
                                           ');

        $query->execute();
        $rows = $query->fetchAll();
        $books = array();

        foreach($rows as $row){
            $books[] = new Book(array(
                'id' => $row['id'],
                'book_name' => $row['book_name'],
                'writer' => $row['writer'],
                'publisher' => $row['publisher'],
                'published' => $row['published'],
                'genre' => $row['genre'],
                'reader_id' => $row['reader_id']
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
                'id' => $row['id'],
                'book_name' => $row['book_name'],
                'writer' => $row['writer'],
                'publisher' => $row['publisher'],
                'published' => $row['published'],
                'genre' => $row['genre'],

            ));
            return $book;
        }
        return null;
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Book (book_name, writer, publisher, published, genre, reader_id)
                                            VALUES (:book_name, :writer, :publisher, :published, :genre, :reader_id) RETURNING id');

        $query->execute(array(
            'book_name' => $this->book_name,
            'writer' => $this->writer,
            'publisher' => $this->publisher,
            'published' => $this->published,
            'genre' => $this->genre,
            'reader_id' => $this->reader_id
        ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM Book WHERE id = :id');
        $query->execute(array('id' => $this->id));
        $query->fetch();
    }

    public function update(){
        $query = DB::connection()->prepare('UPDATE Book SET book_name = :book_name,
                                                            writer = :writer,
                                                            publisher = :publisher,
                                                            published = :published,
                                                            genre = :genre
                                                            WHERE id = :id');
        $query->execute(array(
            'id' => $this->id,
            'book_name' => $this->book_name,
            'writer' => $this->writer,
            'publisher' => $this->publisher,
            'published' => $this->published,
            'genre' => $this->genre

        ));
        $row = $query->fetch();
    }

    public function getNumberOfBooksByReader($id){
        $query = DB::connection()->prepare('SELECT COUNT(Book.id) FROM Book
                                            WHERE reader_id = :id');
        $query->execute(array('id' => $id));
        return $query->fetch();
    }
}