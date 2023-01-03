<?php

use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;

require_once $_SERVER["DOCUMENT_ROOT"] . '/local/lib/helpers/debugger.php';

/**
 * Include own namespace
 */
Loader::registerNamespace(
  "TS",
  Loader::getDocumentRoot()."/local/lib",
);

EventManager::getInstance()->addEventHandler(
  "iblock",
  "OnBeforeIBlockElementUpdate",
  ["TS\\CounterHandler", "OnBeforeIBlockElementUpdateHandler"]
);