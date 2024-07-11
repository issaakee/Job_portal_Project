<?php
$CI = &get_instance();
$CI->load->model('file_m');
// Fetch all files by repository_id
$profile_documents = [];
if(!empty($agent_profile['repository_id'])){
    $files = $this->file_m->get_by(array('repository_id'=>$agent_profile['repository_id']));
    foreach($files as $key=>$file)
    {
        $profile_documents[]->url= base_url('files/'.$file->filename);
    }
}
?>
                                    
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
        
        <div class="saercion section-page-title container container-palette">
            <div class="container">
                <h2 class="title">
                    <?php if($agent_profile['type']== 'USER'):?>
                        <?php echo lang_check('User Profile');?>
                    <?php else:?>
                        <?php echo lang_check('Company Profile');?>
                    <?php endif;?>
                </h2>
            </div>
        </div>
        <main class="container container-palette pt-75 m60">
            <div class="container">
                <?php if($agent_profile['type']== 'USER'):?>
                <div class="wraper-row">
                    <div class="column-content">
                        <div class="widget widget-rsm no-border no-padding">
                            <div class="rsm-header">
                                <div class="preview">
                                    <a href="#"><img src="{agent_image_url}" alt="" /></a>
                                </div>
                                <div class="caption middle">
                                    <h2 class="title">{page_title}</h2>
                                    <div class="description">
                                        <?php if(profile_cf_single(4, FALSE)):?>
                                            <span class="opt"><?php echo profile_cf_single(4, FALSE);?></span>
                                        <?php endif;?>
                                        <span class="opt-light"><i class="icon_pin_alt"></i> <?php echo $agent_profile['address']; ?></span>
                                    </div>
                                </div>
                            </div><!-- ./ profile header --> 
                            <div class="rsm-box">
                                <h3 class="rsm-title"><?php echo lang_check('About Me');?></h3>
                                <div class="decription">
                                    <?php
                                    if(!empty($agent_profile['embed_video_code']))
                                    {
                                        echo $agent_profile['embed_video_code'];
                                        echo '<br />';
                                    }
                                    ?>
                                    <?php echo $agent_profile['description']; ?>
                                </div>
                            </div>
                            <?php if(profile_cf_single(6, FALSE)):?>
                            <div class="rsm-box">
                                <h3 class="rsm-title"><?php echo lang_check('Skills');?></h3>
                                <div class="decription">
                                    <ul class="rsm-list inline">
                                        <?php
                                        $skills = profile_cf_single(6, FALSE);
                                        $skills = explode(',', $skills);
                                        ?>
                                        <?php foreach ($skills as $val):?>
                                            <li><i class="fa fa-check"></i><?php echo $val;?></li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>
                            <?php endif;?>
                            
                        </div> <!-- ./ widget profile card --> 
                    </div><!-- ./ content --> 
                    <div class="column-sidebar">
                        <div class="widget no-border widget-social">
                            <ul class="social-list">
                                <?php if(!empty($agent_profile['facebook_link'])): ?>
                                    <li><a href="<?php echo $agent_profile['facebook_link']; ?>"><i class="fa fa-facebook facebook"></i></a></li>
                                <?php endif; ?>
                                <?php if(!empty($agent_profile['youtube_link'])): ?>
                                    <li><a href="<?php echo $agent_profile['youtube_link']; ?>"><i class="fa fa-youtube youtube"></i></a></li>
                                <?php endif; ?>
                                <?php if(!empty($agent_profile['gplus_link'])): ?>
                                    <li><a href="<?php echo $agent_profile['gplus_link']; ?>"><i class="fa fa-google-plus google"></i></a></li>
                                <?php endif; ?>
                                <?php if(!empty($agent_profile['twitter_link'])): ?>
                                    <li><a href="<?php echo $agent_profile['twitter_link']; ?>"><i class="fa fa-twitter twitter"></i></a></li>
                                <?php endif; ?>
                                <?php if(!empty($agent_profile['linkedin_link'])): ?>
                                    <li><a href="<?php echo $agent_profile['linkedin_link']; ?>"><i class="fa fa-linkedin linkedin"></i></a></li>
                                <?php endif; ?>
                                <li><a href="mailto:<?php echo _ch($agent_mail); ?>"><i class="fa fa-envelope"></i></a></li>
                            </ul>
                        </div> <!-- ./ widget social links--> 
                        <div class="widget widget-contact">
                            <h2 class="contact"><?php echo lang_check('Need help? Call');?> <?php  echo _ch($agent_phone); ?></h2>
                            <div class="actions"> 
                                <?php if(isset($profile_documents) && !empty($profile_documents)):?>
                                    <a href="<?php _che($profile_documents[0]->url);?>" class="btn btn-custom btn-custom-secondary"><?php echo lang_check('Download Resume');?></a>
                                <?php endif;?>
                            </div>
                        </div><!-- ./widget call --> 
                        
                         <?php _widget('right_documents');?>
                        
                        <div class="widget widget-contact"  id="form">
                            <div class="widget-header">
                                <h2 class="title black light">{lang_Enquireform}</h2>
                            </div>
                            <form method="post" class="job-form default jborder" action="{page_current_url}#form">
                                <input type="hidden" name="form" value="contact" />
                                <div class="panel-body">
                                <div class="validation m25">
                                {validation_errors} {form_sent_message}
                                </div>
                                <!-- The form name must be set so the tags identify it -->
                                <input type="hidden" name="form" value="contact" />

                                <div class="form-group {form_error_firstname}">
                                    <input class="form-control" id="firstname" name="firstname" type="text" placeholder="{lang_FirstLast}" value="{form_value_firstname}" />
                                </div>
                                <div class="form-group {form_error_email}">
                                    <input class="form-control" id="email" name="email" type="text" placeholder="{lang_Email}" value="{form_value_email}" />
                                </div>
                                <div class="form-group {form_error_phone}">
                                    <input class="form-control" id="phone" name="phone" type="text" placeholder="{lang_Phone}" value="{form_value_phone}" />
                                </div>
                                 <div class="form-group {form_error_address}">
                                    <input class="form-control" id="address" name="address" type="text" placeholder="{lang_Address}" value="{form_value_address}" />
                                </div>

                                <div class="form-group {form_error_message}">
                                    <textarea id="message" name="message" rows="1" class="form-control" type="text" placeholder="{lang_Message}">{form_value_message}</textarea>
                                </div>

                                <?php if(config_item( 'captcha_disabled')===FALSE): ?>
                                <div class="form-group {form_error_captcha}">
                                    <div class="row">
                                        <div class="col-lg-6" style="padding-top:1px;">
                                            <?php echo $captcha[ 'image']; ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="captcha form-control {form_error_captcha}" name="captcha" type="text" placeholder="{lang_Captcha}" value="" />
                                            <input class="hidden" name="captcha_hash" type="text" value="<?php echo $captcha_hash; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if(config_item('recaptcha_site_key') !== FALSE): ?>
                                <div class="form-group" >
                                    <div class="controls">
                                        <?php _recaptcha(true); ?>
                                   </div>
                                </div>
                               <?php endif; ?>
                                                                <?php if(config_db_item('terms_link') !== FALSE): ?>
                                <?php
                                    $site_url = site_url();
                                    $urlparts = parse_url($site_url);
                                    $basic_domain = $urlparts['host'];
                                    $terms_url = config_db_item('terms_link');
                                    $urlparts = parse_url($terms_url);
                                    $terms_domain ='';
                                    if(isset($urlparts['host']))
                                        $terms_domain = $urlparts['host'];

                                    if($terms_domain == $basic_domain) {
                                        $terms_url = str_replace('en', $lang_code, $terms_url);
                                    }
                                ?>
                                <div class="control-group control-gt-terms">
                                  
                                  <div class="controls">
                                    <?php echo form_checkbox('option_agree_terms', 'true', set_value('option_agree_terms', false), 'class="ezdisabled" id="inputOption_terms"')?>
                                  <a target="_blank" href="<?php echo $terms_url; ?>"><?php echo lang_check('I Agree To The Terms & Conditions'); ?></a>
