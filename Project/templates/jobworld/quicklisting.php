<?php

$CI = &get_instance();
$CI->config->set_item('auto_category_display', TRUE);
$CI->config->set_item('auto_category_display_fields', TRUE);

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <?php _widget('head');?>
        <script src='assets/js/gmap3/gmap3.min.js'></script>
    </head>
    <body class="<?php _widget('custom_paletteclass'); ?>">
        <header>
             <?php _widget('custom_header_menu-for-loginuser');?>
            <?php _widget('header_mainmenu'); ?>
        </header><!-- ./ header --> 
        <?php _widget('top_pagetitle'); ?>
        <div class="section section-articles section-results-articles container container-palette">
            <div class="container"  id='main'>
                <div class="row">
                    
                <div class="widget widget-submit"  id="content">
                    <div class="widget-header header-styles">
                        <h2 class="title"><?php echo lang_check('Listing'); ?></h2>
                    </div> <!-- ./ title --> 
                    <div class="validation m25">
                        <?php echo validation_errors()?>
                        <?php if($this->session->flashdata('message')):?>
                        <?php echo $this->session->flashdata('message')?>
                        <?php endif;?>
                        <?php if($this->session->flashdata('error')):?>
                        <p class="alert alert-error"><?php echo $this->session->flashdata('error')?></p>
                        <?php endif;?>
                    </div>
                     <?php echo form_open(NULL, array('class' => 'job-form default jborder', 'role'=>'form','id'=>'property-submition'))?>                              
        
        <?php if($this->user_m->loggedin()): ?>

            <div class="form-group">
              <label class="control-label"><?php _l('Your login')?></label>
              <div class="controls">
                <?php echo form_input('login', $this->session->userdata('username'), 'class="form-control" id="input_login" readonly placeholder="'.lang_check('Your login').'"')?>
              </div>
            </div>

        <?php endif; ?>
        
        <?php if(!$this->user_m->loggedin()): ?>

            <div class="form-group">
              <label class="control-label">*<?php _l('Your email')?></label>
              <div class="controls">
                <?php echo form_input('mail', set_value('mail', ''), 'class="form-control" id="input_mail" placeholder="'.lang_check('Your email').'"')?>
              </div>
            </div>

        <?php endif; ?>
        

            
            <div class="form-group hidden">
              <label class="control-label"><?php _l('Repository')?></label>
              <div class="controls">
                <?php echo form_input('repository_id', set_value('repository_id', $repository_id), 'class="form-control" id="repository_id" placeholder="'.lang_check('Repository').'"  readonly')?>
              </div>
            </div>

            <div style="margin-bottom: 0px;" class="tabbable">

              
              <div style="padding-top: 9px;" class="tab-content">
                  
                <?php $i=0;foreach($this->option_m->languages as $key=>$val):$i++;
                
                    if(config_db_item('multilang_on_qs') == 0 && $this->language_m->get_default() != $this->language_m->get_code($key))
                        continue;
                ?>
                <div id="lang_id_<?php echo $key ?>" role="tabpanel" class="tab-pane fade <?php echo $i == 1 ? 'in active show' : '' ?>">
                
                <?php foreach($options as $key_option=>$val_option):?>
                
                <?php
                
                if(isset(${'parent_field_is_hidden'.$val_option['parent_id']}) && ${'parent_field_is_hidden'.$val_option['parent_id']} == TRUE) {
                    $val_option['is_quickvisible'] = 0;
                }

                if($val_option['type'] == 'CATEGORY') {
                    if(!$val_option['is_quickvisible'])
                        ${'parent_field_is_hidden'.$val_option['id']} = TRUE;
                }
                
                //if($val_option['type'] != 'TREE')
                if(empty($val_option['is_required']) && empty($val_option['is_quickvisible']))
                    continue;
                
                $required_text = '';
                $required_notice = '';
                if($val_option['is_required'] == 1 && $val_option['is_quickvisible'] != 0)
                {
                    $required_text = 'required';
                    $required_notice = '*';
                }
                
                $max_length_text = '';
                if($val_option['max_length'] > 0)
                {
                    $max_length_text = 'maxlength="'.$val_option['max_length'].'"';
                }

                $is_not_translatable = false;

                if($key != $this->language_m->get_default_id() && isset($val_option['is_not_translatable']) && $val_option['is_not_translatable']==1) {
                    $is_not_translatable = true;
                }

                ?>
                
                                        <?php if($val_option['type'] == 'CATEGORY'):?>
                                        
                                        <h5 class="<?php echo ($val_option['is_frontend'] ? '' : ' hidden') ?>"><hr /><?php echo $val_option['option']?> <span class="checkbox-visible"><?php echo form_checkbox('option'.$val_option['id'].'_'.$key, 'true', set_value('option'.$val_option['id'].'_'.$key, isset($estate['option'.$val_option['id'].'_'.$key])?$estate['option'.$val_option['id'].'_'.$key]:''), 'id="inputOption_'.$key.'_'.$val_option['id'].'"')?> <?php echo lang_check('Hidden on preview page'); ?></span><hr /></h5>
    

                                        
                                            </div>
                                        <?php elseif($val_option['type'] == 'DROPDOWN_MULTIPLE' && config_item('field_dropdown_multiple_enabled') === TRUE):?>
                                            <div class="form-group<?php echo ($val_option['is_frontend']?'':' hidden') ?>">
                                              <label class="control-label"><?php echo $required_notice.$val_option['option']?>
                                                    <?php if(!empty($val_option['hint'])):?>
                                                    <div class="tooltip_tree">
                                                        <span class="hintlabel"><i class="icon-question-sign hint" aria-hidden="true"></i></span>
                                                        <span class="tooltiptext">
                                                            <?php echo $val_option['hint'];?>
                                                        </span>
                                                    </div>
                                                    <?php endif;?>
                                              </label>
                                                <?php if($is_not_translatable):?>
                                                <div class="controls">
                                                    <div class="alert alert-warning non-translatable" role="alert"><?php echo lang_Check('Not translatable');?></div>
                                                 </div>
                                                <?php else:?>
                                              <div class="controls">
                                                <?php
                                                if(isset($options_lang[$key][$key_option]))
                                                {
                                                    $drop_options = array_combine(explode(',',check_combine_set(isset($options_lang[$key])?$options_lang[$key][$key_option]->values:'', $val_option['values'], '')),explode(',',check_combine_set($val_option['values'], isset($options_lang[$key])?$options_lang[$key][$key_option]->values:'', '')));
                                                }
                                                else
                                                {
                                                    $drop_options = array();
                                                }
                                                
                                                // If you don't want translation to website langauge uncomment this 1 line below:
                                                // $drop_options = array_combine(explode(',', $options_lang[$key][$key_option]->values), explode(',', $options_lang[$key][$key_option]->values));
                                                
                                                $drop_selected = set_value('option'.$val_option['id'].'_'.$key, isset($estate['option'.$val_option['id'].'_'.$key])?$estate['option'.$val_option['id'].'_'.$key]:'');

                                                echo form_dropdown('option'.$val_option['id'].'_'.$key, $drop_options, $drop_selected, 'class="form-control" id="inputOption_'.$key.'_'.$val_option['id'].'" placeholder="'.$val_option['option'].'" '.$required_text)
                                                
                                                ?>
                                              </div>
                                                <?php endif;?>
                                            </div>
                                        <?php elseif($val_option['type'] == 'TEXTAREA'):?>
                                            <div class="form-group<?php echo ($val_option['is_frontend']?'':' hidden') ?>">
                                              <label class="control-label"><?php echo $required_notice.$val_option['option']?>
                                                    <?php if(!empty($val_option['hint'])):?>
                                                    <div class="tooltip_tree">
                                                        <span class="hintlabel"><i class="icon-question-sign hint" aria-hidden="true"></i></span>
                                                        <span class="tooltiptext">
                                                            <?php echo $val_option['hint'];?>
                                                        </span>
                                                    </div>
                                                    <?php endif;?>
                                              </label>
                                                <?php if($is_not_translatable):?>
                                                <div class="controls">
                                                    <div class="alert alert-warning non-translatable" role="alert"><?php echo lang_Check('Not translatable');?></div>
                                                 </div>
                                                <?php else:?>
                                              <div class="controls">
                                                <?php 
                                                $cur_value = isset($estate['option'.$val_option['id'].'_'.$key])?$estate['option'.$val_option['id'].'_'.$key]:'';
                                                
                                                echo form_textarea('option'.$val_option['id'].'_'.$key, set_value('option'.$val_option['id'].'_'.$key, $cur_value), 'class="ckeditor form-control" id="inputOption_'.$key.'_'.$val_option['id'].'" strlen="'.strlen($cur_value).'" placeholder="'.$val_option['option'].'" '.$required_text)?>
                                              </div>
                                                <?php endif;?>
                                            </div>
                                        <?php elseif($val_option['type'] == 'TREE' && config_item('tree_field_enabled') === TRUE):?>

                                        <?php elseif($val_option['type'] == 'CHECKBOX'):?>
                                                <?php if($is_not_translatable):?>
                                            <div class="form-group<?php echo ($val_option['is_frontend']?'':' hidden') ?>">
                                                <label class="control-label"><?php echo $required_notice.$val_option['option']?>
                                                      <?php if(!empty($val_option['hint'])):?>
                                                      <div class="tooltip_tree">
                                                          <span class="hintlabel"><i class="icon-question-sign hint" aria-hidden="true"></i></span>
                                                          <span class="tooltiptext">
                                                              <?php echo $val_option['hint'];?>
                                                          </span>
                                                      </div>
                                                      <?php endif;?>
                                                </label>
                                                <div class="controls">
                                                  <div class="alert alert-warning non-translatable" role="alert"><?php echo lang_Check('Not translatable');?></div>
                                                 </div>
                                            </div>
                                            <?php else:?>
                                           <div class="form-group<?php echo ($val_option['is_frontend']?'':' hidden') ?> m0">
                                                <label class="checkbox">
                                                        <?php echo form_checkbox('option'.$val_option['id'].'_'.$key, 'true', set_value('option'.$val_option['id'].'_'.$key, isset($estate['option'.$val_option['id'].'_'.$key])?$estate['option'.$val_option['id'].'_'.$key]:''), 'id="inputOption_'.$key.'_'.$val_option['id'].'" class="valid_parent" '.$required_text)?>
                                                    <?php
                                                        if(file_exists(FCPATH.'templates/'.$settings_template.'/assets/img/icons/option_id/'.$val_option['id'].'.png'))
                                                        {
                                                            echo '<img class="results-icon" src="assets/img/icons/option_id/'.$val_option['id'].'.png" alt="'.$val_option['option'].'"/>';
                                                        }
                                                    ?>
                                                    <?php echo $required_notice.$val_option['option']?>
                                                    <?php if(!empty($val_option['hint'])):?>
                                                    <div class="tooltip_tree">
                                                        <span class="hintlabel"><i class="icon-question-sign hint" aria-hidden="true"></i></span>
                                                        <span class="tooltiptext">
                                                            <?php echo $val_option['hint'];?>
                                                        </span>
                                                    </div>
                                                    <?php endif;?>
                                                </label>
                                            </div>
                                            <?php endif;?>
                                            <?php elseif($val_option['type'] == 'DATETIME' && config_item('field_datetime_enabled')=== TRUE):?>
                                                <div class="form-group<?php echo ($val_option['is_frontend']?'':' hidden') ?>">
                                                    <label class="control-label"><?php echo $required_notice.$val_option['option']?> 
                                                        <?php if(!empty($val_option['hint'])):?>
                                                        <div class="tooltip_tree">
                                                            <span class="hintlabel"><i class="icon-question-sign hint" aria-hidden="true"></i></span>
                                                            <span class="tooltiptext">
                                                                <?php echo $val_option['hint'];?>
                                                            </span>
                                                        </div>
                                                        <?php endif;?>
                                                    </label>
                                                <?php if($is_not_translatable):?>
                                                <div class="controls">
                                                    <div class="alert alert-warning non-translatable" role="alert"><?php echo lang_Check('Not translatable');?></div>
                                                 </div>
                                                <?php else:?>
                                                  <div class="controls">
                                                    <div class="input-append" id="datetimepicker_field_<?php _che($key);?>_<?php _che($val_option['id']);?>">
                                                        <?php echo form_input('option'.$val_option['id'].'_'.$key, set_value('option'.$val_option['id'].'_'.$key, isset($estate['option'.$val_option['id'].'_'.$key])?$estate['option'.$val_option['id'].'_'.$key]:''), 'class="picker '.$val_option['type'].'" id="inputOption_'.$key.'_'.$val_option['id'].'"  data-format="yyyy-MM-dd" placeholder="'.$val_option['option'].'" '.$required_text.' '.$max_length_text)?>
                                                        <span class="add-on">
                                                          &nbsp;<i data-date-icon="icon-calendar" data-time-icon="icon-time" class="icon-calendar">
                                                          </i>
                                                        </span>
                                                    </div> 
                                                  </div>
                                                    <?php endif;?>
                                                </div>

                                                <script>
                                                  $(function() {
                                                        $('#inputOption_<?php _che($key);?>_<?php _che($val_option['id']);?>').datepicker({
                                                          pickTime: false
                                                        });
                                                        
                                                        $('#datetimepicker_field_<?php _che($key);?>_<?php _che($val_option['id']);?> span').click(function(){
                                                            $('#inputOption_<?php _che($key);?>_<?php _che($val_option['id']);?>').trigger( "focus" );
                                                        });
                                                    });
                                                </script>
                                            <?php endif;?>



                                            <?php endforeach; ?>
                                            </div>
                                            <?php endforeach; ?>
                                          </div>

                                                <?php if(config_db_item('terms_link') !== FALSE): ?>
                                                <div class="form-group">
                                                  <div class="controls">
                                                    <?php echo form_checkbox('option_agree_terms', 'true', set_value('option_agree_terms', false), 'class="novalidate" required="required" id="inputOption_terms"')?>
                                                  <a target="_blank" href="<?php echo config_db_item('terms_link'); ?>"><?php echo lang_check('I Agree To The Terms & Conditions'); ?></a>
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
                            <div class="form-group">
                            <div class="controls">
                                <?php echo form_checkbox('option_privacy_link', 'true', set_value('option_privacy_link', false), 'class="novalidate" required="required" id="inputOption_privacy_link"')?>
                                <a target="_blank" href="<?php echo $privacy_url; ?>"><?php echo lang_check('I Agree The Privacy'); ?></a>
                            </div>
                        </div>
                                <?php endif; ?>
                                            <?php if(sw_count($not_logged)>0): ?>
                                                <?php if(config_item('captcha_disabled') === FALSE): ?>
                                                <div class="form-group" >
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <?php echo $captcha[ 'image']; ?>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input class="captcha" name="captcha" type="text" placeholder="<?php _l('Captcha');?>" value="" />
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
                                            <?php endif; ?>
                                                <hr>
                                                <div class="form-group">
                                                  <div class="controls">
                                                    <?php echo form_submit('', lang('Save'), 'class="btn btn-success ajax-indicator"')?>
                                                  </div>
                                                </div>

                                        </div>

                                    </form>
                </div> <!-- ./ widget-submit --> 

            </div>
        </div><!-- ./ section recent articles --> 
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
                 <script src="assets/libraries/ckeditor_4.6.2_standard/ckeditor/ckeditor.js"></script>
        <script>
        /* [START] Dependent fields */
        $(document).ready(function(){
        //console.log('Dependent fields loading');
        <?php 
        // Fetch dependent fields
        $CI =& get_instance();
        $CI->load->model('dependentfield_m');
        $dependent_fields = $CI->dependentfield_m->get();
        $dependent_fields_prepare = array();
        foreach($dependent_fields as $key_d_field=>$d_field)
        {
            $dependent_fields_prepare[$d_field->field_id][$d_field->selected_index] = $d_field->hidden_fields_list;
        }
        
        foreach($CI->language_m->db_languages_code as $key_lang=>$id_lang):
        foreach($dependent_fields_prepare as $d_field_id=>$d_field_indexes):
        ?>
        //console.log('fields: <?php echo $d_field_id; ?>');
        $("select[name='option<?php echo $d_field_id.'_'.$id_lang; ?>'], input[rel][name='option<?php echo $d_field_id.'_'.$id_lang; ?>']").change(function () {

            var index = $(this).children('option:selected').index();
            var parent_elem = $(this).parent().parent().parent();
            var parent_elem_hide = $(this).parent().parent();
            
            var index_tree = $(this).attr('rel');
            if (typeof index_tree !== typeof undefined && index_tree !== false) {
              index = index_tree;
              parent_elem = parent_elem.parent();
              parent_elem_hide = parent_elem_hide.parent();
            }

            // show all below
            <?php if(config_item('auto_category_display_fields') !== FALSE):?>
            parent_elem_hide.prevAll().removeClass('hide')
            <?php endif;?>
            
            parent_elem_hide.nextAll().removeClass('hide');
            $(this).closest('.tab-pane').find('textarea, select, input').each(function(){
                if($(this).attr('data-required') == 'true') {
                    $(this).attr('required', 'required')
                }
            })
            

            <?php if(config_item('auto_category_display_fields') !== FALSE):?>
                
            <?php $all_generate_selector='';?>
            <?php foreach($d_field_indexes as $d_selected_index=>$d_hidden_fields_list): ?>
                <?php 
                $hidden_fields_list = explode(',', $d_hidden_fields_list);
                $generate_selector_list = array();
                $generate_selector = '';
                foreach($hidden_fields_list as $hide_field_id)
                {
                    $generate_selector_list[] = "[name='option".$hide_field_id.'_'.$id_lang."']";
                }
                $generate_selector = implode(',', $generate_selector_list);
                $all_generate_selector.=$generate_selector;
                ?>
            <?php endforeach; ?>    
                
                
            if($(this).val() == '' && index == '') {
                var el = $(this).closest('.form-group');

                $("<?php echo $all_generate_selector;?>").closest('.form-group').addClass('hide')

                return;
            }
            <?php endif;?>
            
            if (typeof index_tree !== typeof undefined && index_tree !== false) {
              // include all parent elements
              $(this).parent().parent().find('select').each(function(){
                if($(this).val() != '')
                {
                    hide_related_<?php echo $d_field_id.'_'.$id_lang; ?>(parent_elem, parent_elem_hide, $(this).val());
                }
              });
            }
            else
            {
                hide_related_<?php echo $d_field_id.'_'.$id_lang; ?>(parent_elem, parent_elem_hide, index);
            }
            
            
            //console.log(index);
            
        });
        
        $("select[name='option<?php echo $d_field_id.'_'.$id_lang; ?>']").trigger('change');
        
        <?php if(config_item('auto_category_display_fields') !== FALSE):?>
            $("input[rel][name='option<?php echo $d_field_id.'_'.$id_lang; ?>']").trigger('change');
        <?php endif;?>
        <?php $all_generate_selector='';?>
        function hide_related_<?php echo $d_field_id.'_'.$id_lang; ?>(parent_elem, parent_elem_hide, index)
        {
            <?php foreach($d_field_indexes as $d_selected_index=>$d_hidden_fields_list): ?>
            if(index == '<?php echo $d_selected_index; ?>')
            {
                // console.log('Hide now it all ;-)');
                <?php 
                $hidden_fields_list = explode(',', $d_hidden_fields_list);
                $generate_selector_list = array();
                $generate_selector = '';
                foreach($hidden_fields_list as $hide_field_id)
                {
                    $generate_selector_list[] = "[name='option".$hide_field_id.'_'.$id_lang."']";
                }
                $generate_selector = implode(',', $generate_selector_list);
                $all_generate_selector.=$generate_selector;
                ?>
                
                // empty values
                parent_elem.find("<?php echo $generate_selector; ?>").not('.skip-input').each( function() {
                    if(this.type=='text' || this.type=='textarea'){
                        this.value = '';
                    }
                    else if(this.type=='radio' || this.type=='checkbox'){
                        this.checked=false;
                    }
                    else if(this.type=='select-one' || this.type=='select-multiple'){
                        this.value ='';
                        if(this.value != '')this.value ='-';
                    }
                });
                
                // hide all below
                //parent_elem.find("<?php echo $generate_selector; ?>").parent().parent().addClass('hide');
                
                // hide all below <hr> if found below
                parent_elem.find("<?php echo $generate_selector; ?>").parent().parent().each( function() {
                    var curr_elem = $(this);
                    if(!(curr_elem.hasClass('control-group') || curr_elem.hasClass('form-group')) &&
                       (curr_elem.parent().hasClass('control-group') || curr_elem.parent().hasClass('form-group')) )
                    {
                        curr_elem = curr_elem.parent();
                    }
                    
                    curr_elem.not('h5').addClass('hide');
                    
                    if(curr_elem.prev().is('hr'))
                    {
                        curr_elem.prev().addClass('hide t');
                    }
                    
                    if(curr_elem.next().is('hr'))
                    {
                        curr_elem.next().addClass('hide');
                    }
                });
            }
            <?php endforeach; ?>
        }
        
        
        <?php endforeach;endforeach; ?>

    });
    
    /* [END] Dependent fields */
        
    /* [START] TreeField */
    
    $(function() {
        $(".TREE-GENERATOR select").change(function(){
            var s_value = $(this).val();
            var s_name_splited = $(this).attr('name').split("_"); 
            var s_level = parseInt(s_name_splited[3]);
            var s_lang_id = s_name_splited[1];
            var s_field_id = s_name_splited[0].substr(6);
            // console.log(s_value); console.log(s_level); console.log(s_field_id);
            
            load_by_field($(this));
            
            // Reset child selection and value generator
            var generated_val = '';
            var last_selected_numeric = '';
            $(this).parent().parent()
            .find('select').each(function(index){
                // console.log($(this).attr('name'));
                if(index > s_level)
                {
                    $(this).html('<option value=""><?php echo lang_check('No values found'); ?></option>');
                    $(this).val('');
                }
                else if($(this).val() != '')
                {
                    last_selected_numeric = $(this).val();
                    generated_val+=$(this).find("option:selected").text()+" - ";
                }
                    
            });

            $("#inputOption_"+s_lang_id+"_"+s_field_id).attr('rel', last_selected_numeric);
            $("#inputOption_"+s_lang_id+"_"+s_field_id).val(generated_val);
            $("#inputOption_"+s_lang_id+"_"+s_field_id).trigger("change");

        });
        
        // Autoload selects
        $(".TREE-GENERATOR input.tree-input-value").each(function(index_1){
            var s_values_splited = ($(this).val()+" ").split(" - "); 
//            $.each(s_values_splited, function( index, value ) {
//                alert( index + ": " + value );
//            });
            if(s_values_splited[0] != '')
            {
                var first_select = $(this).parent().parent().find('select:first');
                var find_selected = first_select.find('option').filter(function () { return $(this).html() == s_values_splited[0]; });
                find_selected.attr('selected', 'selected');
                
                var index_tree = find_selected.val();
                if (typeof index_tree !== typeof undefined && index_tree !== false)
                {
                    if($(this).attr('rel') != index_tree)
                    {
                        $(this).attr('rel', index_tree);
                        $(this).trigger("change");
                    }
                }

                load_by_field(first_select, true, s_values_splited);
            }
            
            //console.log('value: '+s_values_splited[0]);
        });

    });
    
    function load_by_field(field_element, autoselect_next, s_values_splited)
    {
        if (typeof autoselect_next === 'undefined') autoselect_next = false;
        if (typeof s_values_splited === 'undefined') s_values_splited = [];

        var s_value = field_element.val();
        var s_name_splited = field_element.attr('name').split("_"); 
        var s_level = parseInt(s_name_splited[3]);
        var s_lang_id = s_name_splited[1];
        var s_field_id = s_name_splited[0].substr(6);
        // console.log(s_value); console.log(s_level); console.log(s_field_id);
        
        // Load values for next select
        var ajax_indicator = field_element.parent().parent().parent().find('.ajax_loading');
        var select_element = $("select[name=option"+s_field_id+"_"+s_lang_id+"_level_"+parseInt(s_level+1)+"]");
        if(select_element.length > 0 && s_value != '')
        {
            ajax_indicator.css('display', 'block');
            $.getJSON( "<?php echo site_url('api/get_level_values_select'); ?>/"+s_lang_id+"/"+s_field_id+"/"+s_value+"/"+parseInt(s_level+1), function( data ) {
                //console.log(data.generate_select);
                //console.log("select[name=option"+s_field_id+"_"+s_lang_id+"_level_"+parseInt(s_level+1)+"]");
                ajax_indicator.css('display', 'none');
                
                select_element.html(data.generate_select);
                
                if(autoselect_next)
                {
                    if(s_values_splited[s_level+1] != '')
                    {
                        var find_selected = select_element.find('option').filter(function () { return $(this).html() == s_values_splited[s_level+1]; });
                        
                        find_selected.attr('selected', 'selected');
                        var index_tree = find_selected.val();
                        if (typeof index_tree !== typeof undefined && index_tree !== false)
                        {
                            var input_element = field_element.parent().parent().find("input.tree-input-value");

                            if(input_element.attr('rel') != index_tree)
                            {
                                input_element.attr('rel', index_tree);
                                $(input_element).trigger("change");
                            }
                        }
                        
                        load_by_field(select_element, true, s_values_splited);
                    }
                }
            }).success(function(data){
                <?php if(config_item('auto_category_display')=== TRUE):?>
                //console.log(Object.keys(data.values_arr).length);
                // For old browser
                var count = 0;
                var i;
                for (i in data.values_arr) {
                    if (data.values_arr.hasOwnProperty(i)) {
                        count++;
                    }
                }
                //count = object.keys(data.values_arr).length;
                if(field_element.val() !='' &&  count > 1) {
                    field_element.closest('.field-row').next().show();
                } else {
                    field_element.closest('.field-row').nextAll().hide();
                }
                <?php endif;?>
            });
        } else {
            <?php if(config_item('auto_category_display')=== TRUE):?>
            field_element.closest('.field-row').nextAll().hide();
            <?php endif;?>
        }
    }
    
    function load_and_select_index(field_element, field_select_id, field_parent_select_id)
    {
        var s_name_splited = field_element.attr('name').split("_"); 
        var s_level = parseInt(s_name_splited[3]);
        var s_lang_id = s_name_splited[1];
        var s_field_id = s_name_splited[0].substr(6);
        
        // Load values for current select
        var ajax_indicator = field_element.parent().parent().parent().find('.ajax_loading');
        if(s_level == 0)$("#inputOption_"+s_lang_id+"_"+s_field_id).attr('value', '');

        ajax_indicator.css('display', 'block');
        $.getJSON( "<?php echo site_url('api/get_level_values_select'); ?>/"+s_lang_id+"/"+s_field_id+"/"+field_parent_select_id+"/"+parseInt(s_level), function( data ) {
            ajax_indicator.css('display', 'none');
            
            field_element.html(data.generate_select);
            //console.log(field_select_id);
            if(isNumber(field_select_id))
                field_element.val(field_select_id);
            else
                field_element.val('');
            
            var generated_val = '';
            var last_selected_val = '';
            
            field_element.parent().parent()
            .find('select').each(function(index){
                if($(this).val() != '' && $(this).val() != null)
                {
                    last_selected_val = $(this).val();
                    generated_val+=$(this).find("option:selected").text()+" - ";
                }
            });

            if(generated_val.length > $("#inputOption_"+s_lang_id+"_"+s_field_id).val().length)
            {
                
                //alert(generated_val);
                //console.log(generated_val);
                $("#inputOption_"+s_lang_id+"_"+s_field_id).attr('rel', last_selected_val);
                $("#inputOption_"+s_lang_id+"_"+s_field_id).val(generated_val);
                $("#inputOption_"+s_lang_id+"_"+s_field_id).trigger('change');
            }

        });

    }
    
    function isNumber(n) {
      return !isNaN(parseFloat(n)) && isFinite(n);
    }
    
    /* [END] TreeField */
