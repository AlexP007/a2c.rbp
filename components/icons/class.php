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
    private $fields = [];
    private $select = [];

    public function onPrepareComponentParams($arParams)
    {
        if (!empty($arParams['PERSONAL_COUNTRY'])) {
            $arParams['PERSONAL_COUNTRY'] = Tools::getUserCountry($arParams['PERSONAL_COUNTRY']);
        }

        $this->prepareFields($arParams);
        $this->prepareSelect($arParams);
        return parent::onPrepareComponentParams($arParams);
    }

    public function executeComponent()
    {
        $arParams = $this->arParams;
        if (empty($arParams['USER_ID']) ) {
            ShowError('Не указан id пользователя');
            return;
        }
        // tag cache
        if ($this->startResultCache(false)) {

            // fetching data
            $data = User::getProps((int) $arParams['USER_ID'], [
                'FIELDS' => ['EMAIL', 'PERSONAL_MOBILE', 'PERSONAL_COUNTRY', 'PERSONAL_CITY'],
                'SELECT' => $this->select,
            ]);
            $this->arResult = $this->prepareResult($data);
            $this->setResultCacheKeys([]);

            $this->includeComponentTemplate();
        }
    }

    private function prepareFields(array $arParams)
    {
        if ($arParams['EMAIL'] === 'Y') {
            $this->fields[] = 'EMAIL';
        }
        if ($arParams['TELEPHONE'] === 'Y') {
            $this->fields[] = 'PERSONAL_MOBILE';
        }
        if ($arParams['ADDRESS'] === 'Y') {
            $this->fields[] = 'PERSONAL_COUNTRY';
            $this->fields[] = 'PERSONAL_CITY';
        }
    }

    private function prepareSelect(array $arParams)
    {
        $select = [
            $arParams['GITHUB'],
            $arParams['INSTAGRAM'],
            $arParams['TELEGRAM'],
            $arParams['TWITTER'],
        ];

        $this->select = array_values(array_filter(array_unique($select)));
    }

    private function prepareResult(array $data): array
    {
        $result = [];
        $usedProps = array_merge($this->fields, $this->select);

        foreach ($data as $key => $item) {
            if (in_array($key, $usedProps)) {
                $result[] = $item;
            }
        }

        return $result;
    }
}
