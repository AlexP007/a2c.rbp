<?php

/**
 * Компонент Инфо-сайт
 * Шаблоны
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}


$APPLICATION->IncludeComponent(
    "a2c.rbp:infosite.sections",
    "",
    Array(
        'USE_SECTION_USER_FIELDS' => $arParams['USE_SECTION_USER_FIELDS'],
        "IMAGE_HEIGHT"            => $arParams["SECTIONS_IMAGE_HEIGHT"],
        "IMAGE_WIDTH"             => $arParams["SECTIONS_IMAGE_WIDTH"],
    ),
    $component
);
