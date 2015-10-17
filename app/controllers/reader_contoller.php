<?php
/**
 * Created by PhpStorm.
 * User: samiahl
 * Date: 1.10.2015
 * Time: 20:18
 */

class ReaderController extends BaseController{

    public static function reader_index(){
        $readers = Reader::all();
        Kint::dump($readers);
        View::make('reader/all_readers.html', array('readers' => $readers));
    }

    public static function show($id){
        $reader = Reader::find($id);
        //$bookCount = Book::getNumberOfBooksByReader($id);
        View::make('reader/show_reader.html', array('reader' => $reader
        //, 'bookCount' => $bookCount
        ));
    }

    public static function login(){
        View::make('reader/login.html');
    }

    public static function new_user(){
        View::make('reader/new_reader.html');
    }

    public static function logout(){
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function handle_login(){
        $params = $_POST;
        $reader = Reader::authenticate($params['username'], $params['password']);

        if(!$reader){
            View::make('reader/new_reader.html', array('error' => 'Väärä käyttäjätunnus tai salasana.', 'reader_name' => $params['username']));
        }else{
            $_SESSION['user'] = $reader->id;
           // Kint::dump($params);
            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $reader->reader_name . '!'));
        }
    }

    public static function handle_logout(){
        $_SESSION = array();
        session_destroy();
        Redirect::to('/');
    }

    public static function save(){
        $params = $_POST;
        $v = new Valitron\Validator($params);
        $v->rule('required', 'reader_name');
        $v->rule('lengthMin', 'reader_name', 3);
        $v->rule('lengthMax', 'reader_name', 15);
        $v->rule('required', 'reader_password');
        $v->rule('lengthMin', 'reader_password', 4);
        $v->rule('lengthMax', 'reader_password',15);
        if($v->validate()){
            $reader = new Reader(array(
                'reader_name' => $params['reader_name'],
                'reader_password' => $params['reader_password']
            ));
            $reader->save();
            Redirect::to('/login', array('message' => 'Voit nyt kirjautua sisään uusilla tunnuksillasi.'));
        }else{
            View::make('reader/new_reader.html', array('errors' => $v->errors(), 'message' => 'Annetuissa tiedoissa virheitä tai puutteita.'));
        }
    }

    public static function update_user($id){
        $params = $_POST;

        $v = new Valitron\Validator($params);
        $v->rule('required', 'reader_name');
        $v->rule('lengthMin', 'reader_name', 3);
        $v->rule('lengthMax', 'reader_name', 15);
        $v->rule('required', 'reader_password');
        $v->rule('lengthMin', 'reader_password', 4);
        $v->rule('lengthMax', 'reader_password',15);

        $attributes = array(
            'id' => $id,
            'reader_name' => $params['reader_name'],
            'reader_password' => $params['reader_password']
        );

        if($v->validate()){
            $reader = new Reader($attributes);
            $reader->update();
            Redirect::to('/reader/' . $reader->id, array('message' => 'Tietojasi on muokattu onnistuneesti.'));
        }

    }

    public static function edit_user($id){
        $reader = Reader::find($id);
        View::make('reader/edit_reader.html', array('reader' => $reader));
    }


}