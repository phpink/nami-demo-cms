var AcmeThemeBundle = AcmeThemeBundle || {};

AcmeThemeBundle = (function($, window, undefined) {

    return {
        init: function() {
            if (typeof console !== 'undefined') {
                console.log('Main javascript file from AcmeThemeBundle')
            }
        }
    };

}(jQuery, window));

$(function() {
    AcmeThemeBundle.init();
});
