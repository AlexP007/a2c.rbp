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
    <?php if (isset($arResult['~TELEPHONE'])): ?>
    <li>
        <div><i class="fas fa-phone"></i></div>
        <div>Телефон</div>
        <p>
            <a target="_blank" href="tel:<?=$arResult['~TELEPHONE']?>">
                <?=$arResult['~TELEPHONE']?>
            </a>
        </p>
    </li>
    <?php endif; ?>
    <?php if (isset($arResult['~TELEGRAM'])): ?>
    <li>
        <div><i class="fab fa-telegram-plane"></i></div>
        <div>Телеграм</div>
        <p>
            <a target="_blank" href="https://t.me/<?=$arResult['~TELEGRAM']?>">
                <?=$arResult['~TELEGRAM']?>
            </a>
        </p>
    </li>
    <?php endif; ?>
    <?php if (isset($arResult['~EMAIL'])): ?>
        <li>
            <div><i class="fas fa-envelope"></i></div>
            <div>Почта</div>
            <p>
                <a target="_blank" href="mailto:<?=$arResult['~EMAIL']?>">
                    <?=$arResult['~EMAIL']?>
                </a>
            </p>
        </li>
    <?php endif; ?>
    <?php if (isset($arResult['~COUNTRY'])): ?>
        <li>
            <div><i class="fas fa-map-marker-alt"></i></div>
            <div>Адрес</div>
            <p>
                <?=$arResult['~COUNTRY']?>
                <?php if(!empty($arResult['~CITY'])):?>
                , г. <?=$arResult['~CITY']?>
                <?php endif;?>
            </p>
        </li>
    <?php endif; ?>
</ul>