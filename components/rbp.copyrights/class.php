<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use A2c\ResumeBlogPack\Component\Basic;

class Copyrights extends Basic
{
    public function executeComponent()
    {
        $this->arResult['THIS_YEAR'] = date('Y');
        $this->includeComponentTemplate();
    }
}
