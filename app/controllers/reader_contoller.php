<?php
/**
 * Created by PhpStorm.
 * User: samiahl
 * Date: 1.10.2015
 * Time: 20:18
 */

class ReaderController extends BaseController{

    public static function handle_login(){
        $params = $_POST;

        $reader = Reader::authenticate($params['reader_name'], $params['reader_password']);

        if(!$reader){
            View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana.', 'username' => $params['username']));
        }else{
            $_SESSION['user'] = $reader->id;
            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->name . '!'));
        }
    }

    public static function login(){
        View::make('user/login.html');
    }
}