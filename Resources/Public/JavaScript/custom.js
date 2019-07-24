(function ($) {
    $(document).ready(function () {
        // Using setTimeout to run after other ready callbacks
        setTimeout(function () {
            if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0) {
                var evt = document.createEvent('UIEvents');
                evt.initUIEvent('resize', true, false, window, 0);
                window.dispatchEvent(evt);
            } else {
                window.dispatchEvent(new Event('resize'));
            }
        }, 500);
    });
})(jQuery);