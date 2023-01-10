function clickBtnBuyOneclick(productId = '') {
    BX.removeClass(BX(`popup_buy_oneclick_${productId}`), 'hidden');
}

function sendOrder(arParams, productId = '') {

    const form = BX(`form-popup-buy-oneclick_${productId}`);
    const formData = new FormData(form);

    BX.addClass(BX(`popup_buy_oneclick_${productId}`), 'hidden');
    BX.ajax
        .runComponentAction('tsatsura:buy.oneclick', 'ajaxRequest', {
            mode: 'class',
            method: 'POST',
            signedParameters: arParams,
            data: formData,
        })
        .then(
            (response) => {
                if (response.status === 'success') {
                    form.reset();
                    if (response.data.status === 'success') {
                        BX.UI.Notification.Center.notify({
                            content: response.data.message
                        });
                    }
                    if (response.data.status === 'error') {
                        BX.UI.Notification.Center.notify({
                            content: BX.create("div", {
                                style: {
                                    fontSize: "14px",
                                    color: "red",
                                },
                                html: response.data.message
                            })
                        });
                    }
                }
            },
            (response) => {
                if (response.status === 'error') {
                    BX.UI.Notification.Center.notify({
                        content: BX.create("div", {
                            style: {
                                fontSize: "14px",
                                color: "red",
                            },
                            html: "Произошла ошибка"
                        })
                    });
                }
            }
        );
}
