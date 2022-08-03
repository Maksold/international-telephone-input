var config = {
    paths: {
        "intlTelInput": 'MaxMage_InternationalTelephoneInput/js/intlTelInput',
        "intlTelInputUtils": 'MaxMage_InternationalTelephoneInput/js/utils',
        "internationalTelephoneInput": 'MaxMage_InternationalTelephoneInput/js/internationalTelephoneInput'
    },
    shim: {
        'intlTelInput': {
            'deps': ['jquery', 'knockout']
        },
        'internationalTelephoneInput': {
            'deps': ['jquery', 'intlTelInput']
        }
    },
    config: {
        mixins: {
            'mage/validation': {
                'MaxMage_InternationalTelephoneInput/js/phone-number-validation-mixin': true
            }
        }
    }
};