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

                return true;
            },
            function () {
                return this.itiValidationMessage;
            }
        );

        return validator;
    }
});