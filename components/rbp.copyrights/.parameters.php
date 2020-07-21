<?php

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