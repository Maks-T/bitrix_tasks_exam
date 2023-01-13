<?

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
  die();
}
/**
 * @var array $arParams
 */


if ($this->StartResultCache())  {

  Loader::includeModule('iblock');
  Loader::includeModule("highloadblock");

  $queries = explode('/', $arParams['URL_SMART_FILTER']);

  $filterUrlParams = [];

  foreach ($queries as $query) {

    if (str_contains($query, 'price')) {

      $arResult['PRICE'] = [
        'FROM' => substr($query, strpos($query,'-from-')+6 , strpos($query,'-from-') - strpos($query,'-to-')-1),
        'TO' => substr($query, strpos($query,'-to-')+4)
      ];
    }
    
    if (str_contains($query, '-is-', )) {

      $arQuery = explode('-is-', $query);
      $filterUrlParams[] = [
        'PROPERTY_CODE' => $arQuery[0],
        'VALUES' => explode('-or-', $arQuery[1])
      ];
    }

  }

//Получение данных о разделе
  $arFilterSection = [
    'IBLOCK_ID' => $arParams['CATALOG_IBLOCK_ID'],
    'CODE' => $arParams['CATALOG_SECTION_CODE']
  ];

  $sect = CIBlockSection::GetList([], $arFilterSection)->fetch();
  $arResult['SECTION_NAME'] = $sect['NAME'];

  $filterKeys = ['NAME', 'CODE', 'PROPERTY_TYPE', 'XML_ID', 'USER_TYPE', 'USER_TYPE_SETTINGS'];
//Получение свойств информационного блока каталога
  $propsFieldsIblockMain = selectPropertiesFromIBlock($arParams['CATALOG_IBLOCK_ID'], $filterKeys);

//Получение данных информационного блока торговые предложения
  $arCatalog = CCatalogSKU::GetInfoByProductIBlock($arParams['CATALOG_IBLOCK_ID']);

//Получение свойств информационного блока каталога торговых предложений
  $propsFieldsIblockSKU = selectPropertiesFromIBlock($arCatalog['IBLOCK_ID'], $filterKeys);
  $propsFieldsIblock = array_merge($propsFieldsIblockMain, $propsFieldsIblockSKU);


//вернуть только те свойства которые есть в параметрах фильтрации URL
  $arrayPropertiesUrl = array_column($filterUrlParams, 'PROPERTY_CODE');

  $propsFieldsIblockSort = array_filter($propsFieldsIblock, function ($prop) use ($arrayPropertiesUrl) {
    return in_array(strtolower($prop['CODE']), $arrayPropertiesUrl);
  });

  $resArrProperty = [];

  foreach ($propsFieldsIblockSort as $prop) {

    //получение списка значений списка из свойств
    if ($prop['PROPERTY_TYPE'] == 'L' && empty($prop['USER_TYPE'])) {
      $enumOfProperty = CIBlockPropertyEnum::GetList([], ['CODE' => $prop['CODE']]);

      $indexUrlParams = array_search(strtolower($prop['CODE']), $arrayPropertiesUrl);

      $resArrPropertyItem['VALUES'] = [];

      while ($itemEnum = $enumOfProperty->GetNext()) {
        if (in_array($itemEnum['XML_ID'], $filterUrlParams[$indexUrlParams]['VALUES'])) {

          $resArrPropertyItem['VALUES'][] = $itemEnum['VALUE'];
        }
      }
      if (!empty($resArrPropertyItem['VALUES'])) {
        $resArrPropertyItem['PROPERTY_NAME'] = $prop['NAME'];
        $resArrProperty[] = $resArrPropertyItem;
      }
      //получение списка значений из справочников
    } elseif (!empty($prop['USER_TYPE'])) {

      $hlblock = HighloadBlockTable::getList([
        'filter' => ['=TABLE_NAME' => $prop['USER_TYPE_SETTINGS']['TABLE_NAME']]
      ])->fetch();

      $hlClassName = (HighloadBlockTable::compileEntity($hlblock))->getDataClass();

      $indexUrlParams = array_search(strtolower($prop['CODE']), $arrayPropertiesUrl);

      $resArrPropertyItem['VALUES'] = [];

      foreach ($filterUrlParams[$indexUrlParams]['VALUES'] as $xmlId) {
        $itemHLDBlock = $hlClassName::getList([
          'filter' => array(
            'UF_XML_ID' => $xmlId,
          ),
          'select' => array("*"),
        ])->fetch();
        $resArrPropertyItem['VALUES'][] = $itemHLDBlock['UF_NAME'];

      }

      if (!empty($resArrPropertyItem['VALUES'])) {
        $resArrPropertyItem['PROPERTY_NAME'] = $prop['NAME'];
        $resArrProperty[] = $resArrPropertyItem;
      }

      //получение простого строкового значения
    } elseif ($prop['PROPERTY_TYPE'] == 'S' && empty($prop['USER_TYPE'])) {
      $indexUrlParams = array_search(strtolower($prop['CODE']), $arrayPropertiesUrl);

      $resArrPropertyItem['VALUES'] = $filterUrlParams[$indexUrlParams]['VALUES'];

      if (!empty($resArrPropertyItem['VALUES'])) {
        $resArrPropertyItem['PROPERTY_NAME'] = $prop['NAME'];
        $resArrProperty[] = $resArrPropertyItem;
      }
    }
  }

  $arResult['PROPERTIES'] = $resArrProperty;

  $this->IncludeComponentTemplate();
}


/**
 * Функция возвращает свойства информационного блока с ключами согласно массиву ключей
 * @param int $iblockId
 * @param array $keyProperties Массив ключей свойства
 * @return array
 */
function selectPropertiesFromIBlock(int $iblockId,  array $keyProperties): array
{
  $arFilterIBlockProperty = [
    'IBLOCK_ID' => $iblockId,
  ];

  $propIBlock = CIBlockProperty::GetList([], $arFilterIBlockProperty);

  return selectPropertiesFromPropertyResult($propIBlock, $keyProperties);
}

/**
 * Вспомогательная функция перебора свойств с ключами согласно массиву ключей
 * @param CIBlockPropertyResult $propIBlock
 * @param array $keyProperties Массив ключей свойства
 * @return array
 */
function selectPropertiesFromPropertyResult(CIBlockPropertyResult $propIBlock, array $keyProperties): array
{
  $propsFields = [];
  
  while ($prop_fields = $propIBlock->GetNext())
  {

    $prop = [];
    
    foreach ( $keyProperties as $nameProperty) {
      $prop[$nameProperty] =  $prop_fields[$nameProperty];
    }
    
    $propsFields[] =  $prop;
  }

  return $propsFields;
}
