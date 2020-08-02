<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use Bitrix\Main\Loader;
use Bitrix\Main\IblockTable;

use A2C\RBP\Component\Basic;
use A2C\RBP\Helpers\Tools;

Loader::includeModule('a2c.rbp') or Tools::showModuleError('a2c.rbp');

/**
 * Компонент Инфо-сайт инфоблок
 *
 * Class A2cRbpInfositeIblock
 * Выводит все инфоблоки одного типа
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
class A2cRbpInfositeIblock extends Basic
{
    public function onPrepareComponentParams($arParams)
    {
        return parent::onPrepareComponentParams($arParams);
    }

    public function executeComponent()
    {
        if ($this->startResultCache(false)) {
            $iblockTypeId = (int) $this->arParams['IBLOCK_TYPE_ID'];
            $iblocks = IblockTable::getList([
                'filter' => ['=ID' => $iblockTypeId]
            ])->fetchAll();
            if (empty($iblocks)) {
                $this->abortResultCache();
                $this->set404();
            }
            $this->arResult['IBLOCKS'] = $iblocks;
            $this->includeComponentTemplate();
        }
    }
}