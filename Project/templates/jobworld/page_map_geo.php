<!DOCTYPE html>
<html lang="en">
    <head>
        <?php _widget('head');?>
    </head>
    <body class="<?php _widget('custom_paletteclass'); ?>">
        <header>
            <?php _widget('custom_header_menu-for-loginuser');?>
            <?php _widget('header_menu_geosearch'); ?>
        </header><!-- ./ header --> 
        <main class="zebra-sections">
            <div class="section no-padding container container-palette"></div>
            <?php _widget('top_default_contenttitle'); ?>
            <?php _widget('top_category_tiles'); ?>
            <?php _widget('top_agencies'); ?>
            <?php _widget('top_reviews'); ?>
            <?php _widget('top_helper_empty'); ?>
            <?php _widget('top_latest_listings'); ?>
            <?php _widget('top_regions'); ?>
            <?php _widget('bottom_imagegallery'); ?>
        </main>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
    </body>
</html>