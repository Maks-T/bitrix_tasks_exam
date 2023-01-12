<?

class MetaSmartFilter extends \CBitrixComponent
{

  public function getFilterValues()
  {
    $res = $this->arResult['SECTION_NAME'];

    foreach ($this->arResult['PROPERTIES'] as $prop) {
      $res .= ' + {' . $prop['PROPERTY_NAME'] . '} - {' .
        implode(',', $prop['VALUES']) . '} ';
    }

    return $res;
  }

}