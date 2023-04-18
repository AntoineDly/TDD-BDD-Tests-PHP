<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Entity\App;

session_start();
if (!isset($_SESSION['app'])) {
    $_SESSION['app'] = serialize(new App());
}

$app = unserialize($_SESSION['app']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.classless.min.css"
    />
    <title>BDD - TDD</title>
    <script src="script.js"></script>
</head>
<body>
    <main>
        <h1>BDD - TDD</h1>
        <?php if (!isset($_SESSION['user'])) { ?>
            <form id="login" onSubmit="login(this)">
                <label for="username">Nom d'utilisateur : </label>
                <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required>
                <button type="submit">Se connecter</button>
            </form>
    
            <form id="register" onSubmit="register(this)">
                <label for="username">Nom d'utilisateur : </label>
                <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required>
                <button type="submit">S'inscrire</button>
            </form>
        <?php } else { ?>
            <div> Nom d'utilisateur : <?php echo unserialize($_SESSION['user'])->getUserName(); ?> </div>
            <?php if (!isset($_SESSION['channel'])) { ?>
                <form id="createChannel" onSubmit="createChannel(this)">
                        <label for="name">Nom : </label>
                        <input type="text" id="name" name="name" placeholder="Nom" required>
                        <button type="submit">Créer un salon</button>
                    </form>
                    <form id="selectChannel" onSubmit="selectChannel(this)">
                        <select name="options">
                        <?php foreach ($app->getChannels() as $channel) { ?>
                            <option value="<?php echo $channel->getName(); ?>"><?php echo $channel->getName(); ?></option>
                        <?php } ?>
                        </select>
                    <button type="submit">Sélectionner un salon</button>
                </form>
            <?php } else { ?>
                <div> Nom de salon : <?php echo unserialize($_SESSION['channel'])->getName(); ?> </div>

                <ul>
                    <?php foreach (unserialize($_SESSION['channel'])->getMessages() as $message) { ?>
                        <li> <?php echo $message->getUser()->getUserName() . ' : ' . $message->getContent() . ' (' . $message->getDate()->format('Y-m-d H:i:s') . ')' ?></li>
                    <?php } ?>
                </ul>

                <form id="sendMessage" onSubmit="sendMessage(this)">
                    <label for="message">Message : </label>
                    <textarea id="message" name="message" required></textarea>
                    <button type="submit">Envoyer un message</button>
                </form>

                <form id="changeChannel" onSubmit="changeChannel()">
                    <button type="submit">Changer de salon</button>
                </form>
            <?php } ?>
            <form id="disconnect" onSubmit="disconnect()">
                <button type="submit">Se déconnecter</button>
            </form>
        <?php } ?>
    </main>
</body>
</html>