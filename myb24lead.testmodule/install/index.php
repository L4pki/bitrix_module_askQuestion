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
        $this->MODULE_NAME = "Тестовый модуль на создание лида";
        $this->MODULE_DESCRIPTION = "Модуль для интеграции формы с Битрикс24";
        $this->PARTNER_NAME = "Александр";
    }

    public function DoInstall() 
    {
        global $APPLICATION;

        if (CModule::IncludeModule("main")) {
            if (CheckVersion(ModuleManager::getVersion("main"), "14.0.0")) {
                $this->InstallFiles();
                ModuleManager::registerModule($this->MODULE_ID);
            } else {
                $APPLICATION->ThrowException("Модуль требует более новую версию Битрикс.");
            }
        } else {
            $APPLICATION->ThrowException("Не удалось подключить модуль main.");
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

        $sourceDir = $_SERVER["DOCUMENT_ROOT"]."/local/modules/myb24lead.testmodule/install/components/";
        $destinationDir = $_SERVER["DOCUMENT_ROOT"]."/bitrix/components/myb24lead/";

        if (is_dir($sourceDir)) {
            CopyDirFiles($sourceDir, $destinationDir, true, true);
        } else {
            $APPLICATION->ThrowException("Директория с компонентами не найдена: " . $sourceDir);
        }
    }

    public function UninstallFiles() 
    {
        global $APPLICATION;

        $destinationDir = $_SERVER["DOCUMENT_ROOT"]."/bitrix/components/myb24lead/";

        if (is_dir($destinationDir)) {
            DeleteDirFilesEx($destinationDir);
        } else {
            $APPLICATION->ThrowException("Директория для удаления не найдена: " . $destinationDir);
        }
    }
}
?>
