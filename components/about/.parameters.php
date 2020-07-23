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
    "PARAMETERS" => [
        "CACHE_TIME"  =>  ["DEFAULT"=>36000000],
        'GROUP_ID' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('A2C_RBP_ABOUT_GROUP_ID'),
            'TYPE' => 'LIST',
            'VALUES' => Parameters::getGroups(),
            'REFRESH' => "Y",
        ],
    ]
];
$groupId = $arCurrentValues['GROUP_ID'];
if (empty($groupId)) {
    return;
}

$arComponentParameters['PARAMETERS'] = array_merge($arComponentParameters['PARAMETERS'], [
    'USER_ID' => [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => Loc::getMessage('A2C_RBP_ABOUT_USER_ID'),
        'TYPE' => 'LIST',
        'VALUES' => Parameters::getUsers((int) $groupId),
        'REFRESH' => "Y",
    ],
]);

$userId = $arCurrentValues['USER_ID'];

// Если есть ID пользователя, то получим свойства
$props = isset($userId) ? Parameters::getUserProps((int) $userId) : [];

if (!empty($props)) {
    $arComponentParameters['PARAMETERS'] = array_merge($arComponentParameters['PARAMETERS'], [
        'ABOUT' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME'   => Loc::getMessage('A2C_RBP_ABOUT_ABOUT'),
            'TYPE'   => 'LIST',
            'VALUES' => $props,
        ],
    ]);
}