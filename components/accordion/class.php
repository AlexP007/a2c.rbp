<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use Bitrix\Main\Loader;

use A2C\RBP\Component\Basic;
use A2C\RBP\Helpers\{Assets, Tools};

Loader::includeModule('a2c.rbp') or Tools::showModuleError('a2c.rbp');

/**
 * Компонент Аккордион
 *
 * Class A2cRbpAccordion
 * Графический элемент аккордион
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
class A2cRbpAccordion extends Basic
{
    public function executeComponent()
    {
        Assets::initExt();
        $this->includeComponentTemplate();
    }
}
