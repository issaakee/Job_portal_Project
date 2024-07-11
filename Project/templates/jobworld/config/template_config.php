<?php

$config['loaded_template_config'] = 'jobworld';
$config['pseudo_varialbes_disabled'] = TRUE;
$config['per_page'] = 9;
$config['visual_templates_enabled'] = TRUE;
$config['secondary_disabled'] = FALSE;
$config['search_forms_editor_enabled'] = TRUE;
$config['locked_forms'] = array(4);

$config['address_not_required'] = TRUE;

/* property mortgage */
$config['mortgage_interest'] = 5;
$config['mortgage_years'] = 5;
/* end property mortgage */

$config['dependent_treefield'] = TRUE;

$config['user_custom_fields_enabled'] = TRUE;
$config['field_file_upload_enabled'] = TRUE;
$config['currency_conversions_enabled'] = TRUE;
$config['secondary_disabled'] = FALSE;
$config['is_rtl_supported'] = TRUE;
$config['enable_qs'] = TRUE;
$config['last_estates_limit'] = 3;
$config['auto_category_display'] = TRUE;

$config['auto_category_display'] = TRUE;

$config['results_page_id_enabled'] = TRUE;

/* tree_font_icons */ 
$config['tree_font_icon_code_list_css_array'] = array(
    base_url('/templates/jobworld/assets/libraries/font-awesome/css/font-awesome.min.css'),
    base_url('/templates/jobworld/assets/libraries/elegant_font/html_css/style.css')
);

$config['tree_font_icon_code_list'] = 'icon_bag_alt,icon_mic_alt,icon_film,icon_mobile,icon_id-2,icon_globe-2,icon_genius,icon_balance,icon_desktop,fa fa-shopping-cart,fa fa-cutlery,fa fa-glass,fa fa-graduation-cap,fa fa-building,fa fa-coffee,fa fa-shopping-basket';
/* end tree_font_icons */ 

$config['mailchimp_enable'] = true;

$config['dropdown_register_enabled'] = true;
$config['scroll_animation_enable'] = true;
$config['widget_edit_button_enabled'] = true;

$config['tree_field_enabled'] = TRUE;
$config['auto_map_search'] = TRUE;

$config['claim_enabled'] = TRUE;

?>