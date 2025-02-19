<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$module_id = "myb24lead.testmodule";

$url = COption::GetOptionString($module_id, "webhook_url", "https://default-url.com");
$hook_key = COption::GetOptionString($module_id, "hook_key", "default_key");

if ($_SERVER["REQUEST_METHOD"] == "POST" && check_bitrix_sessid()) {
    $url = trim($_POST["webhook_url"]);
    $hook_key = trim($_POST["hook_key"]);

    COption::SetOptionString($module_id, "webhook_url", $url);
    COption::SetOptionString($module_id, "hook_key", $hook_key);

    echo json_encode(['success' => true, 'message' => 'Настройки успешно сохранены.']);
    exit;
}

$APPLICATION->SetTitle("Настройки модуля " . $module_id);
?>


<form method="POST" action="<?= $APPLICATION->GetCurPage() ?>?lang=<?= LANG ?>">
    <?= bitrix_sessid_post() ?>
    <table>
        <tr>
            <td>Webhook URL:</td>
            <td><input type="text" name="webhook_url" value="<?= htmlspecialchars($url) ?>" /></td>
        </tr>
        <tr>
            <td>Hook Key:</td>
            <td><input type="text" name="hook_key" value="<?= htmlspecialchars($hook_key) ?>" /></td>
        </tr>
    </table>
    <input type="submit" value="Сохранить" />
</form>
