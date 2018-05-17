<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('books',  ['uses' => 'BooksController@showAllBooks']);

$router->get('authors',  ['uses' => 'AuthorsController@showAllAuthors']);
$router->get('authors/{id}', ['uses' => 'AuthorsController@showOneAuthor']);

$router->get('authors/{id}/books', ['uses' => 'BooksController@showBooksOfOneAuthor']);

