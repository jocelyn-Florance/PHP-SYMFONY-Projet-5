<?php
session_start();

use Symfony\Component\HttpFoundation\Request;
use App\Etc\Router;

require   './../vendor/autoload.php';
require '../config/debug/whoops.php';
require  '../src/Etc/Router.php';

$request = Request::createFromGlobals();

$router = new Router($request);
$router->runApp();
