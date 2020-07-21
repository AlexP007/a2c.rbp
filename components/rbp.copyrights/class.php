<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use Bitrix\Main\Loader;

use A2C\RBP\Component\Basic;

Loader::includeModule('a2c.rbp') or ShowError('Can\'t connect module a2c.rbp');

class A2cRbpCopyrights extends Basic
{
    public function onPrepareComponentParams($arParams)
    {
        $this->arParams['YEAR'] = trim($this->arParams['YEAR']);
        $this->arParams['THIS_YEAR'] = date('Y');
        return parent::onPrepareComponentParams($arParams);
    }

    public function executeComponent()
    {
        $arParams = $this->arParams;

        $copyright = '';
        if (strstr($arParams['YEAR'], $arParams['THIS_YEAR'])) {
            $copyright .= "${arParams['THIS_YEAR']}";
        } else {
            $copyright .= "${arParams['YEAR']}-${arParams['THIS_YEAR']}";
        }

        $this->arResult['COPYRIGHT'] = "$copyright ${arParams['TEXT']}";

        $this->includeComponentTemplate();
    }
}
