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

            if ($arParams['USE_SECTION_USER_FIELDS'] === 'Y') {
                $this->setSectionsUserFields($sections);
            }

            $this->arResult['SECTIONS'] = $sections;
            $this->includeComponentTemplate();
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