</script>   
    
    
<script >
    // init copy features
$(document).ready(function(){
    
    $('#copy-lang').click(function(){
        $('.tabbable .tab-pane.active select, '+
          '.tabbable .tab-pane.active input[type=checkbox], '+
          '.tabbable .tab-pane.active input[type=text], '+
          '.tabbable .tab-pane.active textarea').each(function(){
            
            if($(this).attr('id') == null)return;
            
            var option_id = $(this).attr('id').substr($(this).attr('id').lastIndexOf('_')+1);
            var lang_active_id = $(this).attr('name').substr($(this).attr('name').lastIndexOf('_')+1);
            var option_val = $(this).val();
            var is_input = $(this).is('input');
            var is_input_text = $(this).is('input[type=text]');
            var is_area = $(this).is('textarea');
            var r_id = $(this).attr('id');
            var is_level = false;
            var is_tree_input = $(this).hasClass('tree-input-value');
            var is_level_splited;
            var is_level_parent_id;
            var is_HTMLTABLE = $(this).hasClass('HTMLTABLE');
            var is_PEDIGREE = $(this).hasClass('PEDIGREE');
            var curr_level = 0;
            
            if($(this).hasClass('skip-input'))
                return;

            if(!$(this).attr('id'))return;
            
            //if(is_tree_input)
            //    console.log('test: '+r_id);
            
            if(r_id.indexOf("level") > 0)
            {
                is_level_splited = r_id.split("_"); 
                is_level = true;
                option_id = is_level_splited[2];
            }
            
            if(is_input)
            {
                if($(this).attr('type') == 'checkbox')
                {
                    option_val = $(this).is(':checked');
                }
                else
                {
                    
                }
            }
            else if(is_HTMLTABLE)
            {
                option_val = $(this).parent().find('table > tbody').clone();
            }
            else if(is_PEDIGREE)
            {
                option_val = $(this).parent().find('ul.tree');
            }
            else if(is_area)
            {
                option_val = $(this).val();
                if(typeof CKEDITOR !== 'undefined' && typeof CKEDITOR.instances[r_id] !== 'undefined') {
                    option_val = CKEDITOR.instances[r_id].getData();
                }
            }
            else if(is_level)
            {
                curr_level = parseInt(is_level_splited[4]);
                is_level_parent_id = 0;
                if(curr_level > 0)
                {
                    is_level_parent_id = $('.controls #inputOption_'+is_level_splited[1]+'_'+option_id+'_level_'+parseInt(curr_level-1)).val();
                }

                option_val = $(this).val();
            }
            else
            {
                option_val = $(this).prop('selectedIndex');
            }
            
//            console.log('option_id: '+option_id);
//            console.log('lang_active_id: '+lang_active_id);
//            console.log('option_val: '+option_val);
//            console.log('is_input: '+is_input);
            
            $('.nav.nav-tabs li.lang a').each(function(){
                if(!$(this).parent().hasClass('active'))
                {
                    var lang_key =  $(this).attr('href').substr($(this).attr('href').lastIndexOf('_')+1);
                    
//                    console.log('lang_key: '+lang_key);
//                    console.log('#inputOption_'+lang_key+'_'+option_id);
                    
                    if(is_input)
                    {
                        if(is_tree_input)
                        {
                            $('#inputOption_'+lang_key+'_'+option_id).parent().parent().find('select').val('');
                            $('#inputOption_'+lang_key+'_'+option_id).val('');
                            
//                            console.log('#inputOption_'+lang_key+'_'+option_id);
//                            console.log($('#inputOption_'+lang_key+'_'+option_id).val());
                        }
                        else if(is_input_text)
                        {
                            if($('#inputOption_'+lang_key+'_'+option_id).val() == '' ||
                               $.isNumeric(option_val))
                                $('#inputOption_'+lang_key+'_'+option_id).val(option_val);
                        }
                        else
                        {
                            $('#inputOption_'+lang_key+'_'+option_id).prop('checked', option_val);
                        }
                    }
                    else if(is_PEDIGREE)
                    {
                        //$('#inputOption_'+lang_key+'_'+option_id).parent().find('ul.tree').html(option_val.html());
                    }
                    else if(is_HTMLTABLE)
                    {
                        // replace based on dropdown translation
                        // console.log('lang_from_id: '+lang_active_id);
                        // console.log('lang_to_id: '+lang_key);
                        // console.log(option_id);
                        
                        //col_1_76_0
                        var option_val_clone = option_val.clone();
                        option_val_clone.find('tr td').each(function( index ) {
                            var col_index = $(this).index();
                            var row_index = $(this).parent().index();
                            var cur_content = $(this).html();
                            var lang_col_from = $('#col_'+lang_active_id+'_'+option_id+'_'+col_index);
                            var lang_col_to = $('#col_'+lang_key+'_'+option_id+'_'+col_index);
                            
                            if(lang_col_to.length == 1 && cur_content != '')
                            {
                                var dropdown_index = lang_col_from.find("span:contains('"+cur_content+"')").index();
                                var rep_text = lang_col_to.find('span').eq(dropdown_index).html();
                                option_val_clone.find('tr').eq(row_index).find('td').eq(col_index).html(rep_text);
                                
                                //console.log(dropdown_index + '|' + $( this ).html() );
                                //console.log(rep_text);
                            }
                        });
                        
                        $('#inputOption_'+lang_key+'_'+option_id).parent().find('table > tbody').html(option_val_clone.html());
                        
                        table_add_events(option_id+'_'+lang_key);
                        save_changes_table(option_id+'_'+lang_key);
                    }
                    else if(is_area)
                    {
                        var option_val_lang = $('#inputOption_'+lang_key+'_'+option_id).val();

                        if(typeof CKEDITOR !== 'undefined' && typeof CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id] !== 'undefined') {
                            option_val_lang = CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id].getData();
                        }
                        
                        if(option_val_lang == '' ||
                           option_val_lang == '<br>' )
                        {
                            $('#inputOption_'+lang_key+'_'+option_id).val(option_val).blur();
                            if(typeof CKEDITOR !== 'undefined' && typeof CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id] !== 'undefined') {
                                CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id].setData(option_val);
                            }
                        }
                    }
                    else if(is_level)
                    {
                        if (typeof load_and_select_index === 'function') {
                            load_and_select_index($('#inputOption_'+lang_key+'_'+option_id+'_level_'+is_level_splited[4]), option_val, is_level_parent_id);
                        }
                    }
                    else
                    {
                        //console.log('#inputOption_'+lang_key+'_'+option_id);
                        //console.log(option_val);
                        $('#inputOption_'+lang_key+'_'+option_id).prop('selectedIndex', parseInt(option_val)); 
                        $('#inputOption_'+lang_key+'_'+option_id).trigger('change');
                    }
                }
            });
        });
        
        return false;
    });
    
    $('#translate-lang').click(function(){
        $('.tabbable .tab-pane.active select, '+
          '.tabbable .tab-pane.active input[type=checkbox], '+
          '.tabbable .tab-pane.active input[type=text], '+
          '.tabbable .tab-pane.active textarea').each(function(){

            if($(this).attr('id') == null)return;
            
            var option_id = $(this).attr('id').substr($(this).attr('id').lastIndexOf('_')+1);
            var lang_active_id = $(this).attr('name').substr($(this).attr('name').lastIndexOf('_')+1);
            var option_val = $(this).val();
            var is_input = $(this).is('input');
            var is_input_text = $(this).is('input[type=text]');
            var is_area = $(this).is('textarea');
            var r_id = $(this).attr('id');
            var is_level = false;
            var is_tree_input = $(this).hasClass('tree-input-value');
            var is_level_splited;
            var is_level_parent_id;
            var is_HTMLTABLE = $(this).hasClass('HTMLTABLE');
            var is_PEDIGREE = $(this).hasClass('PEDIGREE');
            var curr_level = 0;
            
            if($(this).hasClass('skip-input'))
                return;

            if(!$(this).attr('id'))return;
            
            if(r_id.indexOf("level") > 0)
            {
                is_level_splited = r_id.split("_"); 
                is_level = true;
                option_id = is_level_splited[2];
            }
            
            if(is_input)
            {
                if($(this).attr('type') == 'checkbox')
                {
                    option_val = $(this).is(':checked');
                }
                else
                {
                    
                }
            }
            else if(is_HTMLTABLE)
            {
                option_val = $(this).parent().find('table > tbody').clone();
            }
            else if(is_PEDIGREE)
            {
                option_val = $(this).parent().find('ul.tree');
            }
            else if(is_area)
            {
                option_val = $(this).val();
                if(typeof CKEDITOR !== 'undefined' && typeof CKEDITOR.instances[r_id] !== 'undefined') {
                    option_val = CKEDITOR.instances[r_id].getData();
                }
            }
            else if(is_level)
            {
                curr_level = parseInt(is_level_splited[4]);
                is_level_parent_id = 0;
                if(curr_level > 0)
                {
                    is_level_parent_id = $('.controls #inputOption_'+is_level_splited[1]+'_'+option_id+'_level_'+parseInt(curr_level-1)).val();
                }

                option_val = $(this).val();
            }
            else
            {
                option_val = $(this).prop('selectedIndex');
            }
            
            $('.nav.nav-tabs li.lang a').each(function(){
                if(!$(this).parent().hasClass('active'))
                {
                    var lang_key =  $(this).attr('href').substr($(this).attr('href').lastIndexOf('_')+1);
                    //console.log('lang_key: '+lang_key);
                    
                    if(is_input)
                    {
                        if(is_tree_input)
                        {
                            $('#inputOption_'+lang_key+'_'+option_id).parent().parent().find('select').val('');
                            $('#inputOption_'+lang_key+'_'+option_id).val('');
                            
//                            console.log('#inputOption_'+lang_key+'_'+option_id);
//                            console.log($('#inputOption_'+lang_key+'_'+option_id).val());
                        }
                        else if(is_input_text)
                        {
                            if($.isNumeric(option_val))
                            {
                                $('#inputOption_'+lang_key+'_'+option_id).val(option_val);
                            }
                            else if($('#inputOption_'+lang_key+'_'+option_id).val() == '' && option_val != '')
                            {
                                $.getJSON($('#translate-lang').attr('rel'), {from: lang_active_id, to: lang_key, value: option_val}, function( data ) {
                                    if(data.result != '')
                                    {
                                        $('#inputOption_'+lang_key+'_'+option_id).val(data.result);
                                    }
                                    else
                                    {
                                        $('#inputOption_'+lang_key+'_'+option_id).val(option_val);
                                    }
                                });
                            }  
                        }
                        else
                        {
                            //console.log('#inputOption_'+lang_key+'_'+option_id);
                            //console.log(option_val);
                            //$('#inputOption_'+lang_key+'_'+option_id).val(option_val);
                            $('#inputOption_'+lang_key+'_'+option_id).prop('checked', option_val);
                        }
                    }
                    else if(is_PEDIGREE)
                    {
                        
                    }
                    else if(is_HTMLTABLE)
                    {
                        // replace based on dropdown translation
                        //console.log('lang_from_id: '+lang_active_id);
                        //console.log('lang_to_id: '+lang_key);
                        //col_1_76_0
                        var option_val_clone = option_val.clone();
                        option_val_clone.find('tr td').each(function( index ) {
                            var col_index = $(this).index();
                            var row_index = $(this).parent().index();
                            var cur_content = $(this).html();
                            var lang_col_from = $('#col_'+lang_active_id+'_'+option_id+'_'+col_index);
                            var lang_col_to = $('#col_'+lang_key+'_'+option_id+'_'+col_index);
                            
                            if(lang_col_to.length == 1 && cur_content != '')
                            {
                                var dropdown_index = lang_col_from.find("span:contains('"+cur_content+"')").index();
                                var rep_text = lang_col_to.find('span').eq(dropdown_index).html();
                                option_val_clone.find('tr').eq(row_index).find('td').eq(col_index).html(rep_text);
                                
                                //console.log(dropdown_index + '|' + $( this ).html() );
                                //console.log(rep_text);
                            }
                        });
                        
                        $('#inputOption_'+lang_key+'_'+option_id).parent().find('table > tbody').html(option_val_clone.html());
                        
                        table_add_events(option_id+'_'+lang_key);
                        save_changes_table(option_id+'_'+lang_key);
                    }
                    else if(is_area)
                    {
                        
                        var option_val_lang = $('#inputOption_'+lang_key+'_'+option_id).val();

                        if(typeof CKEDITOR !== 'undefined' && typeof CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id] !== 'undefined') {
                            option_val_lang = CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id].getData();
                        }
                        if(option_val_lang == '' ||
                           option_val_lang == '<br>' )
                        {
                            $.getJSON($('#translate-lang').attr('rel'), {from: lang_active_id, to: lang_key, value: option_val}, function( data ) {
                                if(data.result != '')
                                {
                                    $('#inputOption_'+lang_key+'_'+option_id).val(data.result).blur();
                                    if(typeof CKEDITOR !== 'undefined' && typeof CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id] !== 'undefined') {
                                        CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id].setData(data.result);
                                    }
                                }
                                else
                                {
                                    $('#inputOption_'+lang_key+'_'+option_id).val(option_val).blur();
                                    CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id].setData(option_val);
                                }
                            });
                        }
                    }
                    else if(is_level)
                    {
                        if (typeof load_and_select_index === 'function') {
                            load_and_select_index($('#inputOption_'+lang_key+'_'+option_id+'_level_'+is_level_splited[4]), option_val, is_level_parent_id);
                        }
                    }
                    else
                    {
                        //console.log('#inputOption_'+lang_key+'_'+option_id);
                        //console.log(option_val);
                        $('#inputOption_'+lang_key+'_'+option_id).prop('selectedIndex', parseInt(option_val)); 
                        $('#inputOption_'+lang_key+'_'+option_id).trigger('change');
                    }
                }
            });
        });
        
        return false;
    });
        
});

    <?php if (isset($package_num_amenities_limit)): ?>
        $(document).ready(function () {

            $('.control-group .controls input[type=checkbox]').change(function (event) {
                var selected_checkboxes = $('.tab-pane.active .control-group .controls input[type=checkbox]:checked').length;

                if (selected_checkboxes > <?php echo $package_num_amenities_limit; ?>)
                {
                    $(this).prop('checked', false);
                    ShowStatus.show('<?php echo lang_check('Limitation by package'); ?>: ' + '<?php echo $package_num_amenities_limit; ?>');
                }
            });

        });
    <?php endif; ?>
