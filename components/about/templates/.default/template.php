<?php

/**
 * Компонент О пользователе
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

$name = "${arResult['~NAME']} ${arResult['~LAST_NAME']}";
$safeAboutProp = '~' . $arParams['ABOUT'];
?>
<section>
    <h2><?=$arParams['HEADING']?></h2>
    <?php if(isset($arResult['PERSONAL_PHOTO']['src'])): ?>
        <img src="<?=$arResult['PERSONAL_PHOTO']['src']?>" alt="<?=$name?>" />
    <?php endif; ?>
    <div>
        <?php if(!empty($arResult[$safeAboutProp])): ?>
            <p>
                <?=$arResult[$safeAboutProp]?>
            </p>
        <?php endif; ?>
        <div>
            <ul>
                <li><strong>Имя:</strong> <?=$name?></li>

                <?php if(!empty($arResult['PERSONAL_AGE'])): ?>
                    <li><strong>Возраст:</strong> <?=$arResult['PERSONAL_AGE']?></li>
                <?php endif; ?>

                <?php if(!empty($arResult['~PERSONAL_PROFESSION'])): ?>
                    <li><strong>Профессия:</strong> <?=$arResult['~PERSONAL_PROFESSION']?></li>
                <?php endif; ?>

                <?php if(!empty($arResult['~PERSONAL_COUNTRY'])): ?>
                    <li><strong>Страна:</strong> <?=$arResult['~PERSONAL_COUNTRY']?></li>
                <?php endif; ?>

                <?php if(!empty($arResult['~PERSONAL_CITY'])): ?>
                    <li><strong>Город:</strong> <?=$arResult['~PERSONAL_CITY']?></li>
                <?php endif; ?>

                <?php if(!empty($arResult['~EMAIL']) && $arParams['HIDE_EMAIL'] !== 'Y'): ?>
                    <li><strong>E-mail:</strong> <?=$arResult['~EMAIL']?></li>
                <?php endif; ?>
            </ul>
        </div>
        <a href="<?=$arParams['BUTTON_LINK']?>" class="<?=$arParams['BUTTON_CLASS']?>"><?=$arParams['BUTTON_TEXT']?></a>
    </div>
</section>

