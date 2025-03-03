<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php";
require_once __DIR__ . '/../lib/Bitrix24API.php';
require_once __DIR__ . '/../lib/ContactForm.php';
require_once __DIR__ . '/../lib/Config.php';

$options = include __DIR__ . '/../path/to/options.php';

Config::initialize($options);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $api = new B24API(Config::getWebhookUrl());
    $contactForm = new ContactForm($api);
    $response = $contactForm->handleFormSubmission($_POST);
    echo json_encode($response);
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Контактная форма</title>
</head>
<body>
    <form method="post" action="">
        <label for="name">Имя:</label>
        <input type="text" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        
        <label for="phone">Телефон:</label>
        <input type="tel" name="phone" required>

        <label for="comment">Вопрос:</label>
        <input type="text" name="comment" required>
        
        <button type="submit">Отправить</button>
    </form>
</body>
</html>
