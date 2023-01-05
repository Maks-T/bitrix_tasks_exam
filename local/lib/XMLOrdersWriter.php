<?php

declare(strict_types=1);

namespace TS;

use  \Bitrix\Main\XmlWriter;

class XMLOrdersWriter
{
  protected function __construct()
  {
  }

  public static function writeXML(array $ordersArray, string $pathFile = '/upload/orders/export.xml'): void
  {
    if (empty($ordersArray)) {
      return;
    }

    $export = new XmlWriter(array(
      'file' => self::getPathFileWithTimeStamp($pathFile),
      'create_file' => true,
      'charset' => 'UTF-8',
      'lowercase' => false
    ));

    $export->openFile();
    $export->writeBeginTag("orders");
    self::writeValues($ordersArray, $export);
    $export->writeEndTag("orders");
    $export->closeFile();
  }

  private static function writeValues(array $ordersArray, XmlWriter $export): void
  {
    foreach ($ordersArray as $id => $orderValues) {
      $export->writeBeginTag("order id=\"$id\"");
      $export->writeItem($orderValues['ordersMainValues']);

      self::writeProperties($orderValues, $export);
      self::writeBasketItems($orderValues, $export);
      $export->writeEndTag('order');
    }
  }

  private static function writeProperties(array $orderValues, XmlWriter $export): void
  {
    $export->writeBeginTag('properties');

    self::writeUserProperties($orderValues, $export);
    self::writeOrderProperties($orderValues, $export);

    $export->writeEndTag('properties');
  }

  private static function writeUserProperties(array $orderValues, XmlWriter $export): void
  {
    $export->writeBeginTag('userProperties');
    foreach ($orderValues['userProperties'] as $userProperties) {

      $export->writeBeginTag('property code="' . $userProperties['code'] . '"');
      $export->writeFullTag('value', $userProperties['value']);
      $export->writeEndTag('property');
    }
    $export->writeEndTag('userProperties');
  }

  private static function writeOrderProperties(array $orderValues, XmlWriter $export): void
  {
    $export->writeBeginTag('orderProperties');
    foreach ($orderValues['orderProperties'] as $orderProperties) {
      $export->writeBeginTag("property code=\"" . $orderProperties['code'] . "\"");
      $export->writeItem([$orderProperties['value']]);
      $export->writeEndTag('property');
    }
    $export->writeEndTag('orderProperties');
  }

  private static function writeBasketItems(array $orderValues, XmlWriter $export): void
  {
    $export->writeBeginTag('basketItems');

    foreach ($orderValues['basketItems'] as $id => $basketItem) {
      $export->writeBeginTag("basketItem id=\"$id\"");
      $export->writeItem($basketItem, '');
      $export->writeEndTag('basketItem');
    }

    $export->writeEndTag('basketItems');
  }

  private static function getPathFileWithTimeStamp(string $pathFile): string
  {
    $timestamp = (new \DateTime)->getTimestamp();

    return str_replace('.', $timestamp . '.', $pathFile);
  }

}