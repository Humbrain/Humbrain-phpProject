<?php

use Dotenv\Dotenv;
use Steodec\SteoFrameWork\Routers\Main;
use Steodec\SteoFrameWork\Routers\RouterException;

require "vendor/autoload.php";

session_start();
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
if (!isset($_SESSION['user']) && !str_contains($_GET['url'], 'user/login')) {
    header('location: /user/login');
    exit();
}
try {
    $router = new Main("App\\controllers");
    $router->run();
} catch (RouterException|ReflectionException|Exception $e) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', TRUE, 500);
    print_r($e);
}