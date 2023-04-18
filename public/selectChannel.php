<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

session_start();

$app = unserialize($_SESSION['app']);
$channels = $app->getChannels();
foreach ($channels as $channel) {
    if ($channel->getName() === $_POST['options']) {
        $_SESSION['channel'] = serialize($channel);
        break;
    }
}
