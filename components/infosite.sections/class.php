<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use Bitrix\Main\Loader;
use CIBlockSection;

use A2C\RBP\Component\InfositeBasic;
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
class A2cRbpInfositeSections extends InfositeBasic
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
            $sections = $this->fetchSections();
            if (empty($sections)) {
                $this->abortResultCache();
                $this->set404();
            }

            $this->cropPictures($sections);

            if ($arParams['USE_SECTION_USER_FIELDS'] === 'Y') {
                $this->setSectionsUserFields($sections);
            }
            $this->arResult['SECTIONS'] = $sections;

            if ($arParams['SET_BREADCRUMBS'] === 'Y') {
                $iblockId = $sections[0]['IBLOCK_ID'];
                $this->arResult['IBLOCK'] = $this->fetchIblockForBreadCrumbs((int) $iblockId);;
            }

            $this->includeComponentTemplate();
        }

        if ($arParams['SET_BREADCRUMBS'] === 'Y') {
            $iblock = $this->arResult['IBLOCK'];
            if (!empty($iblock)) {
                $this->application->AddChainItem($iblock['NAME'], $iblock['LIST_PAGE_URL']);
            }
        }
    }

    private function fetchSections(): array
    {
        $filter = $this->prepareFilter();
        $sectionsResult = CIBlockSection::GetList(
            ['SORT' => 'ASC'],
            $filter
        );
        $sectionsResult->SetUrlTemplates();
        $sections = [];
        while ($s = $sectionsResult->GetNext()) {
            $sections[] = $s;
        }
        return $sections;
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
                $key = $parentResult['ALIASES']["IBLOCK"] ?? 'IBLOCK_ID';
                $value = $parentResult['VARIABLES'][$parentResult['ALIASES']["IBLOCK"]]
                    ?? $parentResult['VARIABLES']['IBLOCK'];
                $filter = [$key => $value];
            }
        } else {
            $key = $arParams['~IBLOCK_FILTER_KEY'];
            $value = $arParams['~IBLOCK_FILTER_VALUE'];
            $filter = [$key => $value];
        }
        return  array_merge($filter, ['ACTIVE' => 'Y']);
    }

    private function cropPictures(array &$sections)
    {
        foreach ($sections as &$s) {
            $s['PICTURE'] = $this->cropPicture($s['PICTURE']);
        }
    }

    private function setSectionsUserFields(array &$sections)
    {
        global $USER_FIELD_MANAGER;
        foreach ($sections as &$section) {
            $fields = $USER_FIELD_MANAGER->GetUserFields(
                "IBLOCK_${section['IBLOCK_ID']}_SECTION",
                $section['ID']
            );
            foreach ($fields as $field) {
                $section[$field['FIELD_NAME']] = $field['VALUE'];
                $section['~'.$field['FIELD_NAME']] = htmlspecialcharsEx($field['VALUE']);
            }
        }
    }
}
