
$(document).ready(function(){
    
    /* login page init */
    if($('.page-sign').length){
        
        $('a[data-target]').click(function(e){
            if($($(this).attr('data-target')).length){
                e.preventDefault();
                $('.page_box_animate').removeClass('show');
                $($(this).attr('data-target')).addClass('show');
            }
        })
        
        var location_hash = '';
        // to top right away
        if ( window.location.hash ) {
            location_hash = window.location.hash;
            if(location_hash !=='content' && $(location_hash).length){
                $('.page_box_animate').removeClass('show');
                $(location_hash).addClass('show');
            }
        };
    }
    /* end login page init */
    /* moved in custom_javascip.php
    $('.data_table').DataTable({
        "responsive": true,
    });*/

        /* Start Image gallery 
     *    use css/blueimp-gallery.min.css
     *    use js/blueimp-gallery.min.js
     *    use config assets/js/realsite.js
     *    Site https://github.com/blueimp/Gallery/blob/master/README.md#setup
     *   
     *
     */
    $('body').append('<div id="blueimp-gallery" class="blueimp-gallery">\n\
                        <div class="slides"></div>\n\
                        <h3 class="title"></h3>\n\
                        <a class="prev">&lsaquo;</a>\n\
                        <a class="next">&rsaquo;</a>\n\
                        <a class="close">&times;</a>\n\
                        <a class="play-pause"></a>\n\
                        <ol class="indicator"></ol>\n\
                        </div>')
    $(document).on('click', '.images-gallery .card-gallery:not(.type-file) a', function (e) {
        e.preventDefault();
        var myLinks = new Array();
        var current = $(this).attr('href');
        var curIndex = 0;

        $('.images-gallery .card-gallery:not(.type-file) a').each(function (i) {
            var img_href = $(this).attr('href');
            myLinks[i] = img_href;
            if (current === img_href)
                curIndex = i;
        });

        var options = {index: curIndex}

        blueimp.Gallery(myLinks, options);

        return false;
    });
    
    $(document).on('click', '.listing-gallery .content a', function (e) {
        e.preventDefault();
        var myLinks = new Array();
        var current = $(this).attr('href');
        var curIndex = 0;

        $('.listing-gallery .content a').each(function (i) {
            var img_href = $(this).attr('href');
            myLinks[i] = img_href;
            if (current === img_href)
                curIndex = i;
        });

        var options = {index: curIndex}

        blueimp.Gallery(myLinks, options);

        return false;
    });
    /* End Image gallery */


    /* subscribe */
    $('#sw_footer_subscribe_form').submit(function(e){
    e.preventDefault();
    var $config = $(this).find('.config');
    var conf_link = $config.attr('data-url') || 0;
    var data = $('#sw_footer_subscribe_form').serializeArray();
    
    var load_indicator = $(this).find('.load-indicator');
    load_indicator.css('display', 'inline-block');
          $.post(conf_link, data, 
            function(data){
                load_indicator.css('display', 'none');
                ShowStatus.show(data.message);

                if(data.success)
                {
                  $('#sw_footer_subscribe_form').find('input[name="subscriber_email"]').val('');
                }
          });

          return false;
    });
    /* subscribe */
})


function support_history_api()
{
    return !!(window.history && history.pushState);
}

/* End Image gallery script. Big Image */ 

function custom_number_format(val)
{
    return val.toFixed(2);
}
