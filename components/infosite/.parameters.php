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

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

use A2C\RBP\Helpers\{Parameters, Tools};

Loader::includeModule('a2c.rbp') or Tools::showModuleError('a2c.rbp');

$arComponentParameters = [
    'GROUPS' => [
        'IBLOCKS' => [
            'NAME' => Loc::getMessage('A2C_RBP_INFOSITE_GROUP_IBLOCKS'),
            'SORT' => 450,
        ],
        'SECTIONS' => [
            'NAME' => Loc::getMessage('A2C_RBP_INFOSITE_GROUP_SECTIONS'),
            'SORT' => 460,
        ],
        'ELEMENTS' => [
            'NAME' => Loc::getMessage('A2C_RBP_INFOSITE_GROUP_ELEMENTS'),
            'SORT' => 460,
        ],
        'DETAIL' => [
            'NAME' => Loc::getMessage('A2C_RBP_INFOSITE_GROUP_DETAIL'),
            'SORT' => 470,
        ],
    ],
    "PARAMETERS" => [
        "VARIABLE_ALIASES" => [
            "IBLOCK"  => ["NAME" => Loc::getMessage("A2C_RBP_INFOSITE_VARIABLE_ALIASES_IBLOCK_ID")],
            "SECTION" => ["NAME" => Loc::GetMessage("A2C_RBP_INFOSITE_VARIABLE_ALIASES_SECTION_ID")],
            "ELEMENT" => ["NAME" => Loc::GetMessage("A2C_RBP_INFOSITE_VARIABLE_ALIASES_ELEMENT_ID")],
        ],
        "SEF_MODE" => [
            "iblocks"  => [
                "NAME"      => Loc::GetMessage("A2C_RBP_INFOSITE_SEF_MODE_IBLOCKS"),
                "DEFAULT"   => "index.php",
                "VARIABLES" => []
            ],
            "sections" => [
                "NAME"      => Loc::GetMessage("A2C_RBP_INFOSITE_SEF_MODE_SECTIONS"),
                "DEFAULT"   => "#IBLOCK_ID#/",
                "VARIABLES" => ["IBLOCK_ID"],
            ],
            "elements" => [
                "NAME"      => Loc::GetMessage("A2C_RBP_INFOSITE_SEF_MODE_ELEMENTS"),
                "DEFAULT"   => "#IBLOCK_ID#/#SECTION_ID#/",
                "VARIABLES" => ["IBLOCK_ID", "SECTION_ID"],
            ],
            "detail"  => [
                "NAME"      => Loc::GetMessage("A2C_RBP_INFOSITE_SEF_MODE_DETAIL"),
                "DEFAULT"   => "#IBLOCK_ID#/#SECTION_ID#/#ID#/",
                "VARIABLES" => ["IBLOCK_ID", "SECTION_ID", "ID"],
            ],
        ],
        "CACHE_TIME"   => ["DEFAULT" => 36000000],
        // DATA_SOURCE
        "IBLOCK_TYPE_ID" => [
            "PARENT" => "DATA_SOURCE",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_IBLOCK_TYPE_ID"),
            "TYPE"   => "LIST",
            "VALUES" => Parameters::getIblockTypes(),
        ],
        // IBLOCKS
        "IBLOCKS_IMAGE_HEIGHT" => [
            "PARENT" => "IBLOCKS",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_IBLOCKS_IMAGE_HEIGHT"),
            "TYPE"   => "STRING",
        ],
        "IBLOCKS_IMAGE_WIDTH"  => [
            "PARENT" => "IBLOCKS",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_IBLOCKS_IMAGE_WIDTH"),
            "TYPE"   => "STRING",
        ],
        // SECTIONS
        'USE_SECTION_USER_FIELDS' => [
            "PARENT"  => "SECTIONS",
            "NAME"    => Loc::getMessage('A2C_RBP_INFOSITE_USE_SECTION_USER_FIELDS'),
            "TYPE"    => "CHECKBOX",
            "DEFAULT" => "N"
        ],
        "SECTIONS_IMAGE_HEIGHT" => [
            "PARENT" => "SECTIONS",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_SECTIONS_IMAGE_HEIGHT"),
            "TYPE"   => "STRING",
        ],
        "SECTIONS_IMAGE_WIDTH"  => [
            "PARENT" => "SECTIONS",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_SECTIONS_IMAGE_WIDTH"),
            "TYPE"   => "STRING",
        ],
        // ELEMENTS
        'USE_ELEMENTS_PROPERTIES' => [
            "PARENT"  => "ELEMENTS",
            "NAME"    => Loc::getMessage('A2C_RBP_INFOSITE_USE_ELEMENTS_PROPERTIES'),
            "TYPE"    => "CHECKBOX",
            "DEFAULT" => "N"
        ],
        "ELEMENTS_IMAGE_HEIGHT" => [
            "PARENT" => "ELEMENTS",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_ELEMENTS_IMAGE_HEIGHT"),
            "TYPE"   => "STRING",
        ],
        "ELEMENTS_IMAGE_WIDTH"  => [
            "PARENT" => "ELEMENTS",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_ELEMENTS_IMAGE_WIDTH"),
            "TYPE"   => "STRING",
        ],
        // DETAIL
        'USE_ELEMENT_PROPERTIES' => [
            "PARENT"  => "DETAIL",
            "NAME"    => Loc::getMessage('A2C_RBP_INFOSITE_USE_ELEMENT_PROPERTIES'),
            "TYPE"    => "CHECKBOX",
            "DEFAULT" => "N"
        ],
        "DETAIL_IMAGE_HEIGHT" => [
            "PARENT" => "DETAIL",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_DETAIL_IMAGE_HEIGHT"),
            "TYPE"   => "STRING",
        ],
        "DETAIL_IMAGE_WIDTH"  => [
            "PARENT" => "DETAIL",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_DETAIL_IMAGE_WIDTH"),
            "TYPE"   => "STRING",
        ],
        // ADDITIONAL_SETTINGS
        "SET_BREADCRUMBS"  => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_SET_BREADCRUMBS"),
            "TYPE"   => "CHECKBOX",
        ],
        "SET_TITLE"  => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME"   => Loc::getMessage("A2C_RBP_INFOSITE_SET_TITLE"),
            "TYPE"   => "CHECKBOX",
        ],
    ]
];
