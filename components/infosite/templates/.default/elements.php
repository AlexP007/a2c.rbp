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
    "a2c.rbp:infosite.elements",
    "",
    Array(
        'USE_ELEMENTS_PROPERTIES' => $arParams['USE_ELEMENTS_PROPERTIES'],
        "IMAGE_HEIGHT"            => $arParams["ELEMENTS_IMAGE_HEIGHT"],
        "IMAGE_WIDTH"             => $arParams["ELEMENTS_IMAGE_WIDTH"],
    ),
    $component
);