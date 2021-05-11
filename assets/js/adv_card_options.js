KB.on('dom.ready', function () {
    $('.acoToggleTextbox').on('mousedown', function() {

        // declare the IDs
        var iconId = '#aco_icon_' + $(this).attr('toggle_type') + $(this).attr('toggle_id');
        var tboxId = '#aco_tbox_' + $(this).attr('toggle_type') + $(this).attr('toggle_id');
        // get the show/hide-messages
        var title_show = $(this).attr('title_show');
        var title_hide = $(this).attr('title_hide');

        // disable contextmenu(right click) for the element!
        $(iconId).bind("contextmenu", function(e) {
        return false;
        });

        // let's toggle the textbox
            $(tboxId).slideToggle(200, function(){
                // after toggeling we'll have to change some attributes of the icon
                if ($(tboxId).is(':visible')) {
                    $(iconId).css('opacity', '0.5');
                    $(iconId).attr('title', title_hide);

                } else {
                    $(iconId).css('opacity', '1.0');
                    $(iconId).attr('title', title_show);
                }
            });

      });
});
