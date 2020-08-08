<?php


namespace A2C\RBP\Helpers;


use Bitrix\Main\Loader,
    Bitrix\Iblock\PropertyTable,
    Bitrix\Iblock\ElementTable,
    Bitrix\Iblock\IblockTable;

/**
 * Класс обертка для работы с инфоблоками
 *
 * Class Iblock
 * @package A2C\RBP\Helpers
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
class Iblock
{
    const MODULE_ID = 'iblock';
    const MODULE_ERROR = 'could\'t load iblock module';
    const FILTER_ACTIVE = ['=ACTIVE' => 'Y'];

    /**
     * Возвращает массив свойств инфоблока
     * формата ['ID' => 2, 'NAME' => 'Цена']
     *
     * @param array $filter
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getPropertyIdName(array $filter): array
    {
        self::includeModule();

        $filter = array_merge($filter, self::FILTER_ACTIVE);
        return PropertyTable::getList([
            'select' => ['ID', 'NAME'],
            'filter' => $filter,
            'order'  => ['NAME' => 'asc'],
        ])->fetchAll();
    }

    /**
     * Возвращает массив значений свойств элемента
     *
     * @param array $filterElts
     * @param array $filterProps
     * @return array
     */
    public static function getPropertyValues(int $iblockId, array $filterElts, array $filterProps): array
    {
        self::includeModule();

        $result = [];
        \CIBlockElement::GetPropertyValuesArray($result, $iblockId, $filterElts, $filterProps);

        return $result;
    }

    public static function getElementsValues(array $filter)
    {
        return ElementTable::getList($filter)->fetchAll();
    }

    /**
     * Возвращает массив инфоблков
     * вида ['ID' => 2, 'NAME' => 'Товары']
     *
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getIbclocksIdName(): array
    {
        self::includeModule();

        return IblockTable::getList([
            'select' => ['ID', 'NAME'],
            'filter' => self::FILTER_ACTIVE,
            'order'  => ['NAME' => 'asc'],
        ])->fetchAll();
    }

    /**
     * Возвращает массив элементов инфоблков
     * вида ['ID' => 2, 'NAME' => 'Рубашка']
     *
     * @param int $id
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getIblockElementsIdName(int $id): array
    {
        self::includeModule();

        return ElementTable::getList([
            'select' => ['ID', 'NAME'],
            'filter' => ['IBLOCK_ID' => $id],
        ])->fetchAll();
    }

    public static function replaceListUrl(array &$iblock)
    {
        $url = str_replace('#SITE_DIR#', '', $iblock['LIST_PAGE_URL']);
        $search = array_map(function ($elt) {
            return "#IBLOCK_$elt#";
        }, array_keys($iblock));
        $replace = array_values($iblock);
        $url = str_replace($search, $replace, $url);
        $iblock['LIST_PAGE_URL'] = $url;
    }

    /**
     * Подключает модуль инфоблоков
     * или показывает ошибку
     *
     * @throws \Bitrix\Main\LoaderException
     */
    public static function includeModule()
    {
        Loader::includeModule(self::MODULE_ID) or Tools::showModuleError(self::MODULE_ERROR);
    }
}