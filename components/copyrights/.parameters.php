<?php

/**
 * Компонент Копирайт
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

use Bitrix\Main\Localization\Loc;

$arComponentParameters = [
    "PARAMETERS" => [
        "YEAR" => [
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("A2C_RBP_COPYRIGHTS_YEAR"),
            "TYPE" => "STRING",
        ],
        "TEXT" => [
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("A2C_RBP_COPYRIGHTS_TEXT"),
            "TYPE" => "STRING",
        ],
    ]
];