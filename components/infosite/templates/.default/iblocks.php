<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

$APPLICATION->IncludeComponent(
    "a2c.rbp:infosite.iblocks",
    "",
    Array(
        "IBLOCK_TYPE_ID"  => $arParams["IBLOCK_TYPE_ID"],
        "IMAGE_HEIGHT"    => $arParams["IBLOCKS_IMAGE_HEIGHT"],
        "IMAGE_WIDTH"     => $arParams["IBLOCKS_IMAGE_WIDTH"],
        "SET_BREADCRUMBS" => $arParams["SET_BREADCRUMBS"],
        "CACHE_TYPE"      => $arParams["CACHE_TYPE"],
        "CACHE_TIME"      => $arParams["CACHE_TIME"],
    ),
    $component
);
