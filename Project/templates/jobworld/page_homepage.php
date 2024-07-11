<!DOCTYPE html>
<html lang="en">
    <head>
        <?php _widget('head');?>
    </head>
    <body class="<?php _widget('custom_paletteclass'); ?>">
        <header>
            <?php _widget('custom_header_menu-for-loginuser');?>
            <?php _widget('header_mainmenu_color'); ?>
        </header><!-- ./ header --> 
        <?php _widget('top_mapsearch_visual');?>
        <?php _widget('top_default_contenttitle'); ?>
        <?php _widget('custom_top_recent_properties');?>
        <?php _widget('top_popular_advices_html');?>
        <?php _widget('top_download_app');?>
        <?php _widget('bottom_imagegallery'); ?>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
    </body>
</html>