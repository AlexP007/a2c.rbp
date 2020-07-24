<?php


namespace A2C\RBP\Helpers;


use DateTime;

use Csite;
use CDatabase;
use DateInterval;

/**
 * Свалка полезных методов
 *
 * Class Parameters
 * @package A2C\RBP\Helpers
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
class Tools
{
    public static function showModuleError(string $modId): bool
    {
        ShowError("can't connect module: $modId");
        return true;
    }

    /**
     * По номеру страны из настроек сайта
     * вовзращает её название.
     *
     * @param int $i
     * @return string
     */
    public static function getUserCountry(int $i): string
    {
        $countries = GetCountryArray();
        $map = array_flip($countries['reference_id']);
        $countryId = $map[$i];
        return $countries['reference'][$countryId];
    }

    /**
     * Принимает строку короткую времени в формате сайта.
     * Возвращает обьект php DateInterval - разница между
     * переданным временем и текущим.
     *
     * @param string $date
     * @return DateInterval
     * @throws \Exception
     */
    public static function getDateDiff(string $date): DateInterval
    {
        $siteFormat = CDatabase::DateFormatToPHP(CSite::GetDateFormat('SHORT'));
        $siteDate = DateTime::createFromFormat($siteFormat, $date);
        $nowDate = new DateTime();

        return $siteDate->diff($nowDate);
    }
}