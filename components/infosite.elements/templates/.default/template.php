<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

/**
 * Компонент Инфо-сайт Элементы секций
 * Языковые файлы
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
?>
<ul>
<?php foreach ($arResult['ELEMENTS'] as $element):?>
    <li>
        <h3><a href="<?=$element['DETAIL_PAGE_URL']?>"><?=$element['NAME']?></a></h3>
        <p>
            <a href="<?=$element['DETAIL_PAGE_URL']?>">
                <img src="<?=$element['PREVIEW_PICTURE']['src']?>">
            </a>
            <?=$element['DESCRIPTION']?></p>
    </li>
<?php endforeach;?>
</ul>
