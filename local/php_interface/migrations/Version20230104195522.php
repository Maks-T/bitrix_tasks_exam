<?php

namespace Sprint\Migration;


class Version20230104195522 extends Version
{
  protected $description = "Почтовое событие FEED_FORM";

  protected $moduleVersion = "4.2.2";

  /**
   * @return bool|void
   * @throws Exceptions\HelperException
   */
  public function up()
  {
    $helper = $this->getHelperManager();
    $helper->Event()->saveEventType('FEED_FORM', array(
      'LID' => 'ru',
      'EVENT_TYPE' => 'email',
      'NAME' => 'Отправка сообщения через форму обратной связи',
      'DESCRIPTION' => '#USER_NAME# - Имя отправителя
#USER_SURNAME# - Фамилия отправителя
#COMPANY# - Компания и должность
#DEPARTMENT# - Отдел обращения
#MESSAGE# - Сообщение
#EMAIL_TO# - Email получателя письма
#FILE# - Файл вложения',
      'SORT' => '150',
    ));
    $helper->Event()->saveEventMessage('FEED_FORM', array(
      'LID' =>
        array(
          0 => 's1',
        ),
      'ACTIVE' => 'Y',
      'EMAIL_FROM' => 'no-reply@eshop',
      'EMAIL_TO' => '#EMAIL_TO#',
      'SUBJECT' => 'Форма обратной связи',
      'MESSAGE' => 'Имя: #USER_NAME#
Фамилия: #USER_SURNAME#
Компания: #COMPANY#
Отдел обращения: #DEPARTMENT#
Сообщение: #MESSAGE#
Вложение: #FILE#',
      'BODY_TYPE' => 'text',
      'BCC' => '',
      'REPLY_TO' => '',
      'CC' => '',
      'IN_REPLY_TO' => '',
      'PRIORITY' => '',
      'FIELD1_NAME' => '',
      'FIELD1_VALUE' => '',
      'FIELD2_NAME' => '',
      'FIELD2_VALUE' => '',
      'SITE_TEMPLATE_ID' => '',
      'ADDITIONAL_FIELD' =>
        array(),
      'LANGUAGE_ID' => '',
      'EVENT_TYPE' => '[ FEED_FORM ] Отправка сообщения через форму обратной связи',
    ));
  }

  public function down()
  {
    //your code ...
  }
}
