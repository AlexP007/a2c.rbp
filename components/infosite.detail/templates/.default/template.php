<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

/**
 * Компонент Инфо-сайт Детальная страница элемента
 * Шаблоный
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */

$element = $arResult['ELEMENT'];
?>
<div>
    <h3><?=$element['NAME']?></a></h3>
    <p>
        <img src="<?=$element['DETAIL_PICTURE']['src']?>">
        <?=$element['DESCRIPTION']?>
    </p>
</div>
