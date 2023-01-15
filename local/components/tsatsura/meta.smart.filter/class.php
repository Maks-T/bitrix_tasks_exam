<?

declare(strict_types=1);

use Bitrix\Main\Config\Configuration;

class MetaSmartFilter extends \CBitrixComponent
{

  public function getFilterValues()
  {

    $res = Configuration::getValue('meta_template_smart_filter');

    $res = str_replace('{h1 | title}', $this->arResult['SECTION_NAME'], $res);

    if (!empty($this->arResult['PRICE'])) {
      $priceValue = 'от ' . $this->arResult['PRICE']['FROM'] .
        ' до ' . $this->arResult['PRICE']['TO'];

      $res = str_replace(['{price}', '{price.value}'], ['Цена', $priceValue], $res);
    } else {
      $res = str_replace('+ {price} - {price.value} ', '', $res);
    }

    if (!empty($this->arResult['PROPERTIES'])) {
      $properties = '';
      foreach ($this->arResult['PROPERTIES'] as $prop) {
        $properties .= ' + ' . $prop['PROPERTY_NAME'] . ' - ' .
          implode(',', $prop['VALUES']);
      }
      $res = str_replace('+ {property.name} - {property.value}', $properties, $res );
    } else {
      $res = str_replace('+ {property.name} - {property.value}', '', $res);
    }

    return $res;
  }

}