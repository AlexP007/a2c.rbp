<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use Bitrix\Main\Localization\Loc;

require_once '../../constants.php';

$arComponentDescription = [
    "NAME" => Loc::getMessage("A2C_RBP_COPYRIGHTS_COMPONENT_NAME"),
    "DESCRIPTION" => Loc::getMessage("A2C_RBP_COPYRIGHTS_DESCRIPTION"),
    "SORT" => 5,
    "CACHE_PATH" => "Y",
    "PATH" => [
        "ID" => PARTNER_NAME,
        "CHILD" => [
            "ID" => MODULE_NAME,
            "NAME" => Loc::getMessage("A2C_RBP_COPYRIGHTS_GROUP_NAME"),
            "SORT" => 30,
        ],
    ],
];