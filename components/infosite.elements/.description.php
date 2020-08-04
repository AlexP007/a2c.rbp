<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

/**
 * Компонент Инфо-сайт Элементы секций
 * Описание
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */

use Bitrix\Main\Localization\Loc;

$arComponentDescription = [
    "NAME" => Loc::getMessage("A2C_RBP_INFOSITE_ELEMENTS_COMPONENT_NAME"),
    "DESCRIPTION" => Loc::getMessage("A2C_RBP_INFOSITE_ELEMENTS_COMPONENT_DESCRIPTION"),
    "SORT" => 3,
    "CACHE_PATH" => "Y",
    "COMPLEX" => "N",
    "PATH" => [
        "ID" => 'A2C',
        "CHILD" => [
            "ID" => 'resume_blog_pack',
            "NAME" => Loc::getMessage("A2C_RBP_INFOSITE_ELEMENTS_MODULE_NAME"),
            "SORT" => 30,
        ],
    ],
];