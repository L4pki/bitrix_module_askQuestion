<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">Ваш вопрос успешно отправлен!</div>
<?php endif; ?>

<form method="POST" action="<?= $APPLICATION->GetCurPage() ?>?lang=<?= LANGUAGE_ID ?>">
    <?= bitrix_sessid_post() ?>
    <table>
        <tr>
            <td>Имя:</td>
            <td><input type="text" name="name" required /></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="email" name="email" required /></td>
        </tr>
        <tr>
            <td>Телефон:</td>
            <td><input type="text" name="phone" required /></td>
        </tr>
        <tr>
            <td>Вопрос:</td>
            <td><textarea name="question" required></textarea></td>
        </tr>
    </table>
    <input type="submit" value="Отправить" />
</form>
