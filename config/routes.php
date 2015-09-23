<?php

$routes->get('/', function() {
    BookController::index();
});

$routes->get('/book', function() {
    BookController::index();
});

$routes->post('/book', function() {
    BookController::store();
});

$routes->get('/book/new', function() {
   BookController::new_book();
});

$routes->get('/book/:id', function($id) {
    BookController::show($id);
});




$routes->get('/book/info', function() {
    HelloWorldController::book_info();
});

$routes->get('/book/edit', function() {
    HelloWorldController::book_edit();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});

$routes->get('/register', function() {
    HelloWorldController::register();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});