define([
    'jquery',
    'mage/translate',
    'intlTelInput'
], function ($, $t, intlTelInput) {
    'use strict';

    return function (validator) {

        $.validator.addMethod(
            'validate-phone-number',
            function (value, element, params) {
                const errorMap = [
                    $t('Invalid phone number'),
                    $t('Invalid country calling code'),
                    $t('Too short to be a phone number'),
                    $t('Too long to be a phone number'),
                    $t('Invalid phone number')
                ];
                let iti = window.intlTelInputGlobals.getInstance(element);

                if (iti === undefined) {
                    this.itiValidationMessage = $t("Validator isn't initialized");
                    return false;
                }

                if (!iti.isValidNumber()) {
                    let errorCode = iti.getValidationError();
                    this.itiValidationMessage = errorMap[errorCode];
                    return false
                }

                // When minimized options are instead replaced with "d" object
                const options = iti.options ? iti.options : iti.d;
                if (iti.hiddenInput !== undefined && (options && options.hiddenInput !== '')) {
                    // Fixes bug when input value is already filled
                    // but submit event doesn't fire an event to update a hiddenInput value
                    iti.hiddenInput.value = iti.getNumber();
                }

                return true;
            },
            function () {
                return this.itiValidationMessage;
            }
        );

        return validator;
    }
});
