<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Экспорт заказов");

use TS\XMLOrdersAgent;

if (XMLOrdersAgent::start()) {
  echo '<h2> Агент по выгрузке заказов запущен </h2>';
} else {
  echo '<h2> При запуске Агента по выгрузке заказов возникала ошибка </h2>';
}

?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>