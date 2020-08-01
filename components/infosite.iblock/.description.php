<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use Bitrix\Main\Localization\Loc;

$arComponentDescription = [
    "NAME" => Loc::getMessage("A2C_RBP_INFOSITE_IBLOCK_COMPONENT_NAME"),
    "DESCRIPTION" => Loc::getMessage("A2C_RBP_INFOSITE_IBLOCK_COMPONENT_DESCRIPTION"),
    "SORT" => 3,
    "CACHE_PATH" => "Y",
    "COMPLEX" => "N",
    "PATH" => [
        "ID" => 'A2C',
        "CHILD" => [
            "ID" => 'resume_blog_pack',
            "NAME" => Loc::getMessage("A2C_RBP_INFOSITE_IBLOCK_MODULE_NAME"),
            "SORT" => 30,
        ],
    ],
];