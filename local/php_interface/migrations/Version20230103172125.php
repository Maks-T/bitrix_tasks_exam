<?php

namespace Sprint\Migration;


class Version20230103172125 extends Version
{
  protected $description = "элементы Highload блока Labels";

  protected $moduleVersion = "4.2.2";

  /**
   * @return bool|void
   * @throws Exceptions\HelperException
   */
  public function up()
  {
    $helper = $this->getHelperManager();
    $hlblockId = $helper->Hlblock()->saveHlblock(array(
      'NAME' => 'Labels',
      'TABLE_NAME' => 'labels',
      'LANG' =>
        array(
          'ru' =>
            array(
              'NAME' => 'Лэйблы',
            ),
          'en' =>
            array(
              'NAME' => 'Labels',
            ),
        ),
    ));
    $helper->Hlblock()->saveField($hlblockId, array(
      'FIELD_NAME' => 'UF_COLOR_RGB',
      'USER_TYPE_ID' => 'string',
      'XML_ID' => '',
      'SORT' => '100',
      'MULTIPLE' => 'N',
      'MANDATORY' => 'Y',
      'SHOW_FILTER' => 'N',
      'SHOW_IN_LIST' => 'Y',
      'EDIT_IN_LIST' => 'Y',
      'IS_SEARCHABLE' => 'N',
      'SETTINGS' =>
        array(
          'SIZE' => 20,
          'ROWS' => 1,
          'REGEXP' => '',
          'MIN_LENGTH' => 0,
          'MAX_LENGTH' => 0,
          'DEFAULT_VALUE' => '255, 255, 0',
        ),
      'EDIT_FORM_LABEL' =>
        array(
          'en' => 'Color RGB',
          'ru' => 'Цвет RGB',
        ),
      'LIST_COLUMN_LABEL' =>
        array(
          'en' => 'Color RGB',
          'ru' => 'Цвет RGB',
        ),
      'LIST_FILTER_LABEL' =>
        array(
          'en' => 'Color RGB',
          'ru' => 'Цвет RGB',
        ),
      'ERROR_MESSAGE' =>
        array(
          'en' => '',
          'ru' => '',
        ),
      'HELP_MESSAGE' =>
        array(
          'en' => '',
          'ru' => '',
        ),
    ));
    $helper->Hlblock()->saveField($hlblockId, array(
      'FIELD_NAME' => 'UF_NAME_LABEL',
      'USER_TYPE_ID' => 'string',
      'XML_ID' => '',
      'SORT' => '100',
      'MULTIPLE' => 'N',
      'MANDATORY' => 'Y',
      'SHOW_FILTER' => 'N',
      'SHOW_IN_LIST' => 'Y',
      'EDIT_IN_LIST' => 'Y',
      'IS_SEARCHABLE' => 'N',
      'SETTINGS' =>
        array(
          'SIZE' => 20,
          'ROWS' => 1,
          'REGEXP' => '',
          'MIN_LENGTH' => 0,
          'MAX_LENGTH' => 0,
          'DEFAULT_VALUE' => '',
        ),
      'EDIT_FORM_LABEL' =>
        array(
          'en' => 'Name of Label',
          'ru' => 'Имя лэйбла',
        ),
      'LIST_COLUMN_LABEL' =>
        array(
          'en' => 'Name of Label',
          'ru' => 'Имя лэйбла',
        ),
      'LIST_FILTER_LABEL' =>
        array(
          'en' => 'Name of Label',
          'ru' => 'Имя лэйбла',
        ),
      'ERROR_MESSAGE' =>
        array(
          'en' => '',
          'ru' => '',
        ),
      'HELP_MESSAGE' =>
        array(
          'en' => '',
          'ru' => '',
        ),
    ));
    $helper->Hlblock()->saveField($hlblockId, array(
      'FIELD_NAME' => 'UF_LINK_LABEL',
      'USER_TYPE_ID' => 'string',
      'XML_ID' => '',
      'SORT' => '100',
      'MULTIPLE' => 'N',
      'MANDATORY' => 'Y',
      'SHOW_FILTER' => 'N',
      'SHOW_IN_LIST' => 'Y',
      'EDIT_IN_LIST' => 'Y',
      'IS_SEARCHABLE' => 'N',
      'SETTINGS' =>
        array(
          'SIZE' => 20,
          'ROWS' => 1,
          'REGEXP' => '',
          'MIN_LENGTH' => 0,
          'MAX_LENGTH' => 0,
          'DEFAULT_VALUE' => '#',
        ),
      'EDIT_FORM_LABEL' =>
        array(
          'en' => 'Link of Label',
          'ru' => 'Ссылка лэйбла',
        ),
      'LIST_COLUMN_LABEL' =>
        array(
          'en' => 'Link of Label',
          'ru' => 'Ссылка лэйбла',
        ),
      'LIST_FILTER_LABEL' =>
        array(
          'en' => 'Link of Label',
          'ru' => 'Ссылка лэйбла',
        ),
      'ERROR_MESSAGE' =>
        array(
          'en' => '',
          'ru' => '',
        ),
      'HELP_MESSAGE' =>
        array(
          'en' => '',
          'ru' => '',
        ),
    ));
    $helper->Hlblock()->saveField($hlblockId, array(
      'FIELD_NAME' => 'UF_XML_ID',
      'USER_TYPE_ID' => 'string',
      'XML_ID' => '',
      'SORT' => '100',
      'MULTIPLE' => 'N',
      'MANDATORY' => 'Y',
      'SHOW_FILTER' => 'N',
      'SHOW_IN_LIST' => 'Y',
      'EDIT_IN_LIST' => 'Y',
      'IS_SEARCHABLE' => 'N',
      'SETTINGS' =>
        array(
          'SIZE' => 20,
          'ROWS' => 1,
          'REGEXP' => '',
          'MIN_LENGTH' => 0,
          'MAX_LENGTH' => 0,
          'DEFAULT_VALUE' => '',
        ),
      'EDIT_FORM_LABEL' =>
        array(
          'en' => 'UF_XML_ID',
          'ru' => 'UF_XML_ID',
        ),
      'LIST_COLUMN_LABEL' =>
        array(
          'en' => 'UF_XML_ID',
          'ru' => 'UF_XML_ID',
        ),
      'LIST_FILTER_LABEL' =>
        array(
          'en' => 'UF_XML_ID',
          'ru' => 'UF_XML_ID',
        ),
      'ERROR_MESSAGE' =>
        array(
          'en' => '',
          'ru' => '',
        ),
      'HELP_MESSAGE' =>
        array(
          'en' => '',
          'ru' => '',
        ),
    ));
  }

  public function down()
  {
    //your code ...
  }
}
