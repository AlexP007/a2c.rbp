<?php

/**
 * Компонент Анимированная иконка
 * Шаблоны
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}
?>
<a href="<?=$arParams['LINK_TO']?>" class="<?=$arParams['LINK_CLASS']?>">
    <i class="<?=$arParams['ICON_CLASS']?>"></i>
</a>