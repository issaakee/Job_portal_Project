<?php
$css_class_login_box_s ='show';
$css_class_registr_box_s ='';
if($this->session->flashdata('error_registration') != '' || $is_registration) {
    $css_class_login_box_s ='';
    $css_class_registr_box_s ='show';
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php _widget('head');?>
        <style>
            #codeigniter_profiler {
                display: none;
            }
        </style>
    </head>
    <body class="<?php _widget('custom_paletteclass'); ?>">
        <header>
            <?php _widget('header_mainmenu'); ?>
        </header><!-- ./ header --> 
        <main class="page-sign container container-palette pt-95">
            <div class="container">
                <div class="page_box_animate sign-form <?php _che($css_class_login_box_s);?>" id="login">
                    <div class="header">
                        <h1 class="title"><?php echo lang_check('Sign In with Jobworld');?></h1>
                    </div>
                    <?php echo form_open(NULL, array('class' => 'job-sign-from'))?>
                        <div class="validation m25">
                            <?php if(config_item('app_type') == 'demo'):?>
                                <p class="alert alert-info"><?php echo lang_check('User creditionals: user, user')?></p>
                            <?php endif;?>
                            <?php if($is_login):?>
                            <?php echo validation_errors()?>
                            <?php if($this->session->flashdata('error')):?>
                            <p class="alert alert-error"><?php echo $this->session->flashdata('error')?></p>
                            <?php endif;?>
                            <?php flashdata_message();?>
                            <?php endif;?>
                        </div>
                    <div class="form-group"><input type="text" name="username" placeholder="<?php echo lang_check('Email/Login');?>" class="form-control" /></div>
                    <div class="form-group"><input name="password" type="password" placeholder="<?php echo lang_check('Password');?>" class="form-control" /></div>
                        <div class="form-group">
                            <div class="flex-group">
                                <div class="left"><label class="checkbox-inline"><input type="checkbox" name="remember" id="remember" value="true"  class="" /><?php echo lang_check('Keep me logged in');?></label></div>
                                <div class="right">
                                    <a href="<?php echo site_url('admin/user/forgetpassword'); ?>" class="sign-from-link"><?php echo lang_check('Forgot password?')?></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><button type='submit' class="btn btn-custom btn-custom-secondary"><?php echo lang_check('Sign In');?></button></div>
                    </form>
                    <div class="separate"><span><?php echo lang_check('or');?></span></div>
                    <?php if(config_item('appId') != '' && !empty($login_url_facebook)): ?>
                    <a href="<?php echo $login_url_facebook; ?>" class="btn btn-custom btn-facebook"><?php echo lang_check('Continue With Facebook');?></a> 
                    <?php endif;?>
                    <div class="footer">
                        <span><?php echo lang_check("Don't have a account?");?></span><br/>
                        <a href="{front_login_url}#register" data-target='#register' class="sign-from-link"><?php echo lang_check("Sign Up");?></a>
                    </div>
                </div>
                <div class="page_box_animate sign-form <?php _che($css_class_registr_box_s);?>" id="register">
                    <div class="header">
                        <h1 class="title"><?php echo lang_check('Millions of jobs. Find yours');?></h1>
                        <div class="footer"><?php echo lang_check('Already have a Monster account?');?> <a  href="{front_login_url}#register" data-target='#login'><?php echo lang_check('Sign in');?></a></div>
                    </div>
                    <?php echo form_open(NULL, array('class' => 'job-sign-from'))?>
                        <div class="validation m25">
                            <?php if($this->session->flashdata('error_registration') != ''):?>
                            <p class="alert alert-success"><?php echo $this->session->flashdata('error_registration')?></p>
                            <?php endif;?>
                            <?php if($is_registration):?>
                            <?php echo validation_errors()?>
                            <?php endif;?>
                        </div>
                            <?php if(config_db_item('dropdown_register_enabled') === TRUE): ?>
                            <div class="form-group">
                              <div class="controls">
                                <?php 
                                $values = array('USER' => lang_check('USER'), 'AGENT' => lang_check('AGENT'));
                                echo form_dropdown('type', $values, set_value('type', ''), 'class="form-control" id="input_type"')?>
                              </div>
                            </div>
                        <?php endif; ?>
                        <?php if(config_db_item('register_reduced') == FALSE): ?>
                        <div class="form-group">
                            <div class="controls">
                                <?php echo form_input('name_surname', set_value('name_surname', ''), 'class="form-control" id="inputNameSurname" placeholder="' . lang('FirstLast') . '"') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <?php echo form_input('username', set_value('username', ''), 'class="form-control" id="inputUsername2" placeholder="' . lang('Username') . '"') ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <div class="controls">
                                <?php echo form_input('mail', set_value('mail', ''), 'class="form-control" id="inputMail" placeholder="' . lang('Email') . '"') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls">
                                <?php echo form_password('password', set_value('password', ''), 'class="form-control" id="inputPassword2" placeholder="'.lang('Password').'" autocomplete="new-password"')?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls">
                                <?php echo form_password('password_confirm', set_value('password_confirm', ''), 'class="form-control" id="inputPasswordConfirm" placeholder="'.lang('Confirmpassword').'" autocomplete="new-password"')?>
                            </div>
                        </div>
                        <?php if(config_db_item('register_reduced') == FALSE): ?>
                        <div class="form-group">
                            <div class="controls">
                                <?php echo form_textarea('address', set_value('address', ''), 'placeholder="'.lang('Address').'" id="inputAddress" rows="3" class="form-control"')?>
                            </div>
                        </div>          

                        <div class="form-group">
                            <div class="controls">
                                <?php echo form_input('phone', set_value('phone', ''), 'class="form-control" id="inputPhone" placeholder="'.lang('Phone').'"')?>
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
                            <div class="control-group text-left">
                              <label class="control-label"> <?php echo lang_check('Accept tems');?></label>
                              <div class="controls">
                                  <input type="checkbox" value="1" name="terms_user" class="terms_user" required="required"> <a target="_blank" href="<?php echo $terms_url; ?>" style="line-height: 24px;vertical-align: top;display: inline-block;"><?php echo lang_check('I accept the Terms and Conditions'); ?></a>
                              </div>
                            </div>
                            <?php endif;?>
                            <?php if(config_db_item('privacy_link') !== FALSE): ?>
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
                            <div class="control-group text-left">
                              <label class="control-label"><?php echo lang_check('Accept privacy');?></label>
                              <div class="controls">
                                <input type="checkbox" value="1" name="privacy_user" class="privacy_user" required="required"> <a target="_blank" href="<?php echo $privacy_url; ?>" style="line-height: 24px;vertical-align: top;display: inline-block;"><?php echo lang_check('I accept the Privacy'); ?></a>
                              </div>
                            </div>
                            <?php endif;?>
                        <?php if(config_item('captcha_disabled') === FALSE): ?>
                        <div class="form-group {form_error_captcha}">
                            <div class="row">
                                <div class="col-lg-6 text-left">
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
                        
                        <div class="form-group-label"><?php echo lang_check('By continuing you agree to our Privacy Policy Terms of Use and use of cookies.');?></div>
                        <div class="form-group"><button type='submit' class="btn btn-custom btn-custom-secondary"><?php echo lang_check('Register');?></button></div>
                    </form>
                </div>

            </div>
        </main>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
    </body>
</html>