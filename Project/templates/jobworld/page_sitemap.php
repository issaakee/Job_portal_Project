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
        <?php _widget('top_pagetitle'); ?>
        <?php _widget('top_default_contenttitle'); ?>
        <?php _widget('bottom_imagegallery'); ?>
        <main class="container container-palette pt-75 pb-40">
            <div class="container">
                <?php if(file_exists(APPPATH.'controllers/admin/treefield.php')):?>
                <div class="widget">
                    <div class="widget-header">
                        <h2 class="title"><?php echo lang_check('Neighborhood Sitemap'); ?></h2>
                    </div>
                    <div class="content-box"> 
                        <?php echo treefield_sitemap(64, $lang_id, 'ul'); ?>
                    </div>
                </div>
                <?php endif;?>
                <div class="widget widget-sitemap">
                    <div class="widget-header">
                        <h2 class="title"><?php echo lang_check('Website sitemap');?></h2>
                    </div>
                    <div class="content-box"> 
                         <?php echo website_sitemap($lang_id, 'ul'); ?>
                    </div>
                </div>
            </div>
        </main>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
    </body>
</html>