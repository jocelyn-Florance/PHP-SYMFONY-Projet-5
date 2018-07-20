<?php
session_start();

use Symfony\Component\HttpFoundation\Request;

require './../vendor/autoload.php';
require '../config/debug/whoops.php';
require '../src/Router.php';

$request = Request::createFromGlobals();

$router = new App\Router($request);
$router->runApp();
