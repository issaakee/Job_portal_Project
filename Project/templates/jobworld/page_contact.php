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
        <main class="container container-palette pt-75 pb-40">
            <div class="container">
                <div class="wraper-row">
                    <div class="column-content">
                        <?php _widget('center_contact_map'); ?>
                        <?php _widget('center_default_content'); ?>
                        <?php _widget('center_imagegallery'); ?>
                        <?php _widget('center_contact_form'); ?>
                    </div><!-- ./ content --> 
                    <div class="column-sidebar">
                        <?php if(!empty($settings_email)):?>
                        <div class="widget widget-btn">
                            <div class="widget-btn-icon"><i class="icon_mail_alt"></i></div>
                            <div class="widget-btn-text"><a href="mailto:<?php echo $settings_email;?>"><?php echo $settings_email;?></a></div>
                        </div> <!-- ./ widget --> 
                        <?php endif;?>
                        <?php if(!empty($settings_email)):?>
                        <div class="widget widget-btn">
                            <div class="widget-btn-icon"><i class="icon_phone"></i></div>
                            <div class="widget-btn-text"><a href="tel://<?php echo $settings_phone?>"><?php echo $settings_phone?></a></div>
                        </div><!-- ./ widget --> 
                        <?php endif;?>
                    </div><!-- ./ sidebar  --> 
                </div>
            </div>
        </main>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
    </body>
</html>