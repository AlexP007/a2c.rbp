<?php

/**
 * Компонент Инфо-сайт
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
        "VARIABLE_ALIASES" => [
            "IBLOCK_ID"  => ["NAME" => Loc::getMessage("A2C_RBP_INFOSITE_VARIABLE_ALIASES_IBLOCK_ID")],
            "SECTION_ID" => ["NAME" => Loc::GetMessage("A2C_RBP_INFOSITE_VARIABLE_ALIASES_SECTION_ID")],
            "ELEMENT_ID" => ["NAME" => Loc::GetMessage("A2C_RBP_INFOSITE_VARIABLE_ALIASES_ELEMENT_ID")],
        ],
        "SEF_MODE" => [
            "iblock" => [
                "NAME" => Loc::GetMessage("A2C_RBP_INFOSITE_SEF_MODE_IBLOCK"),
                "DEFAULT" => "index.php",
                "VARIABLES" => []
            ],
            "section" => [
                "NAME" => Loc::GetMessage("A2C_RBP_INFOSITE_SEF_MODE_SECTION"),
                "DEFAULT" => "#SECTION_ID#",
                "VARIABLES" => ["SECTION_ID"],
            ],
            "detail" => [
                "NAME" => Loc::GetMessage("A2C_RBP_INFOSITE_SEF_MODE_DETAIL"),
                "DEFAULT" => "#SECTION_ID#/#ELEMENT_ID#/",
                "VARIABLES" => ["SECTION_ID", "ELEMENT_ID"],
            ],
        ],
        "IBLOCK_TYPE" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => Loc::getMessage("A2C_RBP_INFOSITE_IBLOCK_TYPE"),
            "TYPE" => "LIST",
            "VALUES" => Parameters::getIBlocks(),
        ],
    ]
];
