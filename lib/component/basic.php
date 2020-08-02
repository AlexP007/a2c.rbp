<?php


namespace A2C\RBP\Component;


use CBitrixComponent;
use CFile;
use CMain;


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
    /**
     * @var CMain
     */
    protected $application;

    public function onPrepareComponentParams($arParams)
    {
        global $APPLICATION;
        $this->application = $APPLICATION;
        return parent::onPrepareComponentParams($arParams);
    }

    public function set404()
    {
        $this->application->IncludeFile('/404.php');
        die();
    }

    protected function cropPicture($id)
    {
        $width = $this->arParams['IMAGE_WIDTH'] > 0
            ? $this->arParams['IMAGE_WIDTH']
            : 100;

        $height = $this->arParams['IMAGE_WIDTH'] > 0
            ? $this->arParams['IMAGE_HEIGHT']
            : 100;

        return CFile::ResizeImageGet(
            $id, [
                'width' => $width,
                'height' => $height,
            ],
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
    }
}
