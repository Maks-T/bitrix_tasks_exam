<?php

namespace Sprint\Migration;


class Version20230102212521 extends Version
{
  protected $description = "";

  protected $moduleVersion = "4.2.2";

  public function up()
  {
    $helper = $this->getHelperManager();
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => '~allowed_components',
      'VALUE' => '',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => '~script_files',
      'VALUE' => 'php,php3,php4,php5,php6,phtml,pl,asp,aspx,cgi,exe,ico,shtm,shtml',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'archive_step_time',
      'VALUE' => '30',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'default_edit',
      'VALUE' => 'html',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'default_edit_groups',
      'VALUE' => '',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'different_set',
      'VALUE' => 'Y',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'editor_body_class',
      'VALUE' => '',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'editor_body_id',
      'VALUE' => '',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'google_map_api_key',
      'VALUE' => '',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'GROUP_DEFAULT_RIGHT',
      'VALUE' => 'D',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'GROUP_DEFAULT_TASK',
      'VALUE' => '25',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'hide_physical_struc',
      'VALUE' => '',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'log_menu',
      'VALUE' => 'Y',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'log_page',
      'VALUE' => 'Y',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'ml_max_height',
      'VALUE' => '1024',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'ml_max_width',
      'VALUE' => '1024',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'ml_media_available_ext',
      'VALUE' => 'jpg,jpeg,gif,png,flv,mp4,wmv,wma,mp3,ppt,aac',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'ml_media_extentions',
      'VALUE' => 'jpg,jpeg,gif,png,flv,mp4,wmv,wma,mp3,ppt',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'ml_thumb_height',
      'VALUE' => '105',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'ml_thumb_width',
      'VALUE' => '140',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'ml_use_default',
      'VALUE' => '1',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'replace_new_lines',
      'VALUE' => 'Y',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'search_mask',
      'VALUE' => '*.php',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'search_max_open_file_size',
      'VALUE' => '1024',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'search_max_res_count',
      'VALUE' => '',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'search_time_step',
      'VALUE' => '5',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'show_inc_icons',
      'VALUE' => 'N',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'stickers_use_hotkeys',
      'VALUE' => 'N',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'use_code_editor',
      'VALUE' => 'Y',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'use_custom_spell',
      'VALUE' => 'N',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'use_editor_3',
      'VALUE' => 'Y',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'use_medialib',
      'VALUE' => 'Y',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'use_pspell',
      'VALUE' => 'N',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'use_separeted_dics',
      'VALUE' => 'N',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'use_translit',
      'VALUE' => '1',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'use_translit_google',
      'VALUE' => '1',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'user_dics_path',
      'VALUE' => '/bitrix/modules/fileman/u_dics',
    ));
    $helper->Option()->saveOption(array(
      'MODULE_ID' => 'fileman',
      'NAME' => 'yandex_map_api_key',
      'VALUE' => '',
    ));
  }

  public function down()
  {
    //your code ...
  }
}
