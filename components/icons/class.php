<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use CIBlockElement;
use Bitrix\Main\Loader;

use A2C\RBP\Component\Basic;
use A2C\RBP\Helpers\Tools;

Loader::includeModule('a2c.rbp') or Tools::showModuleError('a2c.rbp');


/**
 * Компонент Иконки
 *
 * Class A2cRbpIcons
 * Создает блок с иконками и ссылками
 * Использует инфоблок и его свойства
 * Два шаблона: 1) В линию 2) Блоками
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */

class A2cRbpIcons extends Basic
{
    public function executeComponent()
    {
        // tag cache
        if ($this->startResultCache(false)) {

            if (!Loader::includeModule("iblock")) {
                $this->abortResultCache();
                Tools::showModuleError('iblock');
            }

            // fetching data


            $this->setResultCacheKeys([]);
            $this->includeComponentTemplate();
        }
    }
}