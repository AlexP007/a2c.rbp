<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use DateTime;

use Bitrix\Main\Loader;

use A2C\RBP\Component\Basic;
use A2C\RBP\Helpers\{User, Tools};

Loader::includeModule('a2c.rbp') or Tools::showModuleError('a2c.rbp');

/**
 * Компонент О пользователе
 *
 * Class A2cRbpAbout
 * Блок о пользователе с информацией и фотографией
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
class A2cRbpAbout extends Basic
{
    public function executeComponent()
    {
        $arParams = $this->arParams;
        if (empty($arParams['USER_ID']) ) {
            ShowError('Не указан id пользователя');
            return;
        }
        $userUpdated = User::getTimestamp($arParams['USER_ID']);
        // кэш
        if ($this->startResultCache(false, $userUpdated)) {
            // данные
            $data = User::getProps((int) $arParams['USER_ID'], [
                'FIELDS' => [
                    'NAME',
                    'LAST_NAME',
                    'EMAIL',
                    'PERSONAL_PHOTO',
                    'PERSONAL_CITY',
                    'PERSONAL_COUNTRY',
                    'PERSONAL_BIRTHDAY',
                    'PERSONAL_PROFESSION',
                ],
                'SELECT' => [$arParams['ABOUT']],
            ]);
            if (empty($data)) {
                $this->abortResultCache();
                ShowError('Пользователь не найден');
                return;
            }
            // определим город
            if (!empty($data['PERSONAL_COUNTRY'])) {
                $data['~PERSONAL_COUNTRY'] = Tools::getUserCountry($data['PERSONAL_COUNTRY']);
            }
            // Обрежем и достанем фото
            if (!empty($data['PERSONAL_PHOTO'])) {
                $data['PERSONAL_PHOTO'] = $this->cropPicture($data['PERSONAL_PHOTO']);
            }
            // Посчитаем возраст
            if (!empty($data['PERSONAL_BIRTHDAY'])) {
                $data['PERSONAL_AGE'] = Tools::getDateDiff($data['PERSONAL_BIRTHDAY'])->y;
            }
            $this->arResult = $data;
            $this->setResultCacheKeys([]);

            $this->includeComponentTemplate();
        }
    }
}
