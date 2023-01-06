<?php

declare(strict_types=1);

namespace TS;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Loader;
use Bitrix\Main\NotImplementedException;
use Bitrix\Sale\Order;

class Orders
{
  protected function __construct()
  {
  }

  /**
   * @throws ArgumentNullException
   * @throws LoaderException
   * @throws ArgumentException
   */
  public static function getOrdersArray(): array
  {
    $res = [];
    Loader::includeModule('sale');

    $lastOrderId = Orders::getLastOrderId();
    df($lastOrderId);
    $ordersId = Order::getList([
      'select' => [
        "ID",
      ],
      'filter' => array('>ID' => $lastOrderId)
    ]);


    foreach ($ordersId as $orderId) {

      $order = Order::load($orderId['ID']);
      $ordersMainValues = [
        'dateInsert' => $order->getField('DATE_INSERT')->toString(),
        'dateUpdate' => $order->getField('DATE_UPDATE')->toString(),
        'personTypeId' => (int)$order->getField('PERSON_TYPE_ID'),
        'statusId' => $order->getField('STATUS_ID'),
        'price' => $order->getField('PRICE'),
        'discountValue' => $order->getField('DISCOUNT_VALUE'),
        'userId' => $order->getField('USER_ID'),
        'accountnumber' => $order->getField('ACCOUNT_NUMBER'),
        'payed' => $order->getField('PAYED'),
      ];

      $userProperties = [];
      $orderProperties = [];

      $propertyCollection = $order->getPropertyCollection(); //<userProperties>

      foreach ($propertyCollection as $property) {
        if ($property->getProperty()['USER_PROPS'] == 'Y') {
          $userProperties[] = [
            'code' => $property->getField('CODE'),
            'value' => $property->getField('VALUE')
          ];
        } else {
          $orderProperties[] = [
            'code' => $property->getField('CODE'),
            'value' => $property->getField('VALUE')
          ];
        }
      }

      $basketItems = [];
      $basket = $order->getBasket();
      foreach ($basket as $id => $basketItem) {
        $basketItems[$id] = [
          'productId' => $basketItem->getField('PRODUCT_ID'),
          'name ' => $basketItem->getField('NAME'),
          'price' => $basketItem->getField('PRICE'),
          'basePrice' => $basketItem->getField('BASE_PRICE'),
          'quantity' => (int)$basketItem->getField('QUANTITY'),
          'discountPrice' => $basketItem->getField('DISCOUNT_PRICE')
        ];
      }

      $res[$orderId['ID']] = [
        'ordersMainValues' => $ordersMainValues,
        'userProperties' => $userProperties,
        'orderProperties' => $orderProperties,
        'basketItems' => $basketItems
      ];
    }

    return $res;
  }

  /**
   * @throws ArgumentNullException
   * @throws ArgumentOutOfRangeException
   * @throws NotImplementedException
   * @throws ArgumentException
   */
  public static function saveLastOrderId(array $ordersArray): void
  {
    $lastOrderId = array_key_last($ordersArray);
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/upload/orders/config_export_orders.json',
      json_encode(['lastOrderId' => $lastOrderId]));
  }

  public static function getLastOrderId(): int
  {
    $config = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/upload/orders/config_export_orders.json', true);

    return $config ? json_decode($config, true)['lastOrderId'] : -1;
  }
}