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

use Bitrix\Main\Loader;

use A2C\RBP\Component\Complex;
use A2C\RBP\Helpers\Tools;

Loader::includeModule('a2c.rbp') or Tools::showModuleError('a2c.rbp');

/**
 * Компонент Инфо-сайт
 *
 * Class A2cRbpInfosite
 * Комплексный компонент выводящий инфоблоки
 * по типу, их разделы и элементы
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
class A2cRbpInfosite extends Complex
{
    const DEFAULT_PAGE = 'iblock';

    protected function arDefaultUrlTemplates404(): array
    {
        return [
            'iblock'  => '',
            'section' => '#SECTION_ID#',
            'detail'  => '#SECTION_ID#/#ELEMENT_ID#/',
        ];
    }

    protected function arComponentVariables(): array
    {
        return [
            'SECTION_ID',
            'ELEMENT_ID',
        ];
    }

    protected function defaultComponentPage404(): string
    {
        return self::DEFAULT_PAGE;
    }

    protected function defineComponentPage(array $arVariables): string
    {
        if (intval($arVariables['ELEMENT_ID']) > 0) {
            return 'detail';
        }
        if (intval($arVariables['SECTION_ID']) > 0 ) {
            return 'section';
        }
        return self::DEFAULT_PAGE;
    }

    public function executeComponent()
    {
        $componentVariables = $this->InitComponentVariables();

        $this->arResult = [
            'FOLDER'        => $componentVariables['SEF_FOLDER'],
            'URL_TEMPLATES' => $componentVariables['TEMPLATES'],
            'VARIABLES'     => $componentVariables['VARIABLES'],
            'ALIASES'       => $componentVariables['VARIABLE_ALIASES'],
        ];

        $this->IncludeComponentTemplate($componentVariables['PAGE']);
    }
}
