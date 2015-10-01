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

$routes->get('/book/:id/edit', function($id) {
    BookController::edit($id);
});

$routes->post('/book/:id/edit', function($id) {
    BookController::update($id);
});

$routes->post('/book/:id/destroy', function($id) {
    BookController::destroy($id);
});

$routes->get('/book/login', function(){
    UserController::login();
});

$routes->post('/book/login', function() {
    UserController::handle_login();
});

//------------------------------------------------------

$routes->get('/book/info', function() {
    HelloWorldController::book_info();
});

$routes->get('/book/edit', function() {
    HelloWorldController::book_edit();
});


$routes->get('/register', function() {
    HelloWorldController::register();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});