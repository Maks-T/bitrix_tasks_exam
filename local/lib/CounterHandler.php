<?php

declare(strict_types=1);

namespace TS;

use Bitrix\Main\Loader;
use Bitrix\Iblock\Iblock;

class CounterHandler
{
  const IBLOCK_ID = 2;
  const MAX_SHOW_COUNTER = 2;

  /**
   * метод-обработчик события "OnBeforeIBlockElementUpdate"
   *
   * @param $arFields
   * @return false|void
   * @throws \Bitrix\Main\ArgumentException
   * @throws \Bitrix\Main\LoaderException
   * @throws \Bitrix\Main\ObjectPropertyException
   * @throws \Bitrix\Main\SystemException
   */
  public static function OnBeforeIBlockElementUpdateHandler(&$arFields)
  {

    if ($arFields["IBLOCK_ID"] == self::IBLOCK_ID && $arFields["ACTIVE"] == "N") {

      Loader::includeModule('iblock');

      $className = Iblock::wakeUp($arFields["IBLOCK_ID"])->getEntityDataClass();
      $product = $className::getByPrimary($arFields["ID"], ["select" => ["SHOW_COUNTER"]])->fetch();

      if ($product["SHOW_COUNTER"] > self::MAX_SHOW_COUNTER) {
        global $APPLICATION;
        $APPLICATION->throwException("Товар невозможно деактивировать, у него " . $product["SHOW_COUNTER"] . " просмотров.");
        return false;
      }
    }
  }
}