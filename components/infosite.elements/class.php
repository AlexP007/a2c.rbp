<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use Bitrix\Main\Loader;
use CIBlockElement;


use A2C\RBP\Component\Basic;
use A2C\RBP\Helpers\{Iblock, Tools};

Loader::includeModule('a2c.rbp') or Tools::showModuleError('a2c.rbp');

/**
 * Компонент Инфо-сайт Элементы секций
 *
 * Class A2cRbpInfositeElements
 * Выводит все инфоблоки одного типа
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
class A2cRbpInfositeElements extends Basic
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
            $filter = $this->prepareFilter();
            $elementsResult = CIBlockElement::GetList(
                ['SORT' => 'ASC'],
                $filter
            );
            $elementsResult->SetUrlTemplates();
            $elements = [];
            while ($s = $elementsResult->GetNext()) {
                $elements[] = $s;
            }

            if (empty($elements)) {
                $this->abortResultCache();
                $this->set404();
            }

            foreach ($elements as &$s) {
                $s['PREVIEW_PICTURE'] = $this->cropPicture($s['PREVIEW_PICTURE']);
            }

            if ($arParams['USE_ELEMENTS_PROPERTIES'] === 'Y') {
                $this->setElementsProps($elements);
            }

            $this->arResult['ELEMENTS'] = $elements;
            $this->includeComponentTemplate();
        }
    }

    private function prepareFilter(): array
    {
        $arParams = $this->arParams;
        if ($this->getParent()) {
            $parentResult = $this->getParent()->arResult;
            $parentParams = $this->getParent()->arParams;
            if ($parentParams['SEF_MODE'] === 'Y') {
                $filter = filter_var_array($parentResult['VARIABLES'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            } else {
                $iblockKey = $parentResult['ALIASES']["IBLOCK"] ?? 'IBLOCK_ID';
                $iblockValue = $parentResult['VARIABLES'][$parentResult['ALIASES']["IBLOCK"]]
                    ?? $parentResult['VARIABLES']['IBLOCK'];
                $sectionKey = $parentResult['ALIASES']["SECTION"] ?? 'SECTION_ID';
                $sectionValue = $parentResult['VARIABLES'][$parentResult['ALIASES']["SECTION"]]
                    ?? $parentResult['VARIABLES']['SECTION'];
                $filter = [
                    $iblockKey  => $iblockValue,
                    $sectionKey => $sectionValue
                ];
            }
        } else {
            $iblockKey = $arParams['~IBLOCK_FILTER_KEY'];
            $iblockValue = $arParams['~IBLOCK_FILTER_VALUE'];
            $sectionKey = $arParams['~SECTION_FILTER_KEY'];
            $sectionValue = $arParams['~SECTION_FILTER_VALUE'];
            $filter = [
                $iblockKey  => $iblockValue,
                $sectionKey => $sectionValue
            ];
        }
        return  array_merge($filter, ['ACTIVE' => 'Y']);
    }

    private function setElementsProps(array &$elements)
    {
        $props = [];
        $iblockId = $elements[0]['IBLOCK_ID'];
        CIBlockElement::GetPropertyValuesArray($props, $iblockId, []);
        foreach ($elements as &$element) {
            $eltId = $element['ID'];
            if (!empty($props[$eltId])) {
                $element['PROPERTIES'] = $props[$eltId];
            }
        }
    }
}
