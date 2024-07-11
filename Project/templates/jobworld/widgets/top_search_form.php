<?php
/*
Widget-title: Search form
Widget-preview-image: /assets/img/widgets_preview/top_search_form.jpg
 */
?>
<div class="section section-top-search container-palette search-primary widget_edit search_hide_distance widget_edit_enabled">
    <div class="container">
        <div class="body">
            <div class="job-form search-form">
                <form action="#" class="flex-row">
                    {is_logged_other}
                    <div class="widget-controls-panel widget_controls_panel"  data-widgetfilename="top_search">
                        <a href="<?php echo site_url('admin/forms/edit/1');?>" target="_blunk" target="_blunk" class="btn btn-edit"><i class="fa fa-edit"></i></a>
                    </div>
                    {/is_logged_other}
                      <?php _search_form_primary(1) ;?> 
                      <div class="advanced-form-part hidden">
                      <div class="form-row-space"></div>
                      <?php if(config_db_item('secondary_disabled') === TRUE): ?>
                        <!--
                       <input id="search_option_36_from" type="text" class="span3 mPrice" placeholder="<?php _l('Fromprice');?> ({options_prefix_36}{options_suffix_36})" value="<?php echo search_value('36_from'); ?>" />
                       <input id="search_option_36_to" type="text" class="span3 xPrice" placeholder="<?php _l('Toprice');?> ({options_prefix_36}{options_suffix_36})" value="<?php echo search_value('36_to'); ?>" />
                       -->
                        <input id="search_option_19" type="text" class="span3 Bathrooms" placeholder="{options_name_19}" value="<?php echo search_value(19); ?>" />
                       <input id="search_option_20" type="text" class="span3" placeholder="{options_name_20}" value="<?php echo search_value(20); ?>" />
                       <div class="form-row-space"></div>
                       <?php if(file_exists(APPPATH.'controllers/admin/booking.php')):?>
                       <input id="booking_date_from" type="text" class="span3 mPrice" placeholder="<?php _l('FromDate');?>" value="<?php echo search_value('date_from'); ?>" />
                       <input id="booking_date_to" type="text" class="span3 xPrice" placeholder="<?php _l('ToDate');?>" value="<?php echo search_value('date_to'); ?>" />
                       <div class="form-row-space"></div>
                       <?php endif; ?>
                       <?php if(config_db_item('search_energy_efficient_enabled') === TRUE): ?>
                       <select id="search_option_59_to" class="span3 selectpicker nomargin">
                           <option value="">{options_name_59}</option>
                           <option value="50">A</option>
                           <option value="90">B</option>
                           <option value="150">C</option>
                           <option value="230">D</option>
                           <option value="330">E</option>
                           <option value="450">F</option>
                           <option value="999999">G</option>
                       </select>
                       <div class="form-row-space"></div>
                       <?php endif; ?>
                       <label class="checkbox">
                       <input id="search_option_11" type="checkbox" class="span1" value="true{options_name_11}" <?php echo search_value('11', 'checked'); ?>/>{options_name_11}
                       </label>
                       <label class="checkbox">
                       <input id="search_option_22" type="checkbox" class="span1" value="true{options_name_22}" <?php echo search_value('22', 'checked'); ?>/>{options_name_22}
                       </label>
                       <label class="checkbox">
                       <input id="search_option_25" type="checkbox" class="span1" value="true{options_name_25}" <?php echo search_value('25', 'checked'); ?>/>{options_name_25}
                       </label>
                       <label class="checkbox">
                       <input id="search_option_27" type="checkbox" class="span1" value="true{options_name_27}" <?php echo search_value('27', 'checked'); ?>/>{options_name_27}
                       </label>
                       <label class="checkbox">
                       <input id="search_option_28" type="checkbox" class="span1" value="true{options_name_28}" <?php echo search_value('28', 'checked'); ?>/>{options_name_28}
                       </label>
                       <label class="checkbox">
                       <input id="search_option_29" type="checkbox" class="span1" value="true{options_name_29}" <?php echo search_value('29', 'checked'); ?>/>{options_name_29}
                       </label>
                       <label class="checkbox">
                       <input id="search_option_32" type="checkbox" class="span1" value="true{options_name_32}" <?php echo search_value('32', 'checked'); ?>/>{options_name_32}
                       </label>
                       <label class="checkbox">
                       <input id="search_option_30" type="checkbox" class="span1" value="true{options_name_30}" <?php echo search_value('30', 'checked'); ?>/>{options_name_30}
                       </label>
                       <label class="checkbox">
                       <input id="search_option_33" type="checkbox" class="span1" value="true{options_name_33}" <?php echo search_value('33', 'checked'); ?>/>{options_name_33}
                       </label>
                       <label class="checkbox">
                       <input id="search_option_23" type="checkbox" class="span1" value="true{options_name_23}" <?php echo search_value('23', 'checked'); ?>/>{options_name_23}
                       </label>
                       <?php else: ?>
                       <?php _search_form_secondary_hidden(1); ?>
                       <?php endif; ?>
                    </div>
                    <div class="form-group-btn  <?php if(file_exists(APPPATH.'controllers/admin/savesearch.php')):?>  col-sm-3 form_field_save <?php endif;?>">
                        <button type="submit"  id="search-start" class="btn btn-flat-search"><?php echo lang_check('Search');?></button>
                    <?php if(file_exists(APPPATH.'controllers/admin/savesearch.php')): ?>
                        <button type="button" id="search-save" class="btn btn-flat-search btn-savesearch btn-custom-secondary btn-icon"><i class="fa fa-spinner fa-spin fa-ajax-indicator" style="display: none;"></i><span>{lang_SaveResearch}</span></button>
                    <?php endif; ?>
                    </div>  
                </form>
            </div>
        </div> <!-- ./ top search body --> 
    </div>
</div> <!-- ./ top search --> 