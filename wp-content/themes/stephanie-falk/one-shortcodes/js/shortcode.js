(function( $ ){
	$( document ).ready( function() {
		/* Shinybox init */
		try {
            if(jQuery(".attachment > a, .gallery-item .gallery-icon a, figure.wp-caption a").length){
                jQuery(".attachment > a, .gallery-item .gallery-icon a, figure.wp-caption a").each(function(i, v){

                	/* Attach shinybox with the images urls only. */
                    var anchor = jQuery(this);
                    var url = jQuery(this).attr('href');
                    var image_url = new RegExp('^(http|ftp)://.*(jpg|jpeg|png|gif|bmp)');
                    if(image_url.test(url)){
                        var caption = jQuery(this).parent().parent().find('figcaption').text();
                        jQuery(this).attr('title', caption);
                        jQuery(this).addClass('shinybox');
                        jQuery(".shinybox").unbind('click').shinybox();
					}
                });
            }

	    } catch(e) {}
	} );
})( jQuery );