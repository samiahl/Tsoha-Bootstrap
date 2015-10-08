<?php

function check_logged_in(){
    BaseController::check_logged_in();
}
// Book

$routes->get('/', 'check_logged_in', function() {
    BookController::index();
});

$routes->get('/book','check_logged_in', function() {
    BookController::index();
});

$routes->post('/book','check_logged_in', function() {
    BookController::store();
});

$routes->get('/book/new','check_logged_in', function() {
   BookController::new_book();
});

$routes->get('/book/:id','check_logged_in', function($id) {
    BookController::show($id);
});

$routes->get('/book/:id/edit','check_logged_in', function($id) {
    BookController::edit($id);
});

$routes->post('/book/:id/edit','check_logged_in', function($id) {
    BookController::update($id);
});

$routes->post('/book/:id/destroy','check_logged_in', function($id) {
    BookController::destroy($id);
});
// Reader

$routes->get('/login', function(){
    ReaderController::login();
});

$routes->post('/login', function() {
    ReaderController::handle_login();
});

$routes->get('/logout', function(){
    ReaderController::logout();
});

$routes->get('/register', function(){
    ReaderController::new_user();
});

$routes->post('/register', function(){
    ReaderController::save();
});