</div>
                                </div>
                                <?php endif; ?>
                                



                                <?php if(config_db_item('privacy_link') !== FALSE && sw_count($not_logged)>0): ?>
                                                            <?php

                                $site_url = site_url();
                                $urlparts = parse_url($site_url);
                                $basic_domain = $urlparts['host'];
                                $privacy_url = config_db_item('privacy_link');
                                $urlparts = parse_url($privacy_url);
                                $privacy_domain ='';
                                if(isset($urlparts['host']))
                                    $privacy_domain = $urlparts['host'];

                                if($privacy_domain == $basic_domain) {
                                    $privacy_url = str_replace('en', $lang_code, $privacy_url);
                                }
                            ?>
                                <div class="control-group control-gt-terms">
                                  
                                  <div class="controls">
                                    <?php echo form_checkbox('option_privacy_link', 'true', set_value('option_privacy_link', false), 'class="novalidate" required="required" id="inputOption_privacy_link"')?>
                                 <a target="_blank" href="<?php echo $privacy_url; ?>"><?php echo lang_check('I Agree The Privacy'); ?></a>
 </div>
                                </div>
                                <?php endif; ?>
                                </div> 
                                <div class="form-group m0">
                                    <button type="submit" class="btn btn-custom btn-custom-secondary m0"><?php echo lang_check('Send Message');?></button>
                                </div>
                            </form>
                        </div>
                    </div><!-- ./ sidebar --> 
                </div>
                <?php if(isset($page_images) && sw_count($page_images)>2):?>
                <div class="images-gallery widget widget_edit_enabled">
                    <div class="content-box">
                        <div class="row">
                            <?php foreach ($page_images as $key => $val):?>
                                <?php /*skip avatar*/ if($key>2) continue;?>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-gallery">
                                        <a href="<?php _che($val->url);?>" title="<?php _che($val->filename);?>" download="<?php _che($val->url);?>">
                                            <img src="<?php echo _simg($val->thumbnail_url, '430x300');?>" class="image-cover" alt="" />
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <?php endif;?>  
                <?php else:?>
                <div class="wraper-row">
                    <div class="column-content">
                        <div class="widget widget-rsm no-border no-padding">
                            <div class="rsm-header">
                                <div class="preview">
                                    <a href="#"><img src="{agent_image_url}" alt=""></a>
                                </div>
                                <div class="caption middle">
                                    <h2 class="title">{page_title}</h2>
                                    <div class="description">
                                        <span class="opt-light"><i class="icon_pin_alt"></i><?php echo $agent_profile['address']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="rsm-box">
                                <h3 class="rsm-title"><?php echo lang_check('About Company');?></h3>
                                <div class="decription">
                                    <?php
                                    if(!empty($agent_profile['embed_video_code']))
                                    {
                                        echo $agent_profile['embed_video_code'];
                                        echo '<br />';
                                    }
                                    ?>
                                    <?php echo $agent_profile['description']; ?>
                                    <?php //profile_cf_li(); ?>
                                </div>
                            </div>                            
                            <div class="rsm-box">
                                <h3 class="rsm-title">{page_title} <?php echo lang_check('Jobs');?></h3>
                                <div class="decription">
                                    <?php if(!empty($agent_estates)):?>
                                    <div class="results-listings-mixed results-list middle m0">
                                        <div id="ajax_results">
                                            
                                            <div class="result-container">
                                                <?php foreach($agent_estates as $key=>$item): ?>
                                                <?php
                                                /* colors for field #3 */
                                                $helper_class_option_3 ='';
                                                    if(isset($item['option_3']) && !empty($item['option_3'])) {
                                                        $key = array_search($item['option_3'], $options_values_arr_3);
                                                        if($key!== FALSE)
                                                            $helper_class_option_3 = $key;
                                                    }

                                                    /* end colors for field #3 */
                                                ?>
                                                <div class="item">
                                                    <div class="flex-row">
                                                        <div class="grid-content">
                                                            <h3 class="title text-color-secondary"><a href="<?php echo $item['url']; ?>" title="<?php echo _ch($item['option_10']); ?>"><?php echo _ch($item['option_10']); ?></a></h3>
                                                            <div class="options">
                                                                    <?php if(!empty($option_79)):?>
                                                                        <span class="opt"><?php echo _ch($option_79, '-'); ?></span>
                                                                    <?php endif;?>
                                                                    <?php if(!empty($item['option_36']) || !empty($item['option_37'])): ?>
                                                                    <?php 
                                                                        if(!empty($item['option_36']))echo '<span class="option opt-price"><i class="icon_currency"></i>'.$options_prefix_36.price_format($item['option_36'], $lang_id).$options_suffix_36.'</span>';
                                                                        elseif(!empty($item['option_37']))echo '<span class="option opt-price"><i class="icon_currency"></i>'.$options_prefix_37.price_format($item['option_37'], $lang_id).$options_suffix_37.'</span>';
                                                                    ?>
                                                                    <?php endif; ?>
                                                                <span class="opt-light"><i class="icon_pin_alt"></i><?php _che($item['address']); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="grid-side"><span class="item-label text-red helper_option_3_<?php echo $helper_class_option_3;?>"><i class="icon_ribbon_alt"></i><?php echo _ch($item['option_3'], ''); ?></span></div>  
                                                    </div>
                                                </div>
                                                <?php endforeach;?>   
                                            </div>
                                            
                                            <div class="row-fluid clearfix text-center">
                                                <div class="pagination-ajax-results pagination  wp-block default product-list-filters light-gray pagination" rel="ajax_results">
                                                   <?php echo $pagination_links_agent; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                        <div class="widget-content">
                                            <div class="col-xs-12 pt35">
                                                <div class="alert alert-success">
                                                    <?php echo lang_check('Properties not available');?>
                                                </div>
                                            </div>
                                        </div> <!-- /. recent properties -->
                                    <?php endif;?>
                                </div>
                            </div>
                        </div> <!-- ./ widget profile --> 
                    </div> <!-- ./ content --> 
                    <div class="column-sidebar">
                        <div class="widget no-border widget-social">
                            <ul class="social-list">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="mailto:<?php echo $agent_profile['mail']; ?>"><i class="fa fa-envelope"></i></a></li>
                            </ul>
                        </div>  <!-- ./ widget social --> 
                        
                        <div class="widget widget-contact">
                            <h2 class="contact"><?php echo lang_check('Need help? Call');?> <?php  echo _ch($agent_phone); ?></h2>
                            <div class="actions"> 
                                
                                
                                <?php if(isset($profile_documents[2]) && !empty($profile_documents[2])):?>
                                    <a href="<?php _che($profile_documents[2]->url);?>" class="btn btn-custom btn-custom-secondary"><?php echo lang_check('Download Resume');?></a>
                                <?php endif;?>
                            </div>
                        </div><!-- ./widget call --> 
                        
                        <div class="widget widget-jsummary">
                            <div class="widget-header">
                                <h2 class="title black light"><?php echo lang_check('Info');?></h2>
                            </div>
                            <dl class="joptions-dl">
                                <dt><?php echo lang_check('Address');?></dt>
                                <dd><?php echo $agent_profile['address']; ?></dd>
                                <dt><?php echo lang_check('Phone');?></dt>
                                <dd><?php echo $agent_profile['phone']; ?></dd>
                                <dt><?php echo lang_check('Jobs');?>:</dt>
                                <dd><?php echo _ch($agent_estates_total, 0);?></dd>
                                <?php if(profile_cf_single(4, FALSE)):?>
                                    <dt><?php echo lang_check('Industrie');?></dt>
                                    <dd><a href="#"><?php echo profile_cf_single(4, FALSE);?></a></dd>
                                <?php endif;?>
                                <?php if(profile_cf_single(2, FALSE)):?>
                                    <dt><?php echo lang_check('Links');?></dt>
                                    <dd><a href="<?php echo profile_cf_single(2, FALSE);?>"><?php echo lang_check('Website');?></a></dd>
                                <?php endif;?>
                            </dl>
                        </div> <!-- ./ widget --> 
                        <?php _widget('right_documents');?>
                            <div class="widget widget-contact"  id="form">
                            <div class="widget-header">
                                <h2 class="title black light">{lang_Enquireform}</h2>
                            </div>
                            <form method="post" class="job-form default jborder" action="{page_current_url}#form">
                                <input type="hidden" name="form" value="contact" />
                                <div class="panel-body">
                                <div class="validation m25">
                                {validation_errors} {form_sent_message}
                                </div>
                                <!-- The form name must be set so the tags identify it -->
                                <input type="hidden" name="form" value="contact" />

                                <div class="form-group {form_error_firstname}">
                                    <input class="form-control" id="firstname" name="firstname" type="text" placeholder="{lang_FirstLast}" value="{form_value_firstname}" />
                                </div>
                                <div class="form-group {form_error_email}">
                                    <input class="form-control" id="email" name="email" type="text" placeholder="{lang_Email}" value="{form_value_email}" />
                                </div>
                                <div class="form-group {form_error_phone}">
                                    <input class="form-control" id="phone" name="phone" type="text" placeholder="{lang_Phone}" value="{form_value_phone}" />
                                </div>
                                 <div class="form-group {form_error_address}">
                                    <input class="form-control" id="address" name="address" type="text" placeholder="{lang_Address}" value="{form_value_address}" />
                                </div>

                                <div class="form-group {form_error_message}">
                                    <textarea id="message" name="message" rows="1" class="form-control" type="text" placeholder="{lang_Message}">{form_value_message}</textarea>
                                </div>

                                <?php if(config_item( 'captcha_disabled')===FALSE): ?>
                                <div class="form-group {form_error_captcha}">
                                    <div class="row">
                                        <div class="col-lg-6" style="padding-top:1px;">
                                            <?php echo $captcha[ 'image']; ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="captcha form-control {form_error_captcha}" name="captcha" type="text" placeholder="{lang_Captcha}" value="" />
                                            <input class="hidden" name="captcha_hash" type="text" value="<?php echo $captcha_hash; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if(config_item('recaptcha_site_key') !== FALSE): ?>
                                <div class="form-group" >
                                    <div class="controls">
                                        <?php _recaptcha(true); ?>
                                   </div>
                                </div>
                               <?php endif; ?>
                                                                <?php if(config_db_item('terms_link') !== FALSE): ?>
                                <?php
                                    $site_url = site_url();
                                    $urlparts = parse_url($site_url);
                                    $basic_domain = $urlparts['host'];
                                    $terms_url = config_db_item('terms_link');
                                    $urlparts = parse_url($terms_url);
                                    $terms_domain ='';
                                    if(isset($urlparts['host']))
                                        $terms_domain = $urlparts['host'];

                                    if($terms_domain == $basic_domain) {
                                        $terms_url = str_replace('en', $lang_code, $terms_url);
                                    }
                                ?>
                                <div class="control-group control-gt-terms">
                                  
                                  <div class="controls">
                                    <?php echo form_checkbox('option_agree_terms', 'true', set_value('option_agree_terms', false), 'class="ezdisabled" id="inputOption_terms"')?>
                                  <a target="_blank" href="<?php echo $terms_url; ?>"><?php echo lang_check('I Agree To The Terms & Conditions'); ?></a>
