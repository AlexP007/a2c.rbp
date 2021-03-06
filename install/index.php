<?php

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\ModuleManager,
    Bitrix\Main\Application,
    Bitrix\Main\Loader,
    Bitrix\Main\IO\File;

Loc::loadMessages(__FILE__);

/**
 * Class A2C_RBP
 * Инсталлятор
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
Class A2C_RBP extends CModule
{

    const MIN_PHP_VERSION = '7.2';
    const D7_MAIN_MIN_VERSION = '20.00.00';

    const MODULE_ASSETS_PATH = '/local/assets/a2c.rbp';

    /*
     * Определим всё что нужно битриксу
     */
    public function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__ . "/version.php");

        $this->MODULE_ID = 'a2c.rbp';
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = Loc::getMessage("A2C_RBP_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("A2C_RBP_MODULE_DESC");
        $this->PARTNER_NAME = Loc::getMessage("A2C_RBP_PARTNER_NAME");
        $this->MODULE_SORT = 100;
    }

    /*
     * Инсталятор
     */
    public function doInstall()
    {
        global $USER;
        global $APPLICATION;

        try {
            if(!$USER->IsAdmin() ) {
                throw new Exception(Loc::getMessage('A2C_RBP_NO_RIGHTS'));
            }
            $this->checkDependencies();
        } catch (\Exception $e) {
            $APPLICATION->ThrowException($e->getMessage());
            return false;
        }

        try {
            // Заригестрируем модуль
            ModuleManager::registerModule($this->MODULE_ID);

            // Подключим модуль
            Loader::includeModule($this->MODULE_ID);
            //  установим компоненты и зависимости
            $this->installLogic();

        } catch (Exception $e) {
            ModuleManager::unRegisterModule($this->MODULE_ID);
            $APPLICATION->ThrowException($e->getMessage());
        }

        // Заключительный экран
        $this->includeStepFinal();
    }

    /**
     * Деинсталятор
     */
    public function doUninstall()
    {
        global $APPLICATION;

        $this->unInstallComponents();
        $this->unInstallAssets();

        ModuleManager::unRegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile(Loc::getMessage('A2C_RBP_INSTALL_UNSTEP_FINALE'), $this->getPath() . '/install/steps/unstep_final.php');
    }

    private function checkDependencies()
    {
        global $APPLICATION;

        $this->isRightPhpVersion() or $APPLICATION->ThrowException(Loc::getMessage('A2C_RBP_PHP_WRONG_VERSION'));
        $this->isVersionD7() or $APPLICATION->ThrowException(Loc::getMessage('A2C_RBP_NO_D7', ['#PHP_VERSION#' => self::MIN_PHP_VERSION]));

    }

    private function isRightPhpVersion()
    {
        return strstr(phpversion(), self::MIN_PHP_VERSION);
    }

    private function isVersionD7()
    {
        return CheckVersion(ModuleManager::getVersion('main'), self::D7_MAIN_MIN_VERSION);
    }


    protected function includeStepFinal()
    {
        global $APPLICATION;
        $APPLICATION->IncludeAdminFile(Loc::getMessage('A2C_RBP_INSTALL_STEP_FINAL'), $this->getPath() . '/install/steps/step_final.php');
    }

    private function installLogic()
    {
        try {
            $this->installComponents();
            $this->installAssets();
        } catch (Exception $e) {
            $this->unInstallComponents();
            $this->unInstallAssets();
            throw new Exception($e->getMessage() );
        }
    }

    private function installComponents()
    {
        $files = $this->getComponents();

        foreach ($files as $file) {
            if (!symlink($file['FROM'], $file['TO'])) {
                throw new Exception(Loc::getMessage('A2C_RBP_LINK_PROBLEM', ['#LINK#' => $file['TO']]) );
            }
        }
    }

    private function unInstallComponents()
    {
        $files = $this->getComponents();

        foreach ($files as $file) {
            File::deleteFile($file['TO']);
        }
    }

    private function getComponents()
    {
        $components = $this->getPath() . '/components';
        $docRoot = Application::getDocumentRoot();

        return [
            [
                'FROM' => $components,
                'TO' => "$docRoot/local/components/$this->MODULE_ID"
            ]
        ];
    }

    private function installAssets()
    {
        CheckDirPath(Application::getDocumentRoot() . self::MODULE_ASSETS_PATH);

        $path = $this->getAssetsPath();
        if (!symlink($path['FROM'], $path['TO'])) {
            throw new Exception(Loc::getMessage('A2C_RBP_LINK_PROBLEM', ['#LINK#' => $path['TO']]) );
        }

    }

    private function unInstallAssets()
    {
        $path = $this->getAssetsPath();
        File::deleteFile($path['TO']);
    }

    private function getAssetsPath()
    {
        $assets = $this->getPath() . '/assets';
        $docRoot = Application::getDocumentRoot();

        return [
            'FROM' => $assets,
            'TO' => "$docRoot/local/assets/$this->MODULE_ID"
        ];
    }

    public function getPath()
    {
        return dirname(__DIR__);
    }
}
