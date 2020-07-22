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
    'GROUPS' => [
        'MODAL_SETTINGS' => [
            'NAME' => Loc::getMessage('A2C_CHECKOUT_COMPONENTS_CART_ADD_PARAMETERS_GROUPS_MODAL_SETTINGS'),
            'SORT' => 900,
        ],
    ],
    "PARAMETERS" => [
        "CACHE_TIME"  =>  ["DEFAULT"=>36000000],
        'GROUP_ID' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('A2C_RBP_CONTACT_GROUP_ID'),
            'TYPE' => 'LIST',
            'VALUES' => Parameters::getGroups(),
            'REFRESH' => "Y",
        ],
        'CONTAINER_CLASS' => [
            'PARENT' => 'VISUAL',
            'NAME' => Loc::getMessage('A2C_RBP_CONTACT_CONTAINER_CLASS'),
            'TYPE' => 'STRING',
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
        'NAME' => Loc::getMessage('A2C_RBP_CONTACT_USER_ID'),
        'TYPE' => 'LIST',
        'VALUES' => Parameters::getUsers((int) $groupId),
        'REFRESH' => "Y",
    ],
]);

$userId = $arCurrentValues['USER_ID'];

// Если есть ID пользователя, то получим свойства
$props = isset($iblockId) ? Parameters::getUserProps((int) $userId) : [];


if (!empty($props)) {
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