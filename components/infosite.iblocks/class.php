<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use Bitrix\Main\Loader;
use CIBlock;

use A2C\RBP\Component\Basic;
use A2C\RBP\Helpers\{Iblock, Tools};

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
        Iblock::includeModule();

        if ($this->startResultCache(false)) {
            $iblocksResult = CIBlock::GetList(
                ['SORT' => 'ASC'],
                ['=ACTIVE' => 'Y', 'TYPE' => $this->arParams['IBLOCK_TYPE_ID']]
            );
            $iblocks = [];
            while ($i = $iblocksResult->GetNext()) {
                Iblock::replaceListUrl($i);
                $iblocks[] = $i;
            }
            if (empty($iblocks)) {
                $this->abortResultCache();
                $this->set404();
            }

            foreach ($iblocks as &$i) {
                $i['PICTURE'] = $this->cropPicture($i['PICTURE']);
            }

            $this->arResult['IBLOCKS'] = $iblocks;
            $this->includeComponentTemplate();
        }
    }
}
