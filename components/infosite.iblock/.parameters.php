<?php

/**
 * Компонент Инфо-сайт инфоблок
 * Параметры
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

use A2C\RBP\Helpers\Tools;

Loader::includeModule('a2c.rbp') or Tools::showModuleError('a2c.rbp');

$arComponentParameters = [
    "PARAMETERS" => [
        "IBLOCK_TYPE_ID" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => Loc::getMessage("A2C_RBP_INFOSITE_IBLOCK_IBLOCK_TYPE"),
            "TYPE" => "STRING",
        ],
    ]
];
