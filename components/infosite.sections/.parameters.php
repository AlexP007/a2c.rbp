<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

/**
 * Компонент Инфо-сайт Секции инфоблока
 * Параметры
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */

use Bitrix\Main\Localization\Loc;

$arComponentParameters = [
    "PARAMETERS" => [
        "IBLOCK_FILTER_KEY" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => Loc::getMessage("A2C_RBP_INFOSITE_SECTIONS_IBLOCK_FILTER_KEY"),
            "TYPE" => "STRING",
        ],
        "IBLOCK_FILTER_VALUE" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => Loc::getMessage("A2C_RBP_INFOSITE_SECTIONS_IBLOCK_FILTER_VALUE"),
            "TYPE" => "STRING",
        ],
        'USE_SECTION_USER_FIELDS' => [
            "PARENT"  => "ADDITIONAL_SETTINGS",
            "NAME"    => Loc::getMessage('A2C_RBP_INFOSITE_SECTIONS_USE_SECTION_USER_FIELDS'),
            "TYPE"    => "CHECKBOX",
            "DEFAULT" => "N"
        ],
        "IMAGE_HEIGHT" => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_SECTIONS_IMAGE_HEIGHT"),
            "TYPE"   => "STRING",
        ],
        "IMAGE_WIDTH"  => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_SECTIONS_IMAGE_WIDTH"),
            "TYPE"   => "STRING",
        ],
    ]
];