<?php

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\ModuleManager,
    Bitrix\Main\Application,
    Bitrix\Main\Loader,
    Bitrix\Main\IO\File;

Loc::loadMessages(__FILE__);

Class a2c_resume_blog_pack extends CModule
{

    const MIN_PHP_VERSION = '7.2';
    const D7_MAIN_MIN_VERSION = '20.00.00';

    /*
     * Определим всё что нужно битриксу
     */
    public function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__ . "/version.php");

        $this->MODULE_ID = 'a2c.resume_blog_pack';
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

            // Установим компоненты
            $this->installComponentsLogic();

        } catch (Exception $e) {
            ModuleManager::unRegisterModule($this->MODULE_ID);

            $APPLICATION->ThrowException($e->getMessage());
            $this->includeStep_2();
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

    private function installComponentsLogic()
    {
        try {
            $this->installComponents();
        } catch (Exception $e) {
            $this->unInstallComponents();
            throw new Exception($e->getMessage() );
        }
    }

    private function installComponents()
    {
        $files = $this->getComponents();

        foreach ($files as $file) {
            if (!symlink($file['FROM'], $file['TO'])) {
                throw new Exception(Loc::getMessage('A2C_CHECKOUT_LINK_PROBLEM', ['#LINK#' => $files['TO']]) );
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

    public function getPath()
    {
        return dirname(__DIR__);
    }

    /**
     * Проверяет существование каталога
     *
     * @param string $name
     * @param string $fullPath
     * @throws Exception
     */
    private function checkDir(string $fullPath)
    {
        if (!file_exists($fullPath) ) {
            throw new Exception(Loc::getMessage('A2C_CHECKOUT_COMPONENT_PATH_DOESNT_EXISTS', array('#DIR#' => $fullPath)) );
        }
    }
}