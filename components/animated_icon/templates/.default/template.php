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
<a
    href="<?=$arParams['LINK_TO']?>"
    class="<?=$arParams['LINK_CLASS']?>"
    data-type="<?=RBP_ANIMATED_ICON_TYPE?>"
    data-selector="<?=$arParams['SCROLL_SELECTOR']?>"
    <?php if (!empty($arParams['SCROLL_PIXELS_FADE'])):?>
    data-scroll="<?=(int)$arParams['SCROLL_PIXELS_FADE']?>"
    <?php endif; ?>
>
    <i class="<?=$arParams['ICON_CLASS']?>"></i>
</a>