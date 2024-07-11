<!DOCTYPE html>
<html lang="en">
    <head>
        <?php if(config_item('scroll_animation_enable')!==FALSE && empty($is_rtl)):?>
        <link rel="stylesheet" href="assets/libraries/scroll_animation/css/animations.css" />
        <?php endif;?>
        <!-- Start JS MAP  -->
        <?php _widget('head');?>
        <!-- Start Template files -->
        <link rel="stylesheet" href="assets/css/jobworld_alternative.css" />
        <!-- End  Template files -->
    </head>
    <body class="overhidden-x <?php _widget('custom_paletteclass'); ?>">
        <header>
            <?php _widget('custom_header_menu-for-loginuser_container');?>
            <?php _widget('header_mainmenu_container'); ?>
        </header><!-- ./ header --> 
        <?php _widget('top_board_search_form_fill'); ?>
        <?php _widget('top_default_contenttitle'); ?>
        <?php _widget('top_static_content_1'); ?>
        <?php _widget('top_listing_slider'); ?>
        <?php _widget('top_recent_listings_by_area'); ?>
        <?php _widget('top_recent_articles'); ?>
        <?php _widget('bottom_imagegallery'); ?>
        
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'alternative')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
        <?php if(config_item('scroll_animation_enable')!==FALSE && empty($is_rtl)):?>
        <script src="assets/libraries/scroll_animation/js/scroll_animation.js"></script>
        <?php endif;?>
    </body>
</html>