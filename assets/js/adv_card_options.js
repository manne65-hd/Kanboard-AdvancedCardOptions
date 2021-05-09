KB.on('dom.ready', function () {
    $('.acoToggleTextbox').on('mouseenter', function() {
        var elementId = $(this).attr('aco_div_id');
            $('#' + elementId).toggle(125);
      });
});
