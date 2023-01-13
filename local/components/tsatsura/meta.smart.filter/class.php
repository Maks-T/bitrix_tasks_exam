<?

class MetaSmartFilter extends \CBitrixComponent
{

  public function getFilterValues()
  {
    $res = $this->arResult['SECTION_NAME'];

    $res .= ' + { Цена } - { от ' . $this->arResult['PRICE']['FROM']
       . ' до ' . $this->arResult['PRICE']['TO'] . '} ';


    foreach ($this->arResult['PROPERTIES'] as $prop) {
      $res .= ' + {' . $prop['PROPERTY_NAME'] . '} - {' .
        implode(',', $prop['VALUES']) . '} ';
    }

    return $res;
  }

}