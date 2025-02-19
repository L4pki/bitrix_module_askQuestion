<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && check_bitrix_sessid()) {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $question = trim($_POST["question"]);
    $siteUrl = $_SERVER['HTTP_REFERER'];

    define("USER_NAME", $name);
    define("USER_EMAIL", $email);
    define("USER_PHONE", $phone);
    define("USER_QUESTION", $question);
    define("USER_SITE_URL", $siteUrl);

    LocalRedirect($APPLICATION->GetCurPage() . "?success=1");
    exit;
}

$this->IncludeComponentTemplate();
?>
