<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use Bitrix\Main\Loader;
use CIBlockElement;

use A2C\RBP\Component\InfositeBasic;
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
class A2cRbpInfositeDetail extends InfositeBasic
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
            $element = $this->fetchElement();
            if (empty($element)) {
                $this->abortResultCache();
                $this->set404();
            }

            $element['DETAIL_PICTURE'] = $this->cropPicture($element['DETAIL_PICTURE']);

            if ($arParams['USE_ELEMENT_PROPERTIES'] === 'Y') {
                $this->setElementProps($element);
            }
            $this->arResult['ELEMENT'] = $element;

            if ($arParams['SET_BREADCRUMBS'] === 'Y') {
                $iblockId = $element['IBLOCK_ID'];
                $sectionId = $element['IBLOCK_SECTION_ID'];
                $this->arResult['IBLOCK'] = $this->fetchIblockForBreadCrumbs((int) $iblockId);;
                $this->arResult['SECTION'] = $this->fetchSectionForBreadCrumbs((int) $iblockId, (int) $sectionId);
            }

            if ($arParams['SET_TITLE'] === 'Y') {
                if (empty($this->arResult['SECTION'])) {
                    $iblockId = $element['IBLOCK_ID'];
                    $sectionId = $element['IBLOCK_SECTION_ID'];
                    $this->arResult['SECTION'] = $this->fetchSectionForBreadCrumbs((int) $iblockId, (int) $sectionId);
                }
            }

            $this->includeComponentTemplate();
        }

        if ($arParams['SET_BREADCRUMBS'] === 'Y') {
            $iblock = $this->arResult['IBLOCK'];
            if (!empty($iblock)) {
                $this->application->AddChainItem($iblock['NAME'], $iblock['LIST_PAGE_URL']);
            }
            $section = $this->arResult['SECTION'];
            if (!empty($section)) {
                $this->application->AddChainItem($section ['NAME'], $section ['SECTION_PAGE_URL']);
            }
            $element = $this->arResult['ELEMENT'];
            if (!empty($element)) {
                $this->application->AddChainItem($element['NAME'], $element['DETAIL_PAGE_URL']);
            }
        }

        if ($arParams['SET_TITLE'] === 'Y') {
            $element = $this->arResult['ELEMENT'];
            if (!empty($element)) {
                $this->application->SetTitle($element['NAME']);
            }
        }
    }

    private function fetchElement()
    {
        $filter = $this->prepareFilter();
        $elementsResult = CIBlockElement::GetList(
            ['SORT' => 'ASC'],
            $filter
        );

        $elementsResult->SetUrlTemplates();
        return $elementsResult->GetNext();
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
