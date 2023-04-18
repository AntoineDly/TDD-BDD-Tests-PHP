<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Entity\Message;

session_start();
$message = new Message(content: $_POST['message'], user: unserialize($_SESSION['user']));

$channel = unserialize($_SESSION['channel']);
$channel->addMessage(message: $message);
$_SESSION['channel'] = serialize($channel);

$app = unserialize($_SESSION['app']);
$channels = $app->getChannels();
foreach ($channels as $id => $currentChannel) {
    if ($currentChannel->getName() === $channel->getName()) {
        $app->setChannel($id, $channel);
        $_SESSION['app'] = serialize($app);
        break;
    }
}