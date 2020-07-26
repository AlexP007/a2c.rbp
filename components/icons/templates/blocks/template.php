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
    <?php if ($arParams['EMAIL'] === 'Y'): ?>
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
    <?php if ($arParams['ADDRESS'] === 'Y'): ?>
        <li>
            <div><i class="fas fa-map-marker-alt"></i></div>
            <div>Адрес</div>
            <p>
                <?=$arResult['~PERSONAL_COUNTRY']?>
                <?php if(!empty($arResult['~PERSONAL_CITY'])):?>
                , г. <?=$arResult['~PERSONAL_CITY']?>
                <?php endif;?>
            </p>
        </li>
    <?php endif; ?>
</ul>
