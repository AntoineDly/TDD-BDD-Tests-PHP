<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Entity\Channel;

session_start();
$channel = new Channel(name: $_POST['name']);

$app = unserialize($_SESSION['app']);
$app->addChannel($channel);
$_SESSION['app'] = serialize($app);
$_SESSION['channel'] = serialize($channel);