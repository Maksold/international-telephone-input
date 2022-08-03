define([
    'jquery',
    'intlTelInput'
], function ($, intlTelInput) {
    'use strict';

    return function (validator) {

        $.validator.addMethod(
            'validate-phone-number',
            function (value, element, params) {
                const errorMap = [
                    'Invalid number',
                    'Invalid country code',
                    'Too short',
                    'Too long',
                    'Invalid number'
                ];
                let iti = window.intlTelInputGlobals.getInstance(element);

                if (iti === undefined) {
                    this.itiValidationMessage = "Validator isn't initialized.";
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
                return $.mage.__(this.itiValidationMessage);
            }
        );

        return validator;
    }
});