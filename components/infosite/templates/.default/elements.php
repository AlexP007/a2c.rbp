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
        "IBLOCK_FILTER_KEY"       => $arResult['ALIASES']["IBLOCK"] ?? 'IBLOCK_ID',
        "IBLOCK_FILTER_VALUE"     => $arResult['VARIABLES'][$arResult['ALIASES']["IBLOCK"]] ?? $arResult['VARIABLES']['IBLOCK'],
        "SECTION_FILTER_KEY"      => $arResult['ALIASES']["SECTION"] ?? 'SECTION_ID',
        "SECTION_FILTER_VALUE"    => $arResult['VARIABLES'][$arResult['ALIASES']["SECTION"]] ?? $arResult['VARIABLES']['SECTION'],
        'USE_ELEMENTS_PROPERTIES' => $arParams['USE_ELEMENTS_PROPERTIES'],
        "IMAGE_HEIGHT"            => $arParams["ELEMENTS_IMAGE_HEIGHT"],
        "IMAGE_WIDTH"             => $arParams["ELEMENTS_IMAGE_WIDTH"],
    ),
    $component
);