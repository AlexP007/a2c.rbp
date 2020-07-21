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

<ul <?= isset($arParams['CONTAINER_CLASS']) ? "class=${arParams['CONTAINER_CLASS']}" : '' ?>
    <?php if (isset($arParams['TWITTER'])): ?>
        <li>
            <a target="_blank" href="https://twitter.com/<?=$arParams['TWITTER']?>"><i class="fab fa-twitter"></i></a>
        </li>
    <?php endif; ?>
    <?php if (isset($arParams['TELEGRAM'])): ?>
        <li>
            <a target="_blank" href="https://t.me/<?=$arParams['TELEGRAM']?>"><i class="fab fa-telegram-plane"></i></a>
        </li>
    <?php endif; ?>
    <?php if (isset($arParams['INSTAGRAM'])): ?>
        <li>
            <a target="_blank" href="https://www.instagram.com/<?=$arParams['INSTAGRAM']?>"><i class="fab fa-instagram-square"></i></a>
        </li>
    <?php endif; ?>
    <?php if (isset($arParams['GITHUB'])): ?>
        <li>
            <a target="_blank" href="https://www.github.com/<?=$arParams['GITHUB']?>"><i class="fab fa-github"></i></a>
        </li>
    <?php endif; ?>
    <?php if (isset($arParams['TELEPHONE'])): ?>
        <li>
            <a target="_blank" href="tel:<?=$arParams['TELEPHONE']?>"><i class="fas fa-phone"></i></a>
        </li>
    <?php endif; ?>
    <?php if (isset($arParams['MAIL'])): ?>
        <li>
            <a target="_blank" href="mailto:<?=$arParams['MAIL']?>"><i class="fas fa-envelope"></i></a>
        </li>
    <?php endif; ?>
</ul>