<?php

declare(strict_types=1);

namespace TS;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\LoaderException;
use CAgent;

class XMLOrdersAgent
{
  protected function __construct()
  {
  }

  public static function start(int $interval = 86400)
  {
    self::stop();
    return CAgent::AddAgent('\TS\XMLOrdersAgent::exportOrders();','','N', $interval);
  }

  public static function stop(): void
  {
    CAgent::RemoveAgent('\TS\XMLOrdersAgent::exportOrders();', '');
  }

  /**
   * @throws ArgumentNullException
   * @throws LoaderException
   * @throws ArgumentException
   */
  public static function exportOrders(): string
  {
    $orders = Orders::getOrdersArray();
    XMLOrdersWriter::writeXML($orders);

    return '\TS\XMLOrdersAgent::exportOrders();';
  }
}