<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\ModuleManager;

class myb24lead_testmodule extends CModule
{
    public function __construct()
    {
        $this->MODULE_ID = "myb24lead.testmodule";
        $this->MODULE_VERSION = "1.0.0";
        $this->MODULE_VERSION_DATE = "2025-02-17";
        $this->MODULE_NAME = GetMessage('MODULE_NAME');
        $this->MODULE_DESCRIPTION = GetMessage('MODULE_DESCRIPTION');
        $this->PARTNER_NAME = GetMessage('MODULE_PARTNER_NAME');
    }

    public function DoInstall() 
    {
        global $APPLICATION;

        if (CModule::IncludeModule("main")) {
            if (CheckVersion(ModuleManager::getVersion("main"), "14.0.0")) {
                $this->InstallFiles();
                ModuleManager::registerModule($this->MODULE_ID);
            } else {
                $APPLICATION->ThrowException(GetMessage('MODULE_INSTALL_ERROR_VERSION'));
            }
        } else {
            $APPLICATION->ThrowException(GetMessage('MODULE_INSTALL_ERROR_MAIN'));
        }
    }

    public function DoUninstall()
    {
        global $APPLICATION;

        $this->UninstallFiles();
        ModuleManager::unregisterModule($this->MODULE_ID);
    }

    public function InstallFiles() 
    {
        global $APPLICATION;
        $modulePath = __DIR__; 
        $sourceDir = $modulePath . "/install/components/";
        $destinationDir = $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components/myb24lead/";
        CopyDirFiles($sourceDir, $destinationDir, true, true);
        
    }

    public function UninstallFiles() 
    {
        global $APPLICATION;
        $destinationDir = $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components/myb24lead/";
        DeleteDirFilesEx($destinationDir);
        
    }
}
?>