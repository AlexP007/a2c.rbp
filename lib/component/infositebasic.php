<?php


namespace A2C\RBP\Component;


use \CIblock;
use \CIBlockSection;

use A2C\RBP\Helpers\Iblock;

/**
 * Class infositeBasic
 * @package A2C\RBP\Component
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
abstract class InfositeBasic extends Basic
{
    protected function fetchIblockForBreadCrumbs(int $id)
    {
        Iblock::includeModule();
        $i = CIblock::GetById($id)->Fetch();
        Iblock::replaceListUrl($i);
        return $i;
    }

    protected function fetchSectionForBreadCrumbs(int $iblockId, int $sectionId): array
    {
        Iblock::includeModule();
        return CIBlockSection::GetNavChain($iblockId, $sectionId)->GetNext();
    }
}