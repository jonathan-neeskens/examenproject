var message = "Come back plz ♡";
var original;

jQuery(window).focus(function() {
    if (original) {
        document.title = original;
    }
}).blur(function() {
    var title = jQuery('title').text();
    if (title != message) {
        original = title;
    }
    document.title = message;
});

jQuery('.menu-circle').click(function() {
    jQuery(".cover").addClass("active");
    jQuery(".menu-circle").addClass("active");
    jQuery(".menu-content").addClass("active");

    jQuery('.cover').click(function () {
        disableMenu();
    });

    jQuery('.disableMenu').click(function() {
        disableMenu();
    });
});

function disableMenu(){
    jQuery(".cover").removeClass("active");
    jQuery(".menu-circle").removeClass("active");
    jQuery(".menu-content").removeClass("active");
}

jQuery('input').on('input', function() {
    $this = jQuery(this);
    $label = jQuery('label[for="'+ $this.attr('id') +'"]');
    if ($label.length > 0 ) {
        $label.addClass("active");
    }

    if( !this.value ) {
        $label.removeClass("active");
    }
});