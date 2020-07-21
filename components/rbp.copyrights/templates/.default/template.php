<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

?>
<?php if (empty($arParams['YEAR'])): ?>
    <small>© <?="${arResult['THIS_YEAR']} ${arParams['TEXT']}"?></small>
<? else: ?>
    <small>© <?="${arParams['YEAR']}-${arResult['THIS_YEAR']} ${arParams['TEXT']}"?></small>
<?php endif; ?>
