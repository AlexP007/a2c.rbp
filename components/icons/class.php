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
    public function executeComponent()
    {
        $arParams = $this->arParams;
        if (empty($arParams['USER_ID']) ) {
            ShowError('Не указан id пользователя');
            return;
        }
        // tag cache
        if ($this->startResultCache(false)) {
            $select = [
                $arParams['GITHUB'],
                $arParams['INSTAGRAM'],
                $arParams['TELEGRAM'],
                $arParams['TWITTER'],
            ];
            // fetching data
            $data = User::getProps((int) $arParams['USER_ID'], [
                'FIELDS' => ['MAIL', 'PERSONAL_MOBILE', 'PERSONAL_COUNTRY', 'PERSONAL_CITY'],
                'SELECT' => array_unique($select),
            ]);
            $this->arResult = $this->prepareResult($data);
            $this->setResultCacheKeys([]);

            $this->includeComponentTemplate();
        }
    }

    private function prepareResult(array $data): array
    {
        $result = [];
        $arParams = $this->arParams;
        $data = $data[$arParams['ELEMENT_ID']];

        foreach ($data as $item) {
            switch ($item['ID']) {
                case $arParams['MAIL']: $result['MAIL'] = $item['VALUE']; break;
                case $arParams['TELEPHONE']: $result['TELEPHONE'] = $item['VALUE']; break;
                case $arParams['ADDRESS']: $result['ADDRESS'] = $item['VALUE']; break;
                case $arParams['GITHUB']: $result['GITHUB'] = $item['VALUE']; break;
                case $arParams['INSTAGRAM']: $result['INSTAGRAM'] = $item['VALUE']; break;
                case $arParams['TELEGRAM']: $result['TELEGRAM'] = $item['VALUE']; break;
                case $arParams['TWITTER']: $result['TWITTER'] = $item['VALUE']; break;
            }
        }

        return $result;
    }
}