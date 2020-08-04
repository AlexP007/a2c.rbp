<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use Bitrix\Main\Loader;
use CIBlockSection;

use A2C\RBP\Component\Basic;
use A2C\RBP\Helpers\{Iblock, Tools};

Loader::includeModule('a2c.rbp') or Tools::showModuleError('a2c.rbp');

/**
 * Компонент Инфо-сайт Секции инфоблока
 *
 * Class A2cRbpInfositeSections
 * Выводит все инфоблоки одного типа
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
class A2cRbpInfositeSections extends Basic
{
    public function onPrepareComponentParams($arParams)
    {
        return parent::onPrepareComponentParams($arParams);
    }

    public function executeComponent()
    {
        Iblock::includeModule();
        $arParams = $this->arParams;
        if ($this->startResultCache(false)) {
            $key = $arParams['~IBLOCK_FILTER_KEY'];
            $value = $arParams['~IBLOCK_FILTER_VALUE'];

            $sectionsResult = CIBlockSection::GetList(
                ['SORT' => 'ASC'],
                [$key => $value, 'ACTIVE' => 'Y']
            );
            $sectionsResult->SetUrlTemplates();
            $sections = [];
            while ($s = $sectionsResult->GetNext()) {
                $sections[] = $s;
            }

            if (empty($sections)) {
                $this->abortResultCache();
                $this->set404();
            }

            $this->arResult['SECTIONS'] = $sections;
            $this->includeComponentTemplate();
        }
    }
}