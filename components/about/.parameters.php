<?php

/**
 * Компонент О пользователе
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
    'GROUPS'     => [
        'BUTTON' => [
            'NAME' => Loc::getMessage('A2C_RBP_ABOUT_BUTTON'),
            'SORT' => 950,
        ],
    ],
    "PARAMETERS" => [
        "CACHE_TIME"   => ["DEFAULT" => 36000000],
        'HEADING'      => [
            'PARENT'  => 'BASE',
            'NAME'    => Loc::getMessage('A2C_RBP_ABOUT_HEADING'),
            'TYPE'    => 'STRING',
            'DEFAULT' => 'Обо мне'
        ],
        'GROUP_ID'     => [
            'PARENT'  => 'DATA_SOURCE',
            'NAME'    => Loc::getMessage('A2C_RBP_ABOUT_GROUP_ID'),
            'TYPE'    => 'LIST',
            'VALUES'  => Parameters::getGroups(),
            'REFRESH' => "Y",
        ],
        'BUTTON_TEXT'  => [
            'PARENT' => 'BUTTON',
            'NAME'   => Loc::getMessage('A2C_RBP_ABOUT_BUTTON_TEXT'),
            'TYPE'   => 'STRING',
        ],
        'BUTTON_LINK'  => [
            'PARENT' => 'BUTTON',
            'NAME'   => Loc::getMessage('A2C_RBP_ABOUT_BUTTON_LINK'),
            'TYPE'   => 'STRING',
        ],
        'BUTTON_CLASS' => [
            'PARENT' => 'BUTTON',
            'NAME'   => Loc::getMessage('A2C_RBP_ABOUT_BUTTON_CLASS'),
            'TYPE'   => 'STRING',
        ],
    ]
];
$groupId = $arCurrentValues['GROUP_ID'];
if (empty($groupId)) {
    return;
}

$arComponentParameters['PARAMETERS'] = array_merge($arComponentParameters['PARAMETERS'], [
    'USER_ID' => [
        'PARENT'  => 'DATA_SOURCE',
        'NAME'    => Loc::getMessage('A2C_RBP_ABOUT_USER_ID'),
        'TYPE'    => 'LIST',
        'VALUES'  => Parameters::getUsers((int)$groupId),
        'REFRESH' => "Y",
    ],
]);

$userId = $arCurrentValues['USER_ID'];

// Если есть ID пользователя, то получим свойства
$props = isset($userId) ? Parameters::getUserProps((int) $userId) : [];

if (!empty($props)) {
    $arComponentParameters['PARAMETERS'] = array_merge($arComponentParameters['PARAMETERS'], [
        'ABOUT'        => [
            'PARENT' => 'DATA_SOURCE',
            'NAME'   => Loc::getMessage('A2C_RBP_ABOUT_ABOUT'),
            'TYPE'   => 'LIST',
            'VALUES' => $props,
        ],
        "IMAGE_HEIGHT" => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME"   => Loc::getMessage("A2C_RBP_ABOUT_IMAGE_HEIGHT"),
            "TYPE"   => "STRING",
        ],
        "IMAGE_WIDTH"  => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME"   => Loc::getMessage("A2C_RBP_ABOUT_IMAGE_WIDTH"),
            "TYPE"   => "STRING",
        ],
        'HIDE_EMAIL'   => [
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME'   => Loc::getMessage('A2C_RBP_ABOUT_HIDE_EMAIL'),
            'TYPE'   => 'CHECKBOX',
        ],
    ]);
}