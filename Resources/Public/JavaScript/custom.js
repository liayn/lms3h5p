(function ($) {
    $(document).ready(function () {
        // Using setTimeout to run after other ready callbacks
        setTimeout(function () {
            window.dispatchEvent(new Event('resize'));
        }, 500);
    });
})(jQuery);