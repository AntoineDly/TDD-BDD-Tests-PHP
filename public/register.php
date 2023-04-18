<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Entity\User;

session_start();
$user = new User(userName: $_POST['username']);

$app = unserialize($_SESSION['app']);
$app->addUser($user);
$_SESSION['app'] = serialize($app);
$_SESSION['user'] = serialize($user);