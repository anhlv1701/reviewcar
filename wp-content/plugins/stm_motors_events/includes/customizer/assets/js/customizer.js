jQuery(document).ready(function ($) {
    "use strict";

    function changeHeaderEl() {
        var curVal = $('#events_archive option:selected').val();

        console.log(curVal);

        if(curVal == 'block') {
            $('#customize-control-events_archive_sidebar_position').hide();
            $('#customize-control-events_block_title_bg').show();
            $('#customize-control-events_subtitle').show();
        } else {
            $('#customize-control-events_archive_sidebar_position').show();
            $('#customize-control-events_block_title_bg').hide();
            $('#customize-control-events_subtitle').hide();
        }
    }

    if($('#events_archive').length) {
        changeHeaderEl();
        console.log(1);
        $('#events_archive').on('change', function(){
            console.log(2);
            changeHeaderEl();
        });
    }
});