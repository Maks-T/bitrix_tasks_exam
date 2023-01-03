<?php

namespace Sprint\Migration;


class Version20230103172453 extends Version
{
  protected $description = "Добавляет свойство Лэйблы в инфоблок Одежда";

  protected $moduleVersion = "4.2.2";

  /**
   * @return bool|void
   * @throws Exceptions\HelperException
   */
  public function up()
  {
    $helper = $this->getHelperManager();
    $iblockId = $helper->Iblock()->getIblockIdIfExists('clothes', 'catalog');
    $helper->Iblock()->saveProperty($iblockId, array(
      'NAME' => 'Лэйблы',
      'ACTIVE' => 'Y',
      'SORT' => '500',
      'CODE' => 'LABEL_REF',
      'DEFAULT_VALUE' => '',
      'PROPERTY_TYPE' => 'S',
      'ROW_COUNT' => '1',
      'COL_COUNT' => '30',
      'LIST_TYPE' => 'L',
      'MULTIPLE' => 'Y',
      'XML_ID' => null,
      'FILE_TYPE' => '',
      'MULTIPLE_CNT' => '5',
      'LINK_IBLOCK_ID' => '0',
      'WITH_DESCRIPTION' => 'N',
      'SEARCHABLE' => 'N',
      'FILTRABLE' => 'N',
      'IS_REQUIRED' => 'N',
      'VERSION' => '1',
      'USER_TYPE' => 'directory',
      'USER_TYPE_SETTINGS' =>
        array(
          'size' => 1,
          'width' => 0,
          'group' => 'N',
          'multiple' => 'N',
          'TABLE_NAME' => 'labels',
        ),
      'HINT' => '',
      'FEATURES' =>
        array(
          0 =>
            array(
              'MODULE_ID' => 'catalog',
              'FEATURE_ID' => 'IN_BASKET',
              'IS_ENABLED' => 'N',
            ),
          1 =>
            array(
              'MODULE_ID' => 'iblock',
              'FEATURE_ID' => 'DETAIL_PAGE_SHOW',
              'IS_ENABLED' => 'N',
            ),
          2 =>
            array(
              'MODULE_ID' => 'iblock',
              'FEATURE_ID' => 'LIST_PAGE_SHOW',
              'IS_ENABLED' => 'N',
            ),
        ),
    ));

  }

  public function down()
  {
    //your code ...
  }
}
