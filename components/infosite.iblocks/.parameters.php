<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

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

use Bitrix\Main\Localization\Loc;

$arComponentParameters = [
    "PARAMETERS" => [
        "CACHE_TIME"   => ["DEFAULT" => 36000000],
        "IBLOCK_TYPE_ID" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => Loc::getMessage("A2C_RBP_INFOSITE_IBLOCKS_IBLOCK_TYPE_ID"),
            "TYPE" => "STRING",
        ],
        "IMAGE_HEIGHT" => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_IBLOCKS_IMAGE_HEIGHT"),
            "TYPE"   => "STRING",
        ],
        "IMAGE_WIDTH"  => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_IBLOCKS_IMAGE_WIDTH"),
            "TYPE"   => "STRING",
        ],
        "SET_BREADCRUMBS"  => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_IBLOCKS_SET_BREADCRUMBS"),
            "TYPE"   => "CHECKBOX",
        ],
    ]
];
