<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

session_start();

$app = unserialize($_SESSION['app']);
$users = $app->getUsers();
foreach ($users as $user) {
    if ($user->getUserName() === $_POST['username']) {
        $_SESSION['user'] = serialize($user);
        break;
    }
}
