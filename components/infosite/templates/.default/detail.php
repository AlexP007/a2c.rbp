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
    "a2c.rbp:infosite.detail",
    "",
    Array(
        'USE_ELEMENT_PROPERTIES' => $arParams['USE_ELEMENT_PROPERTIES'],
        "IMAGE_HEIGHT"           => $arParams["DETAIL_IMAGE_HEIGHT"],
        "IMAGE_WIDTH"            => $arParams["DETAIL_IMAGE_WIDTH"],
        "CACHE_TYPE"             => $arParams["CACHE_TYPE"],
        "CACHE_TIME"             => $arParams["CACHE_TIME"],
    ),
    $component
);