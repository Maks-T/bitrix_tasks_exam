<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arComponentParameters = array(
  "PARAMETERS" => array(
    "CATALOG_IBLOCK_ID" => Array(
      "NAME" => GetMessage("CATALOG_IBLOCK_ID"),
      "TYPE" => "STRING",
      "DEFAULT" => "2",
      "PARENT" => "BASE",
    ),
    "CATALOG_SECTION_CODE" => Array(
      "NAME" => GetMessage("CATALOG_SECTION_CODE"),
      "TYPE" => "STRING",
      "DEFAULT" => "2",
      "PARENT" => "BASE",
    ),
    "URL_SMART_FILTER" => Array(
      "NAME" => GetMessage("URL_SMART_FILTER"),
      "TYPE" => "STRING",
      "DEFAULT" => "",
      "PARENT" => "BASE",
    ),
  )
);

