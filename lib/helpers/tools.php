<?php


namespace A2C\RBP\Helpers;


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

    public static function getUserCountry(int $i): string
    {
        $countries = GetCountryArray();
        $map = array_flip($countries['reference_id']);
        $countryId = $map[$i];
        return $countries['reference'][$countryId];
    }
}