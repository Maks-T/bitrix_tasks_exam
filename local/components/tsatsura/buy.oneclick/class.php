<?

use Bitrix\Main\Context;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;
use Bitrix\Main\UserTable;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Delivery\Services\Manager as ServicesManager;
use Bitrix\Sale\Fuser;
use Bitrix\Sale\Helpers\Admin\Blocks\OrderBuyer;
use Bitrix\Sale\Order;
use Bitrix\Sale\PaySystem\Manager;


class BuyOneClick extends CBitrixComponent implements Controllerable
{

  function onPrepareComponentParams($arParams): array
  {

    return $arParams;
  }

  public
  function configureActions()
  {

    return [
      'ajaxRequest' => [
        'prefilters' => [],
      ],
    ];
  }

  protected function listKeysSignedParameters(): array
  {

    return [
      'PRODUCT_ID',
      'TYPE_ORDER',
    ];
  }

  /**
   * @throws \Bitrix\Main\ObjectPropertyException
   * @throws \Bitrix\Main\SystemException
   * @throws \Bitrix\Main\ArgumentException
   */
  public function ajaxRequestAction()
  {
    try {
      Loader::includeModule("sale");
      Loader::includeModule("catalog");

      $request = Context::getCurrent()->getRequest();

      if (!isset($request['phone'])) {
        throw new SystemException(GetMessage('MSG_EMPTY_PHONE'));
      }

      $phone = htmlspecialcharsEx($request['phone']);
      $phone = \NormalizePhone($phone, 7);

      if (!$phone) {
        throw new SystemException(GetMessage('MSG_INVALID_PHONE_NUMBER'));
      }

      $userId = $this->getUserId($phone);

      $basket = $this->getBasket($userId);

      $order = Order::create(SITE_ID, $userId);
      $order->setPersonTypeId(OrderBuyer::getDefaultPersonType($order->getSiteId()));
      $order->setBasket($basket);

      $deliveryId = 2;
      $paymentId = 3;

      $shipmentCollection = $order->getShipmentCollection();
      $shipment = $shipmentCollection->createItem(
        ServicesManager::getObjectById($deliveryId)
      );

      $shipmentItemCollection = $shipment->getShipmentItemCollection();

      foreach ($basket as $basketItem) {
        $product = $shipmentItemCollection->createItem($basketItem);
        $product->setQuantity($basketItem->getQuantity());
      }

      $paymentCollection = $order->getPaymentCollection();
      $payment = $paymentCollection->createItem(Manager::getObjectById($paymentId));

      $payment->setField("SUM", $order->getPrice());
      $payment->setField("CURRENCY", $order->getCurrency());

      $propertyCollection = $order->getPropertyCollection();
      foreach ($propertyCollection as $property) {
        if ($property->getField('CODE') == 'BUYONECLICK') {
          $property->setValue("Y");
        }
        if ($property->getField('CODE') == 'PHONE') {
          $property->setValue($phone);
        }
      }

      $result = $order->save();

      if (!$result->isSuccess()) {
        throw new SystemException(GetMessage('MSG_ORDER_ERROR'));
      }

      return ['status' => 'success', 'message' => GetMessage('MSG_ORDER_SUCCESS')];
    } catch (SystemException $e) {

      return ['status' => 'error', 'message' => $e->getMessage()];
    } catch (Error $e) {

      return ['status' => 'server_error', 'message' => $e->getMessage()];
    }

  }

  public function executeComponent()
  {
    $this->includeComponentTemplate();
  }

  /**
   * @throws \Bitrix\Main\ObjectPropertyException
   * @throws \Bitrix\Main\SystemException
   * @throws \Bitrix\Main\ArgumentException
   */
  private
  function getUserId(
    $phone
  ) {
    global $USER;
    if ($USER->IsAuthorized()) {
      return $USER->GetID();
    }

    $user = UserTable::getRow(array(
      'filter' => array(
        '=LOGIN' => $phone,
      ),
      'select' => array('ID')
    ));

    if ($user['ID']) {
      return $user['ID'];
    }

    return Fuser::getId();
  }

  /**
   * @throws \Bitrix\Main\ArgumentTypeException
   * @throws \Bitrix\Main\ArgumentException
   * @throws SystemException
   * @throws \Bitrix\Main\NotImplementedException
   */
  private function getBasket($userId)
  {
    if ($this->arParams['TYPE_ORDER'] === 'PRODUCT') {

      $basket = Basket::create(SITE_ID);

      $arFields = array(
        'QUANTITY' => 1,
        "PRODUCT_PROVIDER_CLASS" => "\Bitrix\Catalog\Product\CatalogProvider"
      );

      $product = $basket->createItem("catalog", $this->arParams['PRODUCT_ID']);
      $product->setFields($arFields);

      return $basket;
    } elseif ($this->arParams['TYPE_ORDER'] === 'BASKET') {

      return Basket::loadItemsForFUser($userId, Context::getCurrent()->getSite());
    } else {

      throw new SystemException(GetMessage('MSG_INVALID_TYPE_ORDER'));
    }
  }

}