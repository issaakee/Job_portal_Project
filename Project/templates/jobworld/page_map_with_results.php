<!DOCTYPE html>
<html lang="en">
    <head>
        <?php _widget('head');?>
    </head>
    <body class="<?php _widget('custom_paletteclass'); ?>">
        <header>
            <?php _widget('custom_header_menu-for-loginuser');?>
            <?php _widget('header_mainmenu'); ?>
        </header><!-- ./ header --> 
        <?php _widget('top_mapsearch_visual');?>
        <?php _widget('top_default_contenttitle'); ?>
        <?php _widget('top_recent_listings'); ?>
        <?php _widget('top_counting_html'); ?>
        <?php _widget('top_recent_articles'); ?>
        <?php _widget('top_banner_html'); ?>
        <?php _widget('bottom_imagegallery'); ?>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
    </body>
</html>