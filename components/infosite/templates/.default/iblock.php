<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

$APPLICATION->IncludeComponent(
    "a2c.rbp:infosite.iblock",
    "",
    Array(
        "IBLOCK_TYPE_ID" => $arParams["IBLOCK_TYPE_ID"],
    )
);
