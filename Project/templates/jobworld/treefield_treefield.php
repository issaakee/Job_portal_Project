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
        <?php _widget('top_search_form');?>
        
        <main class="container container-palette pt-75">
            <div class="container">
                <div class="wraper-row">
                    <div class="column-sidebar">
                        <?php _widget('right_customsearch_visual');?>
                    </div><!-- ./ sidebar--> 
                    <div class="column-content">
                        <?php _widget('center_default_contenttitle'); ?>
                        <?php _widget('center_recentlisting');?>
                        <?php _widget('center_imagegallery'); ?>
                    </div><!-- ./content  --> 
                </div>
            </div>
        </main>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
    </body>
</html>