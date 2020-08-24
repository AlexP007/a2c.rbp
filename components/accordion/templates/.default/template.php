<?php

/**
 * Компонент Аккордион
 * Шаблоны
 *
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
<h4 <?php if (isset($arParams['~HEADING_CLASS'])): ?>
        class="<?=$arParams['~HEADING_CLASS']?>"
    <?php endif; ?>
>
    <a
        data-type="rbp-acc-opener"
        data-down="<?=$arParams['~ICON_DOWN']?>"
        data-up="<?=$arParams['~ICON_UP']?>"
        href="#lab<?=$arParams['~ID']?>"
    >
        <?=$arParams['~HEADING']?> <i class="<?=$arParams['~ICON_DOWN']?>"></i>
    </a>
</h4>
<div class="rbp-display-none" id="lab<?=$arParams['ID']?>">
    <?php if (isset($arParams['~CAPTURE'])): ?>
        <div><?=$arParams['~CAPTURE']?></div>
    <?php endif; ?>
    <div><?=$arParams['~MAIN']?></div>
</div>
