<?php

/**
 * Компонент Аккордион
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

use Bitrix\Main\Localization\Loc;

$arComponentParameters = [
    'PARAMETERS' => [
        'ID'            => [
            'PARENT' => 'BASE',
            'NAME'   => Loc::getMessage('A2C_RBP_ACCORDION_ID'),
            'TYPE'   => 'STRING',
        ],
        'HEADING'       => [
            'PARENT' => 'BASE',
            'NAME'   => Loc::getMessage('A2C_RBP_ACCORDION_HEADING'),
            'TYPE'   => 'STRING',
        ],
        'CAPTURE'       => [
            'PARENT' => 'BASE',
            'NAME'   => Loc::getMessage('A2C_RBP_ACCORDION_CAPTURE'),
            'TYPE'   => 'STRING',
        ],
        'MAIN'          => [
            'PARENT' => 'BASE',
            'NAME'   => Loc::getMessage('A2C_RBP_ACCORDION_MAIN'),
            'TYPE'   => 'STRING',
        ],
        'ICON_DOWN'     => [
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME'   => Loc::getMessage('A2C_RBP_ACCORDION_ICON_DOWN'),
            'TYPE'   => 'STRING',
        ],
        'ICON_UP'       => [
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME'   => Loc::getMessage('A2C_RBP_ACCORDION_ICON_UP'),
            'TYPE'   => 'STRING',
        ],
        'HEADING_CLASS' => [
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME'   => Loc::getMessage('A2C_RBP_ACCORDION_HEADING_CLASS'),
            'TYPE'   => 'STRING',
        ],
    ]
];
