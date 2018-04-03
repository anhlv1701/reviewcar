(function($) {
	'use strict'

	$(document).ready(function ($) {
        var opened = false;
        var dataToggle = '';
        var $element = '';
        var $this = '';

        $('.js_trigger__click').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            $this = $(this);

            dataToggle = $(this).attr('data-toggle');
            if (typeof dataToggle == 'undefined') dataToggle = true;

            $element = $(this).closest('.js_trigger').find('.js_trigger__unit');
            var element = $(this).attr('data-element');
            if (typeof element !== 'undefined') $element = $(element);

            if (dataToggle && dataToggle !== 'false') {
                $element.slideToggle('fast');
            } else {
                $element.toggleClass('active');
            }

            $(this).toggleClass('active');
            opened = $(this).hasClass('active') ? true : false;
        });

        $('body').on('click', '.stm_load_posts', function (e) {
            e.preventDefault();

            $.ajax({
                url: stm_ajaxurl,
                dataType: 'json',
                context: this,
                data: {
                    'page': $(this).attr('data-page'),
                    'per_page': $(this).attr('data-per_page'),
                    'style': $(this).attr('data-style'),
                    'view': $(this).attr('data-view'),
                    'post_type': $(this).attr('data-post_type'),
                    'action': 'events_load_more_posts'
                },
                beforeSend: function beforeSend() {
                    $(this).addClass('loading');
                },
                complete: function complete(data) {
                    $(this).removeClass('loading');
                    var dt = data.responseJSON;
                    var $items = $(dt.content);

                    var contentWrapper = $('.stm-events-load-block');
                    contentWrapper.append($items);

                    if (dt.page) {
                        $(this).attr('data-page', dt.page);
                    } else {
                        $(this).remove();
                    }
                }
            });
        });

        window.dateCountdown();
	});
}(jQuery));

function initGoogleScripts() {
    var stmGmap = new CustomEvent("stm_gmap_api_loaded");
    document.body.dispatchEvent(stmGmap);
}

function dateCountdown() {
    /* Countdown */
    jQuery("[data-countdown]").each(function() {
        var $this = jQuery(this), finalDate = $this.data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime("<span class='heading-font'>%D <small>" + countdownDay + "</small></span> "
                + "<span class='heading-font'>%H <small>" + countdownHrs + "</small></span> "
                + "<span class='heading-font'>%M <small>" + countdownMin + "</small></span> "
                + "<span class='heading-font'>%S <small>" + countdownSec + "</small></span>" ));
        });
    });
}