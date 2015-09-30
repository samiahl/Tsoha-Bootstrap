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
        $book = Book::find($id);
        View::make('book/show_book.html', array('book' => $book));
    }

    public static function edit($id){
        $book = Book::find($id);
        View::make('book/:id/edit_book.html', array('book' => $book));
    }



    public static function update($id){
        $params = $_POST;

        $v = new Valitron\Validator($params);
        $v->rule('required', 'book_name');
        $v->rule('lengthBetween', 'book_name', 1, 50);

        $v->rule('required', 'writer');
        $v->rule('lengthBetween', 'writer', 1, 50);

        $v->rule('required', 'publisher');
        $v->rule('lengthBetween', 'publisher', 1, 50);

        $v->rule('numeric', 'published');
        $v->rule('required', 'published');
        $v->rule('lengthBetween', 'published', 1, 4);

        $attributes = array(
            'id' => $id,
            'book_name' => $params['book_name'],
            'writer' => $params['writer'],
            'publisher' => $params['publisher'],
            'published' => $params['published'],
            'genre' => $params['genre']
        );

        if($v->validate()){
            $book = new Book($attributes);
            $book->update();
            Redirect::to('/book/edit_book.html' . $book->id, array('message' => 'Kirjan tietoja on muokattu.'));
        }
    }



    public static function new_book(){
        View::make('book/new.html');
    }

    public static function store(){
        $params = $_POST;

        $v = new Valitron\Validator($params);
        $v->rule('required', 'book_name');
        $v->rule('lengthBetween', 'book_name', 1, 50);

        $v->rule('required', 'writer');
        $v->rule('lengthBetween', 'writer', 1, 50);

        $v->rule('required', 'publisher');
        $v->rule('lengthBetween', 'publisher', 1, 50);

        $v->rule('numeric', 'published');
        $v->rule('required', 'published');
        $v->rule('lengthBetween', 'published', 1, 4);

        if($v->validate()){
            $book = new Book(array(
                'book_name' => $params['book_name'],
                'writer' => $params['writer'],
                'publisher' => $params['publisher'],
                'published' => $params['published'],
                'genre' => $params['genre']

            ));
            $book->save();
            // Kint::dump($params);
            Redirect::to('/book/' . $book->id, array('message' => 'Kirja on lisätty valikoimaasi.'));
        }else{
            View::make('book/new.html', array('errors' => $v->errors(), 'message' => 'Syötteissä virheitä, kokeile uudestaan.'));
        }
    }

    public static function destroy($id){
        $book = new Book(array('id' => $id));
        $book->destroy();
        Redirect::to('/book', array('Kirja poistettu valikoimastasi.'));
    }
}
