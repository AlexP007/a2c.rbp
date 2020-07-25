<?php

/**
 * Компонент Анимированная иконка
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
    "PARAMETERS" => [
        'LINK_TO'      => [
            'PARENT'  => 'BASE',
            'NAME'    =>  Loc::getMessage('A2C_RBP_ANIMATED_ICON_LINK_TO'),
            'TYPE'    => 'STRING',
        ],
        'LINK_CLASS'   => [
            'PARENT'  => 'BASE',
            'NAME'    =>  Loc::getMessage('A2C_RBP_ANIMATED_ICON_LINK_CLASS'),
            'TYPE'    => 'STRING',
        ],
        'ICON_CLASS'   => [
            'PARENT'  => 'BASE',
            'NAME'    =>  Loc::getMessage('A2C_RBP_ANIMATED_ICON_ICON_CLASS'),
            'TYPE'    => 'STRING',
        ],
    ]
];

