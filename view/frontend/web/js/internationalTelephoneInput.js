define([
    'jquery',
    'intlTelInput'
], function ($) {
    return function (config, node) {
        window.intlTelInput(node, config);
    };
});