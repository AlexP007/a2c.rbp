<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use A2C\RBP\Component\Basic;

class A2cRbpCopyrights extends Basic
{
    public function onPrepareComponentParams($arParams)
    {
        $this->arParams['THIS_YEAR'] = date('Y');
        return parent::onPrepareComponentParams($arParams);
    }

    public function executeComponent()
    {
        $arParams = $this->arParams;

        $copyright = '';
        if (strstr($arParams['YEAR'], $this->arParams['THIS_YEAR'])) {
            $copyright .= "${arParams['THIS_YEAR']}";
        } else {
            $copyright .= "${arParams['YEAR']}-${arParams['THIS_YEAR']}";
        }

        $this->arResult['COPYRIGHT'] = "$copyright ${arParams['TEXT']}";

        $this->includeComponentTemplate();
    }
}
