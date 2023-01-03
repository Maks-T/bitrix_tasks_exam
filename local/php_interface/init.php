<?php

use \Bitrix\Main\Loader;

require_once $_SERVER["DOCUMENT_ROOT"] . '/local/lib/helpers/debugger.php';


/**
 * Include own namespace
 */
Loader::registerNamespace(
  "TS",
  $_SERVER["DOCUMENT_ROOT"] . "/local/lib",
);