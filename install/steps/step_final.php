<?php

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
    CAdminMessage::ShowNote(Loc::getMessage('A2C_RBP_INSTALL_SUCCESS') );
}

?>

<form action="<?= $APPLICATION->GetCurPage() ?>">
    <input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
    <input type="submit" name="lang" value="<?=Loc::getMessage("A2C_RBP_MARKETPLACE_RETURN_BUTTON")?>">
</form>
