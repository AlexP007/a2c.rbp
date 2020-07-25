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
    public static function registerExt()
    {
        CJSCore::RegisterExt(
            "rbp-assets-pack", [
                "js"  => "/local/assets/a2c.rbp/js/script.js",
                "css" => "/local/assets/a2c.rbp/css/style.css",
                "rel" => ['jquery'],
            ]
        );
    }

    public static function initExt()
    {
        CUtil::InitJSCore(['rbp-assets-pack']);
    }
}
