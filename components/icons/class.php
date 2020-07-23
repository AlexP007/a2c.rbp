<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use Bitrix\Main\Loader;

use A2C\RBP\Component\Basic;
use A2C\RBP\Helpers\{User, Tools};

Loader::includeModule('a2c.rbp') or Tools::showModuleError('a2c.rbp');

/**
 * Компонент Иконки
 *
 * Class A2cRbpIcons
 * Создает блок с иконками и ссылками
 * Использует инфоблок и его свойства
 * Два шаблона: 1) В линию 2) Блоками
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
class A2cRbpIcons extends Basic
{
    private $fieldsMap = [];
    private $propsMap = [];

    public function onPrepareComponentParams($arParams)
    {
        $this->prepareFieldsMap($arParams);
        $this->preparePropsMap($arParams);

        return parent::onPrepareComponentParams($arParams);
    }

    private function prepareFieldsMap(array $arParams)
    {
        if ($arParams['EMAIL'] === 'Y') {
            $this->fieldsMap['EMAIL'] = 'EMAIL';
        }
        if ($arParams['TELEPHONE'] === 'Y') {
            $this->fieldsMap['TELEPHONE'] = 'PERSONAL_MOBILE';
        }
        if ($arParams['ADDRESS'] === 'Y') {
            $this->fieldsMap['COUNTRY'] = 'PERSONAL_COUNTRY';
            $this->fieldsMap['CITY'] = 'PERSONAL_CITY';
        }
    }

    private function preparePropsMap(array $arParams)
    {
        if (!empty($arParams['INSTAGRAM'])) {
            $this->propsMap['INSTAGRAM'] = $arParams['INSTAGRAM'];
        }
        if (!empty($arParams['TELEGRAM'])) {
            $this->propsMap['TELEGRAM'] = $arParams['TELEGRAM'];
        }
        if (!empty($arParams['TWITTER'])) {
            $this->propsMap['TWITTER'] = $arParams['TWITTER'];
        }
        if (!empty($arParams['GITHUB'])) {
            $this->propsMap['GITHUB'] = $arParams['GITHUB'];
        }
    }

    public function executeComponent()
    {
        $arParams = $this->arParams;
        if (empty($arParams['USER_ID']) ) {
            ShowError('Не указан id пользователя');
            return;
        }
        // кэш
        if ($this->startResultCache(false)) {
            // данные
            $data = User::getProps((int) $arParams['USER_ID'], [
                'FIELDS' => array_keys($this->fieldsMap),
                'SELECT' => array_unique(array_filter(array_values($this->propsMap))),
            ]);
            // определим город
            if (!empty($data['PERSONAL_COUNTRY'])) {
                $data['~PERSONAL_COUNTRY'] = Tools::getUserCountry($data['PERSONAL_COUNTRY']);
            }
            $this->arResult = $this->prepareResult($data);
            $this->setResultCacheKeys([]);

            $this->includeComponentTemplate();
        }
    }

    private function prepareResult(array $data): array
    {
        $result = [];
        // берем только экранированные строки
        $usedProps = array_merge($this->fieldsMap, $this->propsMap);
        foreach ($usedProps as $key => $prop) {
            $safeProp = '~' . $prop;
            if (!empty($data[$safeProp])) {
                $safeKey = '~' . $key;
                $result[$safeKey] = $data[$safeProp];
            }
        }

        return $result;
    }
}
