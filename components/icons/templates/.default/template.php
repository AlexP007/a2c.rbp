<?php

/**
 * Компонент Иконки
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

<ul <?= isset($arParams['CONTAINER_CLASS']) ? "class=${arParams['CONTAINER_CLASS']}" : '' ?>>
    <?php if (isset($arResult['~UF_TWITTER'])): ?>
        <li>
            <a target="_blank" href="https://twitter.com/<?=$arResult['~UF_TWITTER']?>"><i class="fab fa-twitter"></i></a>
        </li>
    <?php endif; ?>
    <?php if (isset($arResult['~UF_TELEGRAM'])): ?>
        <li>
            <a target="_blank" href="https://t.me/<?=$arResult['~UF_TELEGRAM']?>"><i class="fab fa-telegram-plane"></i></a>
        </li>
    <?php endif; ?>
    <?php if (isset($arResult['~UF_INSTAGRAM'])): ?>
        <li>
            <a target="_blank" href="https://www.instagram.com/<?=$arResult['~UF_INSTAGRAM']?>"><i class="fab fa-instagram-square"></i></a>
        </li>
    <?php endif; ?>
    <?php if (isset($arResult['~UF_GITHUB'])): ?>
        <li>
            <a target="_blank" href="https://www.github.com/<?=$arResult['~UF_GITHUB']?>"><i class="fab fa-github"></i></a>
        </li>
    <?php endif; ?>
    <?php if (isset($arResult['~PERSONAL_MOBILE'])): ?>
        <li>
            <a target="_blank" href="tel:<?=$arResult['~PERSONAL_MOBILE']?>"><i class="fas fa-phone"></i></a>
        </li>
    <?php endif; ?>
    <?php if (isset($arResult['~EMAIL'])): ?>
        <li>
            <a target="_blank" href="mailto:<?=$arResult['~EMAIL']?>"><i class="fas fa-envelope"></i></a>
        </li>
    <?php endif; ?>
</ul>