</div>
                                </div>
                                <?php endif; ?>
                                



                                <?php if(config_db_item('privacy_link') !== FALSE && sw_count($not_logged)>0): ?>
                                                            <?php

                                $site_url = site_url();
                                $urlparts = parse_url($site_url);
                                $basic_domain = $urlparts['host'];
                                $privacy_url = config_db_item('privacy_link');
                                $urlparts = parse_url($privacy_url);
                                $privacy_domain ='';
                                if(isset($urlparts['host']))
                                    $privacy_domain = $urlparts['host'];

                                if($privacy_domain == $basic_domain) {
                                    $privacy_url = str_replace('en', $lang_code, $privacy_url);
                                }
                            ?>
                                <div class="control-group control-gt-terms">
                                  
                                  <div class="controls">
                                    <?php echo form_checkbox('option_privacy_link', 'true', set_value('option_privacy_link', false), 'class="novalidate" required="required" id="inputOption_privacy_link"')?>
                                 <a target="_blank" href="<?php echo $privacy_url; ?>"><?php echo lang_check('I Agree The Privacy'); ?></a>
 </div>
                                </div>
                                <?php endif; ?>
                                </div> 
                                <div class="form-group m0">
                                    <button type="submit" class="btn btn-custom btn-custom-secondary m0"><?php echo lang_check('Send Message');?></button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- ./ sidebar --> 
                </div>
                <?php if(isset($page_images) && sw_count($page_images)>2):?>
                <div class="images-gallery widget widget_edit_enabled">
                    <div class="content-box">
                        <div class="row">
                            <?php foreach ($page_images as $key => $val):?>
                                <?php /*skip avatar*/ if($key < 2) continue;?>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-gallery">
                                        <a href="<?php _che($val->url);?>" title="<?php _che($val->filename);?>" download="<?php _che($val->url);?>">
                                            <img src="<?php echo _simg($val->thumbnail_url, '430x300');?>" class="image-cover" alt="" />
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <?php endif;?>   
                <?php endif;?>
            </div>
        </main>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
   
