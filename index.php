<?php

require 'vendor/autoload.php';
require 'api.php';

header('Content-type: application/json');

$app = new API();

Flight::route('/', array('API', 'hello'));
Flight::route('GET /users', array($app, 'getUsers'));
Flight::route('POST /users', array($app, 'postUser'));
Flight::route('GET /users/@id', array($app, 'getUser'));
Flight::route('DELETE /users(/@id)', array($app, 'deleteUser'));
Flight::route('PUT /users(/@id)', array($app, 'updateUser'));


Flight::start();
?>