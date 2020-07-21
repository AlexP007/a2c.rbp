<?php

/**
 * Страница деисталляции: финальная
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
use Bitrix\Main\Localization\Loc;

if (!check_bitrix_sessid()) {
    return;
}

if ($ex = $APPLICATION->GetException()) {
    CAdminMessage::ShowMessage(array(
        "TYPE"    => "ERROR",
        "MESSAGE" => $ex->GetString(),
        "HTML"    => true,
    ));
} else {
    CAdminMessage::ShowNote(Loc::getMessage('A2C_RBP_UNINSTALL_SUCCESS') );
}

?>

<form action="<?= $APPLICATION->GetCurPage() ?>">
    <input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
    <input type="submit" name="lang" value="<?=Loc::getMessage("A2C_RBP_MARKETPLACE_RETURN_BUTTON")?>">
</form>