<?php

/**
 * Компонент Анимированная иконка
 * Описание
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

$arComponentDescription = [
    "NAME" => Loc::getMessage("A2C_RBP_ANIMATED_ICON_COMPONENT_NAME"),
    "DESCRIPTION" => Loc::getMessage("A2C_RBP_ANIMATED_ICON_COMPONENT_DESCRIPTION"),
    "SORT" => 15,
    "CACHE_PATH" => "Y",
    "PATH" => [
        "ID" => 'A2C',
        "CHILD" => [
            "ID" => 'resume_blog_pack',
            "NAME" => Loc::getMessage("A2C_RBP_ANIMATED_ICON_MODULE_NAME"),
            "SORT" => 30,
        ],
    ],
];