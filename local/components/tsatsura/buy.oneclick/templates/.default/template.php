<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
  die();
}

/**
 * @var CBitrixComponentTemplate $this
 * @var array $arParams
 */

use \Bitrix\Main\UI\Extension;

Extension::load("ui.forms");
Extension::load("ui.buttons");
Extension::load("ui.notification");

$signedParameters = $this->getComponent()->getSignedParameters();

?>

<div class="buy-oneclick-wrapper">
    <button class="ui-btn ui-btn-success" onclick="clickBtnBuyOneclick(<?= $arParams['PRODUCT_ID'] ?>);">
      <?= GetMessage('BTN_BUY_ONECLICK') ?>
    </button>
</div>
<div class="popup-wrapper hidden" id="popup_buy_oneclick_<?= $arParams['PRODUCT_ID']; ?>">
    <div class="popup">
        <form onsubmit="sendOrder('<?= $signedParameters ?>', <?= $arParams['PRODUCT_ID'] ?>); return false;"
              class="form-popup-buy-oneclick"
              id="form-popup-buy-oneclick_<?= $arParams['PRODUCT_ID']; ?>"
        >

            <div class="ui-ctl ui-ctl-textbox">
                <div class="ui-ctl-tag"><?= GetMessage('LABEL_PHONE_INPUT'); ?></div>
                <input type="text"
                       class="ui-ctl-element"
                       name="phone"
                       placeholder="<?= GetMessage('PLACEHOLDER_PHONE_INPUT'); ?>"
                >
            </div>

            <button class="ui-btn ui-btn-primary"
                    type="submit"><?= GetMessage("BTN_BUY") ?>
            </button>
        </form>
    </div>
</div>