<?php

/** @var array $arResult */
/** @global CMain $APPLICATION */

if (isset($arResult['FIRST_DATE_NEWS'])) {
  $APPLICATION->SetPageProperty('specialdate', $arResult['FIRST_DATE_NEWS']);
}

