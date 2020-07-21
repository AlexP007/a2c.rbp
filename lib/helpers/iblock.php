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
 * @link https://github.com/AlexP007/a2c.checkout
 */
class Iblock
{
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

        $filter = array_merge($filter, ['ACTIVE' => 'Y']);
        return PropertyTable::getList([
            'select' => ['ID', 'NAME'],
            'filter' => $filter,
            'order'   => ['NAME' => 'asc'],
        ])->fetchAll();
    }

    /**
     * Возвращает массив значений свойств
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
            'filter' => ['ACTIVE' => 'Y'],
            'order'   => ['NAME' => 'asc'],
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
    public static function getIblockElements(int $id): array
    {
        self::includeModule();

        return ElementTable::getList([
            'select' => ['ID', 'NAME'],
            'filter' => ['IBLOCK_ID' => $id],
        ])->fetchAll();
    }

    /**
     * Подключает модуль инфоблоков
     * или показывает ошибку
     *
     * @throws \Bitrix\Main\LoaderException
     */
    private static function includeModule()
    {
        Loader::includeModule('iblock') or ShowError('no iblock module');
    }
}