</script> 

<link rel="stylesheet" href="assets/js/zebra/css/flat/zebra_dialog.css" />
<script src="assets/js/zebra/javascript/zebra_dialog.src.js"></script>
<script>

    /* CL Editor */
    $(document).ready(function () {
        $('.files a.iedit').click(function (event) {
            new $.Zebra_Dialog('', {
                source: {'iframe': {
                        'src': '<?php echo site_url('admin/imageeditor/edit'); ?>/' + $(this).attr('rel'),
                        'height': 700
                    }},
                width: 950,
                title: '<?php _jse(lang_check('Edit image')); ?>',
                type: false,
                buttons: false
            });
            return false;
        });
    });

</script>

<script>
    $(document).ready(function () {
        $('body').append('<div id="blueimp-gallery" class="blueimp-gallery">\n\
                            <div class="slides"></div>\n\
                            <h3 class="title"></h3>\n\
                            <a class="prev">&lsaquo;</a>\n\
                            <a class="next">&rsaquo;</a>\n\
                            <a class="close">&times;</a>\n\
                            <a class="play-pause"></a>\n\
                            <ol class="indicator"></ol>\n\
                            </div>')
    })
</script>
<script>  
        
     $(document).ready(function(){
         /* [Edit property] */
    
                      <?php if(config_db_item('map_version') =='open_street'):?>
            var edit_map_marker;
            var edit_map
            if($('#mapsAddress').length){
                if($('#inputGps').length && $('#inputGps').val() != '')
                {
                    savedGpsData = $('#inputGps').val().split(", ");

                    edit_map = L.map('mapsAddress', {
                        center: [parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])],
                        zoom: {settings_zoom},
                    });     
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(edit_map);
                    var positron = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png').addTo(edit_map);
                    edit_map_marker = L.marker(
                        [parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])],
                        {draggable: true}
                    ).addTo(edit_map);

                    edit_map_marker.on('dragend', function(event){
                        var marker = event.target;
                        var location = marker.getLatLng();
                        var lat = location.lat;
                        var lon = location.lng;
                        $('#inputGps').val(lat+', '+lon);
                        //retrieved the position
                      });

                    firstSet = true;
                }
                else
                {

                    edit_map = L.map('mapsAddress', {
                        center: [{settings_gps}],
                        zoom: {settings_zoom},
                    });     
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(edit_map);
                    var positron = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png').addTo(edit_map);
                    edit_map_marker = L.marker(
                        [{settings_gps}],
                        {draggable: true}
                    ).addTo(edit_map);

                    edit_map_marker.on('dragend', function(event){
                        var marker = event.target;
                        var location = marker.getLatLng();
                        var lat = location.lat;
                        var lon = location.lng;
                        $('#inputGps').val(lat+', '+lon);
                        //retrieved the position
                    });

                    firstSet = true;
                }

                $('#input_address').on('change keyup', function (e) {
                    clearTimeout(timerMap);
                    timerMap = setTimeout(function () {
                        $.get('https://nominatim.openstreetmap.org/search?format=json&q='+$('#input_address').val(), function(data){
                            if(data.length && typeof data[0]) {
                                edit_map_marker.setLatLng([data[0].lat, data[0].lon]).update(); 
                                edit_map.panTo(new L.LatLng(data[0].lat, data[0].lon));
                                $('#inputGps').val(data[0].lat+', '+data[0].lon);
                            } else {
                                ShowStatus.show('<?php echo str_replace("'", "\'", lang_check('Address not found!')); ?>');
                                return;
                            }
                        });
                    }, 2000);

                });
            }
            <?php else:?>
    
            // If alredy selected
            if($('#inputGps').length && $('#inputGps').val() != '')
            {
                savedGpsData = $('#inputGps').val().split(", ");
                
                $("#mapsAddress").gmap3({
                    map:{
                      options:{
                        center: [parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])],
                        zoom: 14
                      }
                    },
                    marker:{
                    values:[
                      {latLng:[parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])]},
                    ],
                    options:{
                      draggable: true
                    },
                    events:{
                        dragend: function(marker){
                          if($("#inputAddress").attr("readonly"))
                          {
                            alert('<?php _l('Location change disabled'); ?>');
                            return false;
                          }
                          else
                          {
                            $('#inputGps').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
                          }
                        }
                  }}});
                
                firstSet = true;
            }
            else
            {
                $("#mapsAddress").gmap3({
                    map:{
                      options:{
                        center: [{settings_gps}],
                        zoom: 12
                      },
                    },
                marker:{
                    values:[
                      {latLng:[{settings_gps}]},
                    ],
                    options:{
                      draggable: true
                    },
                    events:{
                        dragend: function(marker){
                          if($("#inputAddress").attr("readonly"))
                          {
                            alert('<?php _l('Location change disabled'); ?>');
                            return false;
                          }
                          else
                          {
                            $('#inputGps').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
                          }
                        }
                  }}
                  });
                  
                  firstSet = true;
            }
                
            $('#input_address').keyup(function (e) {
                clearTimeout(timerMap);
                timerMap = setTimeout(function () {
                    
                    $("#mapsAddress").gmap3({
                      getlatlng:{
                        address:  $('#input_address').val(),
                        callback: function(results){
                          if ( !results ){
                            ShowStatus.show('<?php echo str_replace("'", "\'", lang_check('Address not found!')); ?>');
                            return;
                          } 
                          
                            if(firstSet){
                                $(this).gmap3({
                                    clear: {
                                      name:["marker"],
                                      last: true
                                    }
                                });
                            }
                          
                          // Add marker
                          $(this).gmap3({
                            marker:{
                              latLng:results[0].geometry.location,
                               options: {
                                  id:'searchMarker',
                                  draggable: true
                              },
                              events: {
                                dragend: function(marker){
                                  if($("#input_address").attr("readonly"))
                                  {
                                    alert('<?php _l('Location change disabled'); ?>');
                                    return false;
                                  }
                                  else
                                  {
                                    $('#inputGps').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
                                  }
                                }
                              }
                            }
                          });
                          
                          // Center map
                          $(this).gmap3('get').setCenter( results[0].geometry.location );
                          
                          $('#inputGps').val(results[0].geometry.location.lat()+', '+results[0].geometry.location.lng());
                          
                          firstSet = true;
    
                        }
                      }
                    });
                }, 2000);
                
            });
            
             <?php endif;?>
        /* [/Edit property] */
     })   
        
</script>   
    </body>
</html>