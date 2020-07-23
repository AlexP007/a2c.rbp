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
    <?php if (isset($arResult['~TWITTER'])): ?>
        <li>
            <a target="_blank" href="https://twitter.com/<?=$arResult['~TWITTER']?>"><i class="fab fa-twitter"></i></a>
        </li>
    <?php endif; ?>
    <?php if (isset($arResult['~TELEGRAM'])): ?>
        <li>
            <a target="_blank" href="https://t.me/<?=$arResult['~TELEGRAM']?>"><i class="fab fa-telegram-plane"></i></a>
        </li>
    <?php endif; ?>
    <?php if (isset($arResult['~INSTAGRAM'])): ?>
        <li>
            <a target="_blank" href="https://www.instagram.com/<?=$arResult['~INSTAGRAM']?>"><i class="fab fa-instagram-square"></i></a>
        </li>
    <?php endif; ?>
    <?php if (isset($arResult['~GITHUB'])): ?>
        <li>
            <a target="_blank" href="https://www.github.com/<?=$arResult['~GITHUB']?>"><i class="fab fa-github"></i></a>
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