<?php if(file_exists(APPPATH.'controllers/admin/claim.php')):?>
<?php
/* Popup form 
 * lib 
 *  css: assets/libraries/magnific-popup/magnific-popup.css
 *  js: assets/libraries/magnific-popup/jquery.magnific-popup.js
 *  link: https://plugins.jquery.com/magnific-popup/ ???
 * 
 */
$property_id = '1';
?>
<?php if(isset($property_id)): ?>

<!-- form itself -->
<form id="popup_claim_property" class="form-horizontal mfp-hide white-popup-block">
    <div id="main">
        <div class="text-center">
            <h3><?php echo lang_check('Claim Account');?></h3>
        </div>
        <div id="popup-form-validation-claim">
        <p class="hidden alert alert-error"><?php echo lang_check('Submit failed, please populate all fields!'); ?></p>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputName"><?php echo lang_check('YourName'); ?></label>
            <div class="controls">
                <input type="text" name="name" class="form-control" id="inputName" value="<?php echo $this->session->userdata('name'); ?>" placeholder="<?php echo lang_check('YourName'); ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputSurName"><?php echo lang_check('Surname'); ?></label>
            <div class="controls">
                <input type="text" name="surname" class="form-control" id="inputSurName" value="<?php echo $this->session->userdata('surname'); ?>" placeholder="<?php echo lang_check('Your Surname'); ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPhone"><?php echo lang_check('Phone'); ?></label>
            <div class="controls">
                <input type="text" name="phone" class="form-control" id="inputPhone" value="<?php echo $this->session->userdata('phone'); ?>" placeholder="<?php echo lang_check('Phone'); ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail"><?php echo lang_check('Email'); ?></label>
            <div class="controls">
                <input type="text" name="email" class="form-control" id="inputEmail" value="<?php echo $this->session->userdata('email'); ?>" placeholder="<?php echo lang_check('Email'); ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail"><?php echo lang_check('Message'); ?></label>
            <div class="controls">
                <textarea name="message" class="form-control" style='width: 220px;' id="message"><?php echo $this->session->userdata('message'); ?></textarea>
            </div>
        </div>
        
        <?php 
            $CI = &get_instance();
            $CI->load->model('repository_m');
            $repository_id = NULL;
            if(isset($_POST['repository_id']))
            {
                $repository_id = $CI->data['repository_id'] = $_POST['repository_id'];
            }
            else
            {
                // Create new repository
                $repository_id = $CI->repository_m->save(array('name'=>'file_m', 'is_activated'=>0));
                $this->data['repository_id'] = $repository_id;
            }
            ?>
            <div class="control-group UPLOAD-FIELD-TYPE" id="main">
            <div class="controls">
                <div class="field-row hidden">
                    <?php echo form_input('repository_id', $repository_id, 'class="form-control skip-input" id="repository_id" placeholder="repository_id"')?>
                </div>
                <?php if(empty($repository_id)): ?>
                <span class="label label-danger"><?php echo lang('After saving, you can add files and images');?></span>
                <br style="clear:both;" />
                <?php else: ?>
                <!-- Button to select & upload files -->
                <div class="row_upload">
                    <span class="btn btn-success fileinput-button">
                        <span><?php echo lang_check('Upload Document');?></span>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload_<?php echo $repository_id; ?>" class="FILE_UPLOAD file_<?php echo $repository_id; ?>" type="file" name="files[]" multiple>
                    </span><br style="clear: both;" />
                    <!-- The global progress bar -->
                    <div class="fileupload-progress fade" id="progress_<?php echo $repository_id; ?>">
                        <!-- The global progress bar -->
                        <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            <div class="bar" style="width:0%;"></div>
                        </div>
                    </div>
                </div>
                <!-- The list of files uploaded -->
                <ul id="files_<?php echo $repository_id; ?>">
                    <?php 
                    if(isset($repository_id)){
                        //Fetch repository
                        $file_rep = $this->file_m->get_by(array('repository_id'=>$repository_id));
                        if(sw_count($file_rep)) foreach($file_rep as $file_r)
                        {
                            $delete_url = site_url_q('files/upload/rep_'.$file_r->repository_id, '_method=DELETE&amp;file='.rawurlencode($file_r->filename));

                            echo "<li><a target=\"_blank\" href=\"".base_url('files/'.$file_r->filename)."\">$file_r->filename</a>".
                                 '&nbsp;&nbsp;<button class="btn btn-xs btn-mini btn-danger" data-type="POST" data-url='.$delete_url.'><i class="icon-trash icon-white"></i></button></li>';
                        }
                    }
                    ?>
                </ul>

                <!-- JavaScript used to call the fileupload widget to upload files -->
                <script >
                // When the server is ready...
                $( document ).ready(function() {

                    // Define the url to send the image data to
                    var url_<?php echo $repository_id; ?> = '<?php echo site_url('files/upload_repository/'.$repository_id);?>';

                    // Call the fileupload widget and set some parameters
                    $('#fileupload_<?php echo $repository_id; ?>').fileupload({
                        url: url_<?php echo $repository_id; ?>,
                        autoUpload: true,
                        dropZone: $('#fileupload_<?php echo $repository_id; ?>'),
                        dataType: 'json',
                        done: function (e, data) {
                            // Add each uploaded file name to the #files list
                            var added=false;
                            $.each(data.result.files, function (index, file) {
                                if(!file.hasOwnProperty("error"))
                                {
                                    $('#files_<?php echo $repository_id; ?>').append('<li><a href="'+file.url+'" target="_blank">'+file.name+'</a>&nbsp;&nbsp;<button class="btn btn-xs btn-mini btn-danger" data-type="POST" data-url='+file.delete_url+'><i class="icon-trash icon-white"></i></button></li>');
                                    added=true;
                                }
                                else
                                {
                                    ShowStatus.show(file.error);
                                }
                            });
                            
                            var $progress = $('#progress_<?php echo $repository_id; ?>');
                            $progress.removeClass('in');
                            $progress.find('.bar').css('width', '0%');
                            
                            if(added)
                            {
                                $('<?php echo '#repository_id'; ?>').val(data.result.repository_id);
                                reset_events_<?php echo $repository_id; ?>();
                            }
                        },
                        progressall: function (e, data) {
                            // Update the progress bar while files are being uploaded
                            var $progress = $('#progress_<?php echo $repository_id; ?>');
                            $progress.addClass('in');
                            $progress.find('.bar').css('width', '0%');
                            
                            var progress = parseInt(data.loaded / data.total * 100, 10);
                            $progress.find('.bar').css(
                                'width',
                                progress + '%'
                            );
                        }
                    });

                    reset_events_<?php echo $repository_id; ?>();
                });

                function reset_events_<?php echo $repository_id; ?>(){
                    $("#files_<?php echo $repository_id; ?> li button").unbind();
                    $("#files_<?php echo $repository_id; ?> li button.btn-danger").click(function(){
                        var image_el = $(this);

                        $.post($(this).attr('data-url'), function( data ) {
                            var obj = jQuery.parseJSON(data);

                            if(obj.success)
                            {
                                image_el.parent().remove();
                            }
                            else
                            {
                                ShowStatus.show('<?php echo lang_check('Unsuccessful, possible permission problems or file not exists'); ?>');
                            }
                            //console.log("Data Loaded: " + obj.success );
                        });

                        return false;
                    });
                }

                </script>
                <?php endif;?>
                <!-- <p>(<?php echo lang_check('Copy of Trade License, Certificate of Incorporation, etc.');?>)</p> -->
           </div>
        </div>
        
        <div class="control-group">
            <div class="controls">
                <div class="checkbox">
                    <label>
                        <input name="allow_contact" class="" value="1" type="checkbox"> 
                        <?php echo lang_check('I agree to the'); ?> 
                        <a style="color:red" href="<?php echo  site_url($lang_code.'/183');?>"><?php echo lang_check('Terms Of Use'); ?></a>,
                        <?php echo lang_check('the'); ?> 
                        <a style="color:red" href="<?php echo  site_url($lang_code.'/184');?>"><?php echo lang_check('Privacy Policy'); ?></a>,
                        <?php echo lang_check('and the'); ?>
                        <a style="color:red" href="<?php echo  site_url($lang_code.'/185');?>"><?php echo lang_check('Cookie Policy'); ?></a>.
                    </label>
                </div>
            </div>
        </div>
        
        <?php if(config_item('captcha_disabled') === FALSE): ?>
              <div class="form-group" >
                  <label class="control-label captcha"><?php echo $captcha['image']; ?></label>
                  <div class="controls">
                      <input class="captcha form-control" name="captcha" type="text" placeholder="<?php _l('Captcha');?>" value="" />
                      <input class="hidden" name="captcha_hash" type="text" value="<?php echo $captcha_hash; ?>" />
                  </div>
              </div>
              <?php endif; ?>
              <?php if(config_item('recaptcha_site_key') !== FALSE): ?>
              <div class="form-group" >
                  <div class="controls">
                      <?php _recaptcha(true); ?>
                 </div>
              </div>
        <?php endif; ?>
        
        <div class="control-group">
            <div class="controls">
                <button id="unhide-claim-mask" type="button" class="btn btn-custom btn-custom-secondary"><?php echo lang_check('Submit'); ?></button>
                <img id="ajax-indicator-masking" alt="load" src="assets/img/ajax-loader.gif" style="display: none;" />
            </div>
        </div>
    </div>
</form>

<script>
    // transfer to down page
    $('document').ready(function(){
      $('body').append($('#popup_claim_property').detach());
    })
     
    $('document').ready(function(){
            // Popup form Start //
                $('#claim_property.popup-with-form-claim').magnificPopup({
                	type: 'inline',
                	preloader: false,
                	focus: '#name',
                                    
                	// When elemened is focused, some mobile browsers in some cases zoom in
                	// It looks not nice, so we disable it:
                	callbacks: {
                		beforeOpen: function() {
                			if($(window).width() < 700) {
                				this.st.focus = false;
                			} else {
                				this.st.focus = '#name';
                			}
                		}
                	}
                });
                
                
                $('#popup_claim_property #unhide-claim-mask').click(function(){
                    
                    var data = $('#popup_claim_property').serializeArray();
                    data.push({name: 'model_id', value: "<?php echo $page_id; ?>"});
                    data.push({name: 'model', value: "user_m"});
                    
                    //console.log( data );
                    $('#popup_claim_property #ajax-indicator-masking').css('display', 'inline');
                    $('#popup_claim_property #popup-form-validation-claim').html('');
                    
                    // send info to agent
                    $.post("<?php echo site_url('api/claim/'.$lang_code); ?>", data,
                    function(data){
                        if(data.message)
                            ShowStatus.show(data.message)
                        
                        if(data.success)
                        {
                            // Display agent details
                            $('#claim_property.popup-with-form-claim').css('display', 'none');
                            // Close popup
                            $.magnificPopup.instance.close();
                            $('.claim-claimed').removeClass('hidden');
                        }
                        else
                        {
                            $('.alert.hidden').css('display', 'block');
                            $('.alert.hidden').css('visibility', 'visible');
                            
                            $('#popup_claim_property #popup-form-validation-claim').html(data.errors);
                            
                        }
                        $('#popup_claim_property #ajax-indicator-masking').css('display', 'none');
                    });

                    return false;
                });
                
            // Popup form End //     
    })
</script>
<?php endif; ?>
<?php endif; ?>
    </body>
</html>