<?php

declare(strict_types=1);

namespace TS;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;

class Labels
{
  const HLB_ID = 4;

  public static function getLabels(): array
  {
    Loader::IncludeModule("highloadblock");

    $hlblock = HighloadBlockTable::getById(self::HLB_ID)->fetch();
    $entity = HighloadBlockTable::compileEntity($hlblock);
    $entityDataClass = $entity->getDataClass();

    $result = $entityDataClass::getList(["select" => ["*"]]);

    $paramsHLB = [];
    while ($arRow = $result ->fetch()) {
      $paramsHLB[$arRow["UF_XML_ID"]] = $arRow;
    }
    return $paramsHLB;
  }
}