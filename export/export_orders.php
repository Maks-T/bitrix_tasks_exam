<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Экспорт заказов");

use TS\Orders;
use TS\XMLOrdersWriter;

$orders = Orders::getOrdersArray();
XMLOrdersWriter::writeXML($orders);

?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>