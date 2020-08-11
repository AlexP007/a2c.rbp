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
class A2cRbpInfositeElements extends InfositeBasic
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
            $elements = $this->fetchElements();
            if (empty($elements)) {
                $this->abortResultCache();
                $this->set404();
            }

            $this->cropPictures($elements);

            if ($arParams['USE_ELEMENTS_PROPERTIES'] === 'Y') {
                $this->setElementsProps($elements);
            }
            $this->arResult['ELEMENTS'] = $elements;

            if ($arParams['SET_BREADCRUMBS'] === 'Y') {
                $iblockId = $elements[0]['IBLOCK_ID'];
                $sectionId = $elements[0]['IBLOCK_SECTION_ID'];
                $this->arResult['IBLOCK'] = $this->fetchIblockForBreadCrumbs((int) $iblockId);;
                $this->arResult['SECTION'] = $this->fetchSectionForBreadCrumbs((int) $iblockId, (int) $sectionId);
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
                $this->application->AddChainItem($section['NAME'], $section['SECTION_PAGE_URL']);
            }
        }
    }

    private function fetchElements(): array
    {
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
        return $elements;
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

    private function cropPictures(array &$elements)
    {
        foreach ($elements as &$s) {
            $s['PREVIEW_PICTURE'] = $this->cropPicture($s['PREVIEW_PICTURE']);
        }
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
