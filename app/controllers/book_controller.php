<?php
/**
 * Created by PhpStorm.
 * User: samiahl
 * Date: 22.9.2015
 * Time: 12:10
 */

class BookController extends BaseController{

    public static function index(){
        $books = Book::all();
        View::make('book/index.html', array('books' => $books));
    }

    public static function show($id){

    }

    public static function new_book(){
        View::make('book/new.html');
    }

    public static function store(){
        $params = $_POST;
        $book = new Book(array(
            'book_name' => $params['name'],
            'writer' => $params['writer'],
            'publisher' => $params['publisher'],
            'published' => $params['year'],
            'genre' => $params['genre'],
            'status' => $params['status']
        ));
        $book->save();

       // Kint::dump($params);

        Redirect::to('/book/' . $book->id, array('message' => 'Kirja on lisätty valikoimaasi.'));
    }
}
