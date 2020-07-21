<?php

/**
 * Компонент Иконки
 * Параметры
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

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

use A2C\RBP\Helpers\{Parameters, Tools};

Loader::includeModule('a2c.rbp') or Tools::showModuleError('a2c.rbp');

$arComponentParameters = [
    "PARAMETERS" => [
        'IBLOCK_ID' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('A2C_RBP_CONTACT_IBLOCK_ID'),
            'TYPE' => 'LIST',
            'VALUES' => Parameters::getIBlocks(),
            'REFRESH' => "Y",
        ],
    ]
];

$iblockId = $arCurrentValues['IBLOCK_ID'];

// Если есть ID инфоблока, то получим список элементов
$elts = isset($iblockId) ? Parameters::getIElements((int) $iblockId) : [];

if (!empty($elts) ) {
    $arComponentParameters['PARAMETERS'] = array_merge($arComponentParameters['PARAMETERS'], [
        'ELEMENT_ID' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('A2C_RBP_CONTACT_ELEMENT_ID'),
            'TYPE' => 'LIST',
            'VALUES' => $elts,
            'REFRESH' => "Y",
        ],
    ]);
}

// Если есть ID инфоблока, то получем свойства
$props = isset($iblockId) ? Parameters::getIProps((int) $iblockId) : [];

if (isset($arCurrentValues['ELEMENT_ID']) ) {
    $arComponentParameters['PARAMETERS'] = array_merge($arComponentParameters['PARAMETERS'], [
        'TELEPHONE' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME'   => Loc::getMessage('A2C_RBP_CONTACT_TELEPHONE'),
            'TYPE'   => 'LIST',
            'VALUES' => $props,
        ],
        'MAIL'      => [
            'PARENT' => 'DATA_SOURCE',
            'NAME'   => Loc::getMessage('A2C_RBP_CONTACT_MAIL'),
            'TYPE'   => 'LIST',
            'VALUES' => $props,
        ],
        'ADDRESS'   => [
            'PARENT' => 'DATA_SOURCE',
            'NAME'   => Loc::getMessage('A2C_RBP_CONTACT_ADDRESS'),
            'TYPE'   => 'LIST',
            'VALUES' => $props,
        ],
        'INSTAGRAM' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME'   => Loc::getMessage('A2C_RBP_CONTACT_INSTAGRAM'),
            'TYPE'   => 'LIST',
            'VALUES' => $props,
        ],
        'TELEGRAM'  => [
            'PARENT' => 'DATA_SOURCE',
            'NAME'   => Loc::getMessage('A2C_RBP_CONTACT_TELEGRAM'),
            'TYPE'   => 'LIST',
            'VALUES' => $props,
        ],
        'TWITTER'   => [
            'PARENT' => 'DATA_SOURCE',
            'NAME'   => Loc::getMessage('A2C_RBP_CONTACT_TWITTER'),
            'TYPE'   => 'LIST',
            'VALUES' => $props,
        ],
        'GITHUB'    => [
            'PARENT' => 'DATA_SOURCE',
            'NAME'   => Loc::getMessage('A2C_RBP_CONTACT_GITHUB'),
            'TYPE'   => 'LIST',
            'VALUES' => $props,
        ],
    ]);
}