<?php
/*
Widget-title: Main menu/Title/Actions (not full width)
Widget-preview-image: /assets/img/widgets_preview/head_mainmenu.jpg
 */
?>
<div class="nav-bar container container-palette widget_edit_enabled">
    <div class="container">
        <div class="flex-row">
            <div class="grid logo-container">
                <div class="logo">
                    <a href="{homepage_url_lang}">
                    <?php if(!empty($website_logo_url) && stripos($website_logo_url, 'assets/img/logo.png') === FALSE):?>
                        <img src="<?php echo $website_logo_url; ?>" alt="{settings_websitetitle}">
                     <?php else:?>
                        <?php
                        $first_w =  strtok($settings_websitetitle, " "); // Test
                        ?>
                        <b class="text-color-primary"> <?php echo $first_w;?></b>
                        <?php echo str_replace($first_w, '', $settings_websitetitle);?>
                    <?php endif;?>
                    </a>
                </div>
            </div><!-- ./ logo --> 
            <div class="grid nav-menu">
                <?php _widget('custom_mainmenu'); ?>
            </div><!-- ./ main menu --> 
            <div class="grid quick-navigation">            
                <?php if(config_db_item('property_subm_disabled')==FALSE):  ?>
                {not_logged}
                    <a href="{front_login_url}#content" data-toggle="modal" data-target="#login-modal" class="btn btn-clear"><i class="icon_profile"></i><?php echo lang_check('Log In');?></a>
                {/not_logged}
                {is_logged_user}
                    <a href="{logout_url}" class="btn btn-clear"><?php _l('Logout');?></a>
                {/is_logged_user}
                {is_logged_other}
                    <a href="{logout_url}" class="btn btn-clear"><?php _l('Logout');?></a>
                {/is_logged_other}
                <?php endif;?>
                <?php if(config_db_item('property_subm_disabled')==FALSE):  ?>
                    <?php if(config_db_item('enable_qs') == 1): ?>
                        <a href="<?php echo site_url('fquick/submission/'.$lang_code); ?>" class="btn btn-custom btn-custom-secondary"><?php echo lang_check('Post Jobs');?></a>
                    <?php else: ?>
                        <a href="<?php echo site_url('frontend/editproperty/'.$lang_code.'#content');?>" class="btn btn-custom btn-custom-secondary"><?php echo lang_check('Post Jobs');?></a>
                    <?php endif; ?>
                <?php endif;?>
                 <?php _widget('custom_langmenu'); ?>
            </div><!-- ./ actions panel --> 
        </div>
    </div>
</div> <!-- ./ navigation bar --> 