<?php


namespace A2C\RBP\Helpers;


/**
 * Класс упрощающий работу с созданием
 * файла .parameters.php
 *
 * Class Parameters
 * @package A2C\RBP\Helpers
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
class Parameters
{
    /**
     * Возвращает список инфоблоков
     *
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getIBlocks(): array
    {
        $iblockList = Iblock::getIbclocksIdName();
        self::setPrompt($iblockList, 'Выберите инфоблок');
        return array_column($iblockList, 'NAME', 'ID');
    }

    /**
     * Возвращает список элементов инфоблока
     *
     * @param int $id
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getIElements(int $id): array
    {
        $eltsList = Iblock::getIblockElements($id);
        self::setPrompt($eltsList, 'Выберите  элемент');
        return array_column($eltsList, 'NAME', 'ID');
    }

    /**
     * Возвращает свойства инфоблока
     *
     * @param int $id
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getIProps(int $id): array
    {
        $propsList = Iblock::getPropertyIdName(['IBLOCK_ID' => $id]);
        self::setPrompt($propsList, 'Выберите свойства');
        return array_column($propsList, 'NAME', 'ID');
    }

    /**
     * Устанавливает значение по умолчанию
     * для выподающего списка
     *
     * @param array $list
     * @param string $promptText
     */
    private static function setPrompt(array &$list ,string $promptText)
    {
        array_push($list, ['ID' => '0', 'NAME' => $promptText]);
    }
}