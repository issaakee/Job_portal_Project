<!DOCTYPE html>
<html lang="en">
    <head>
        <?php _widget('head');?>
        <?php if(file_exists(FCPATH.'templates/'.$settings_template.'/assets/js/places.js')): ?>
        <script src="assets/js/places.js"></script>
        <?php endif; ?>
    </head>
    <body class="<?php _widget('custom_paletteclass'); ?>">
        <?php if (!empty($settings_facebook_jsdk) && (config_db_item('appId') == '' || !file_exists(FCPATH . 'templates/' . $settings_template . '/assets/js/like2unlock/js/jquery.op.like2unlock.min.js'))): ?>
        <?php
        if (!empty($lang_facebook_code))
            $settings_facebook_jsdk = str_replace('en_EN', $lang_facebook_code, $settings_facebook_jsdk);
        ?>
        <?php echo $settings_facebook_jsdk; ?>
        <?php endif; ?>
        <header>
            <?php _widget('custom_header_menu-for-loginuser');?>
            <?php _widget('header_mainmenu'); ?>
        </header><!-- ./ header --> 
        <div class="saercion section-page-title container container-palette">
            <div class="container">
                <h2 class="title"><?php echo lang_check('Job Open');?></h2>
            </div>
        </div>
        <main class="container container-palette pt-60 m50">
            <div class="container">
                <div class="wraper-row">
                    <div class="column-content">
                        <?php _widget('property_center_description');?>
                        <?php _widget('property_center_share');?>
                        <?php _widget('property_center_ads');?>
                        <?php _widget('property_center_facecomments');?>
                        <?php _widget('property_center_map');?>
                        <?php _widget('property_center_otherlistings');?>
                        <?php _widget('property_center_reviews');?>
                    </div><!-- ./ content --> 
                    <div class="column-sidebar">
                        <?php _widget('property_right_day_work');?>
                        <?php _widget('property_right_save_download_job');?>
                        <?php _widget('property_right_documents');?>
                        <?php _widget('property_right_enquiry-form');?>
                        <?php _widget('property_right_recent_news');?>
                        <?php _widget('property_right_recentproperties');?>
                        <?php _widget('property_right_similar_listings');?>
                        <?php _widget('property_right_ads');?>
                        <?php _widget('property_right_qrcode');?>
                    </div><!-- ./ sidebar --> 
                </div>
            </div>
        </main>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
        <script>
            $(document).ready(function() {
            <?php if(file_exists(APPPATH.'controllers/admin/favorites.php')):?>
                // [START] Add to favorites //  

                $("#add_to_favorites").click(function(){

                    var data = { property_id: {estate_data_id} };

                    var load_indicator = $(this).find('.load-indicator');
                    load_indicator.css('display', 'inline-block');
                    $.post("{api_private_url}/add_to_favorites/{lang_code}", data, 
                           function(data){

                        ShowStatus.show(data.message);

                        load_indicator.css('display', 'none');

                        if(data.success)
                        {
                            $("#add_to_favorites").css('display', 'none');
                            $("#remove_from_favorites").css('display', 'inline-block');
                        }
                    });

                    return false;
                });

                $("#remove_from_favorites").click(function(){

                    var data = { property_id: {estate_data_id} };

                    var load_indicator = $(this).find('.load-indicator');
                    load_indicator.css('display', 'inline-block');
                    $.post("{api_private_url}/remove_from_favorites/{lang_code}", data, 
                           function(data){

                        ShowStatus.show(data.message);

                        load_indicator.css('display', 'none');

                        if(data.success)
                        {
                            $("#remove_from_favorites").css('display', 'none');
                            $("#add_to_favorites").css('display', 'inline-block');
                        }
                    });

                    return false;
                });

                // [END] Add to favorites //  
            <?php endif; ?>
            });

        </script>
    </body>
</html>