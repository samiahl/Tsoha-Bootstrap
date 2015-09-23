<?php

//require 'app/models/book.php';

  class HelloWorldController extends BaseController{

      public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  //View::make('home.html');
        echo 'Tämä on etusivu!';
      }

      public static function sandbox(){
      // Testaa koodiasi täällä
        //View::make('helloworld.html');
          $torakat = Book::find(1);
          $books = Book::all();

          Kint::dump($books);
          Kint::dump($torakat);
      }

      public static function book_edit(){
         View::make('suunnitelmat/book_edit.html');
      }

      public static function book_info(){
          View::make('suunnitelmat/book_info.html');
      }

      public static function book_list(){
          View::make('suunnitelmat/book_list.html');
      }

      public static function login(){
          View::make('suunnitelmat/login.html');
      }

      public static function register(){
          View::make('suunnitelmat/register.html');
      }

  }
