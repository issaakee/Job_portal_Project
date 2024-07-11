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
        <main class="container container-palette pt-75 pb-40">
            <div class="container">
                <?php _widget('center_default_contenttitle'); ?>
                <?php _widget('center_featuredproperties');?>
                <?php _widget('bottom_imagegallery'); ?>
            </div>
        </main>
        <?php _widget('bottom_packadges');?>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
    </body>
</html>