<!DOCTYPE html>
<html lang="en">
    <head>
        <?php _widget('head');?>
    </head>
    <body class="<?php _widget('custom_paletteclass'); ?>">
        <header>
            <?php _widget('header_mainmenu'); ?>
        </header><!-- ./ header --> 
        <?php _widget('top_pagetitle'); ?>
        <main class="container container-palette pt-75 m30">
            <div class="container">
                <div class="wraper-row">
                    <div class="column-content">
                        <div class="widget">
                            <div class="widget-header">
                                <h2 class="title">{page_title}</h2>
                            </div>
                            <div>
                                <div class="m30">
                                    {page_body}
                                    {has_page_documents}
                                    <h5><?php _l('Filerepository');?>{</h5>
                                    <ul>
                                    {page_documents}
                                    <li>
                                        <a href="{url}">{filename}</a>
                                    </li>
                                    {/page_documents}
                                    </ul>
                                    {/has_page_documents}
                                </div>
                                <?php if(file_exists(APPPATH.'controllers/admin/expert.php')):?>
                                <div id="accordion" class="property_content_position panel-expert">
                                    <?php foreach($expert_module_all as $key=>$row):?>
                                    <div class="card">
                                      <div class="card-header">
                                        <a class="card-link" data-toggle="collapse" href="#collapseOne<?php echo $key;?>">
                                            <i class="qmark">?</i>
                                            <?php echo $row->question; ?>             
                                        </a>
                                      </div>
                                      <div id="collapseOne<?php echo $key;?>" class="collapse  <?php echo ($key==0) ? 'show' : '' ;?>" data-parent="#accordion">
                                        <div class="card-body">
                                            <?php if(!empty($row->answer_user_id) && isset($all_experts[$row->answer_user_id])): ?>
                                                <a class="image_expert" href="<?php echo site_url('profile/'.$row->answer_user_id.'/'.$lang_code); ?>#content-position">
                                                    <img src="<?php echo $all_experts[$row->answer_user_id]['image_url']?>" alt="" />
                                                </a>
                                            <?php endif;?>
                                            <?php echo $row->answer; ?>       
                                        </div>
                                      </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div><!-- ./ content --> 
                    
                    <div class="column-sidebar">
                        <div class="widget widget-contact" id='form'>
                            <h2 class="contact"><?php echo lang_check('Ask');?></h2>
                            <div class="actions">
                                <form action="{page_current_url}#form" class="job-form default jborder" method="post">
                                    <div class="validation m25">
                                    {validation_errors} {form_sent_message}
                                    </div>
                                    <input type="hidden" name="form" value="contact" />
                                    <div class="form-group {form_error_firstname}">
                                        <input type="text" id="firstname" name='firstname' class="form-control" placeholder="<?php _l('FirstLast');?>" value="{form_value_firstname}">
                                    </div>
                                    <div class="form-group {form_error_email}">
                                        <input type="text" name="email" id="email" class="form-control" placeholder="<?php _l('Email');?>" value="{form_value_email}">
                                    </div>
                                    <div class="form-group {form_error_phone}">
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="<?php _l('Phone');?>" value="{form_value_phone}" >
                                    </div>
                                    <div class="form-group {form_error_question}">
                                        <textarea id="question" name="question" rows="3" class="form-control" placeholder="<?php _l('Question');?>">{form_value_question}</textarea>
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
                                    <div class="form-group m0">
                                        <button type="submit" class="btn btn-custom btn-custom-secondary m0"><?php echo lang_check('Send Message');?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div><!-- ./ sidebar --> 
                </div>
            </div>
        </main>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
    </body>
</html>