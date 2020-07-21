<?php


namespace A2C\RBP\Helpers;


/**
 * Набор полезный методов
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
}