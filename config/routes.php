<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/book', function() {
    HelloWorldController::book_list();
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