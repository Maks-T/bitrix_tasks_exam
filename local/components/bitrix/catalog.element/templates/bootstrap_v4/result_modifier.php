<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use TS\Labels;

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arResult['HLB_LABELS'] = Labels::getLabels();

$cp = $this->__component;

if (is_object($cp)) {

  $cp->SetResultCacheKeys([('HLB_LABELS')]);
}