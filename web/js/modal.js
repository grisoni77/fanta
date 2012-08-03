
    jQuery(document).ready(function() {
        // if the function argument is given to overlay,
        // it is assumed to be the onBeforeLoad event listener
        jQuery("a[rel]").overlay({

            mask: 'darkred',
            effect: 'apple',

            onBeforeLoad: function() {

                // grab wrapper element inside content
                var wrap = this.getOverlay().find(".contentWrap");

                // load the page specified in the trigger
                wrap.load(this.getTrigger().attr("href"));
            }

        });
    });
