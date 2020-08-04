<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

/**
 * Компонент Инфо-сайт Секции инфоблока
 * Шаблоны
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
?>
<ul>
<?php foreach ($arResult['SECTIONS'] as $section):?>
    <li>
        <h3><a href="<?=$section['SECTION_PAGE_URL']?>"><?=$section['NAME']?></a></h3>
        <p>
            <a href="<?=$section['SECTION_PAGE_URL']?>">
                <img src="<?=$section['PICTURE']['src']?>">
            </a>
            <?=$section['DESCRIPTION']?></p>
    </li>
<?php endforeach;?>
</ul>


