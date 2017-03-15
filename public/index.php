<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$setting = include __DIR__ . "/../app/setting.php";

$app = new \Slim\App($setting);

include __DIR__ . '/../app/container.php';
include __DIR__ . '/../app/routing.php';

$app->run();
