<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use Bitrix\Main\Loader;

use A2C\RBP\Component\Basic;
use A2C\RBP\Helpers\{Assets, Tools};

Loader::includeModule('a2c.rbp') or Tools::showModuleError('a2c.rbp');

/**
 * Компонент Анимированная иконка
 *
 * Class A2cRbpAnimatedIcon
 * Иконка с эффектом подпрыгивания
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
class A2cRbpAnimatedIcon extends Basic
{
    public function onPrepareComponentParams($arParams)
    {
        if (!empty($arParams['LINK_CLASS'])) {
            $arParams['LINK_CLASS'] .=  " " . RBP_ANIMATED_ICON_CLASS;
        } else {
            $arParams['LINK_CLASS'] = RBP_ANIMATED_ICON_CLASS;
        }
        return parent::onPrepareComponentParams($arParams);
    }

    public function executeComponent()
    {
        Assets::initExt();
        $this->includeComponentTemplate();
    }
}
