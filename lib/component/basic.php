<?php


namespace A2C\RBP\Component;


use CBitrixComponent;
use CFile;


/**
 * Class Basic
 * @package A2C\RBP\Component
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
abstract class Basic extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        return parent::onPrepareComponentParams($arParams);
    }

    protected function cropPicture($id)
    {
        $width = $this->arParams['IMAGE_WIDTH'] > 0
            ? $this->arParams['IMAGE_WIDTH'] : 100;

        $height = $this->arParams['IMAGE_WIDTH'] > 0
            ? $this->arParams['IMAGE_HEIGHT'] : 100;

        return CFile::ResizeImageGet(
            $id,
            [
                'width' => $width,
                'height' => $height,
            ],
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
    }
}
