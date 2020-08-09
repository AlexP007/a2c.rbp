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
 * Компонент Инфо-сайт Детальная страница элемента
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
class A2cRbpInfositeDetail extends Basic
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
            $element = $elementsResult->GetNext();

            if (empty($element)) {
                $this->abortResultCache();
                $this->set404();
            }

            $element['DETAIL_PICTURE'] = $this->cropPicture($element['DETAIL_PICTURE']);

            if ($arParams['USE_ELEMENT_PROPERTIES'] === 'Y') {
                $this->setElementProps($element);
            }

            $this->arResult['ELEMENT'] = $element;
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
                $elementKey = $parentResult['ALIASES']["ELEMENT"] ?? 'ELEMENT_ID';
                $elementValue = $parentResult['VARIABLES'][$parentResult['ALIASES']["ELEMENT"]]
                    ?? $parentResult['VARIABLES']['ELEMENT'];
                $filter = [
                    $iblockKey  => $iblockValue,
                    $sectionKey => $sectionValue,
                    $elementKey => $elementValue
                ];
            }
        } else {
            $iblockKey = $arParams['~IBLOCK_FILTER_KEY'];
            $iblockValue = $arParams['~IBLOCK_FILTER_VALUE'];
            $sectionKey = $arParams['~SECTION_FILTER_KEY'];
            $sectionValue = $arParams['~SECTION_FILTER_VALUE'];
            $elementKey = $arParams['~ELEMENT_FILTER_KEY'];
            $elementValue = $arParams['~ELEMENT_FILTER_VALUE'];
            $filter = [
                $iblockKey  => $iblockValue,
                $sectionKey => $sectionValue,
                $elementKey => $elementValue
            ];
        }
        return  array_merge($filter, ['ACTIVE' => 'Y']);
    }

    private function setElementProps(array &$element)
    {
        $iblockId = $element['IBLOCK_ID'];
        $eltId = $element['ID'];
        $props = CIBlockElement::GetProperty($iblockId, $eltId)->Fetch();
        $element['PROPERTIES'] = $props;
    }
}
