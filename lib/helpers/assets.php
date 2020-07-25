<?php


namespace A2C\RBP\Helpers;


use CJSCore;
use CUtil;

/**
 * Class Assets
 * @package A2C\RBP\Helpers
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
class Assets
{
    public static function registerJs()
    {
        CJSCore::RegisterExt(
            "rbp-js", [
                "js" => "/local/assets/a2c.rbp/js/script.js",
                "rel" => ['jquery'],
            ]
        );
    }

    public static function initJs()
    {
        CUtil::InitJSCore(['rbp-js']);
    }
}
