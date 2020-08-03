<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

/**
 * Инфо-сайт инфоблок
 * Шаблоны
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
?>
<ul>
<?php foreach ($arResult['IBLOCKS'] as $iblock):?>
    <li>
        <h3><a href="/?"><?=$iblock['NAME']?></a></h3>
        <p><?=$iblock['PICTURE']['SRC']?> <?=$iblock['DESCRIPTION']?></p>
    </li>
<?php endforeach;?>
</ul>

