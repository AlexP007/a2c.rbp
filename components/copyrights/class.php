<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use Bitrix\Main\Loader;

use A2C\RBP\Component\Basic;
use A2C\RBP\Helpers\Tools;

Loader::includeModule('a2c.rbp') or Tools::showModuleError('a2c.rbp');

/**
 * Компонент Копирайт
 *
 * Class A2cRbpCopyrights
 * Создает блок с информацией о копирайте
 * Динамически вычесляет текущуй год
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
class A2cRbpCopyrights extends Basic
{
    public function onPrepareComponentParams($arParams)
    {
        $arParams['YEAR'] = trim($arParams['YEAR']);
        $arParams['THIS_YEAR'] = date('Y');
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
