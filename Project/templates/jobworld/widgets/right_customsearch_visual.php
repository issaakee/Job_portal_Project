<?php
/*
Widget-title: Custom Filters
Widget-preview-image: /assets/img/widgets_preview/right_customsearch_visual.jpg
 */
?>
<div class="search-form widget_edit_enabled">
<?php if(isset($options_name_36)): ?>
<div class="widget">
    <div class="widget-header">
        <h2 class="title">Les salaire(DZD)</h2>
    </div>
    <ul class="widget-list hidden_input list-radio">
        <li><label><input type="radio" name="search_option_36_from" class="v_search" value="20000" /><span><?php echo $options_prefix_36.$options_suffix_36;?>20,000+</span></label></li>
        <li><label><input type="radio" name="search_option_36_from" class="v_search" value="25000" /><span><?php echo $options_prefix_36.$options_suffix_36;?>25,000+</span></label></li>
        <li><label><input type="radio" name="search_option_36_from" class="v_search" value="30000" /><span><?php echo $options_prefix_36.$options_suffix_36;?>30,000+</span></label></li>
        <li><label><input type="radio" name="search_option_36_from" class="v_search" value="40000" /><span><?php echo $options_prefix_36.$options_suffix_36;?>40,000+</span></label></li>
        <li><label><input type="radio" name="search_option_36_from" class="v_search" value="60000" /><span><?php echo $options_prefix_36.$options_suffix_36;?>60,000+</span></label></li>
    </ul>
</div>   <!-- ./widget filters -->       
<?php endif; ?>

<?php if(isset($options_name_4)): ?>
<div class="widget">
    <div class="widget-header">
        <h2 class="title">Niveau d'expérience</h2>
    </div>
    <ul class="widget-list hidden_input list-radio">
        <?php if(isset($options_values_arr_4) && !empty($options_values_arr_4))foreach ($options_values_arr_4 as $value):if(empty($value)) continue;?>
        <li><label><input type="radio" name="search_option_4" class="v_search"  value="<?php _che($value);?>" /><span><?php _che($value);?></span></label></li>
        <?php endforeach;?>
    </ul>
</div>   <!-- ./widget filters -->       
<?php endif; ?>

<?php
    $col=3;
    $f_id = 79;
    $placeholder = _ch(${'options_name_'.$f_id});
    $direction = '';
    $class_add = ' ';
    
?>

 <?php
/*
Widget-title: Search form #2 (horizontal)
Widget-preview-image: /assets/img/widgets_preview/top_search-cityguide.jpg
 */
$tree_field_id = $f_id;
$breadcrump_tree_string ='';
if(search_value($tree_field_id)){
    $CI = & get_instance();
    $values = array();
    $CI->load->model('treefield_m');
    $check_option = $CI->treefield_m->get_lang(NULL, FALSE, $lang_id);
    foreach ($check_option as $key => $value) {
        if($value->field_id==$tree_field_id){
            $item= new stdClass();
            $item->value = $value->value;
            $item->value_path = $value->value_path;
            $item->parent_id = $value->parent_id;
            $item->treefield_id = $value->treefield_id;
            $item->level = $value->level;
            $values[$value->value_path.' -']= $item;
        }
    }
    
    $values_tree = [];
    $search_value_f = search_value($tree_field_id);
    $search_value_f = str_replace('&amp;', '&', $search_value_f);
    if(isset($values[trim($search_value_f)])) {
        $field = $values[trim($search_value_f)];
        
        $values_tree[] = $field->treefield_id;
        
        if(!empty($field->parent_id))
            $field = $CI->treefield_m->get_lang($field->parent_id, FALSE, $lang_id);
        else 
            $field = false;
       
        while ($field) {
            
            $values_tree[] = $field->id;

            if(!empty($field->parent_id))
                $field = $CI->treefield_m->get_lang($field->parent_id, FALSE, $lang_id);
            else 
                $field = false;
        
        };
    }
    
    $values_tree = array_reverse($values_tree);
}

?>

<script>
    
    /* [START] TreeField */
  
    $(function() {
        $(".search-form .TREE-GENERATOR#TREE-GENERATOR_ID_<?php echo $f_id;?> input").change(function(e, trigger){
            console.log('change');
            if (typeof trigger === 'undefined') trigger = [];
            
            
            var s_value = $(this).filter(":checked").val();
            var s_name_splited = $(this).attr('name').split("_"); 
            var s_level = parseInt(s_name_splited[3]);
            var s_lang_id = s_name_splited[1];
            var s_field_id = s_name_splited[0].substr(6);
            // console.log(s_value); console.log(s_level); console.log(s_field_id);
            //var isTrigger = isTrigger || false;
            
            $('#search_option_'+s_field_id).val($(this).filter(":checked").attr('data-rel'))
            
            if(trigger.isTrigger)
                load_by_field($(this), true, trigger.s_values_splited);
            else
                load_by_field($(this));
                
            // Reset child selection and value generator
            var generated_val = '';
            var last_selected_numeric = '';
            $(this).parent().parent()
            .find('select').each(function(index){
                // console.log($(this).attr('name'));
                if(index > s_level)
                {
                    //$(this).html('<option value=""><?php echo lang_check('No values found'); ?></option>');
                    if(!trigger.isTrigger) {
                        $(this).find("option:gt(0)").remove();
                        $(this).val('');
                        $(this).selectpicker('refresh');
                    }
                }
                else
                {
                    last_selected_numeric = $(this).val();
                    generated_val+=$(this).find("option:selected").text()+" - ";
                }    
            });
            //console.log(generated_val);
            $("#sinputOption_"+s_lang_id+"_"+s_field_id).val(generated_val);
            
            $("#inputOption_"+s_lang_id+"_"+s_field_id).attr('rel', last_selected_numeric);
            $("#inputOption_"+s_lang_id+"_"+s_field_id).val(generated_val);
            $("#inputOption_"+s_lang_id+"_"+s_field_id).trigger("change");

        });
        
        

    });
    
    function load_by_field(field_element, autoselect_next, s_values_splited, first_load)
    {
        if (typeof first_load === 'undefined') first_load = false;
        if (typeof autoselect_next === 'undefined') autoselect_next = false;
        if (typeof s_values_splited === 'undefined') s_values_splited = [];
        
       /* console.log('load_by_field');*/
       // console.log('isTrigger ' + first_load)
        var s_value = field_element.val();
        var s_name_splited = field_element.attr('name').split("_"); 
        var s_value_text =field_element.attr('data-val');
        var s_value_rel_parent =field_element.attr('data-rel');
        var s_level = parseInt(s_name_splited[3]);
        var s_lang_id = s_name_splited[1];
        var s_field_id = s_name_splited[0].substr(6);
        // console.log(s_value); console.log(s_level); console.log(s_field_id);
        
       
        // Load values for next select
        var ajax_indicator = field_element.parent().parent().parent().find('.ajax_loading');
        var select_element = $("#option"+s_field_id+"_"+s_lang_id+"_level_"+parseInt(s_level+1)+"");
        if(select_element.length > 0 && s_value != '')
        {
            ajax_indicator.css('display', 'block');
            $.getJSON( "<?php echo site_url('api/get_level_values_select'); ?>/"+s_lang_id+"/"+s_field_id+"/"+s_value+"/"+parseInt(s_level+1), function( data ) {
                //console.log(data.generate_select);
                //console.log("select[name=option"+s_field_id+"_"+s_lang_id+"_level_"+parseInt(s_level+1)+"]");
                ajax_indicator.css('display', 'none');
                
                var $html= '';
                $html +='<li><label><input type="radio" name="#option'+s_field_id+'_'+s_lang_id+'_level_'+parseInt(s_level+1)+'" class="v_search tree-input skip" data-rel="'+s_value_rel_parent+'" data-val="'+data.values_arr[""]+'"  value="" /><span>'+data.values_arr[""]+'</span></label></li>';
                $.each(data.values_arr, function(i,val){
                    if(i!='')
                    $html +='<li><label><input type="radio" name="option'+s_field_id+'_'+s_lang_id+'_level_'+parseInt(s_level+1)+'" class="v_search tree-input skip" data-rel="'+s_value_rel_parent+''+val+'" data-val="'+val+'"  value="'+i+'" /><span>'+val+'</span></label></li>';
                })
                select_element.find('.widget-list.list-radio').html($html);
                select_element.find('.widget-header .title').html(s_value_text);
                
                
                if(autoselect_next)
                {
                    if(s_values_splited[s_level+1] != '')
                    {
                        var id = select_element.find('option').filter(function () { return $(this).html() == s_values_splited[s_level+1]; }).attr('selected', 'selected').val();
                        select_element.selectpicker('val', id);
                        load_by_field(select_element, true, s_values_splited);
                        
                    }
                }
                if(first_load === true){
                    var trigger = {'isTrigger' : true, 's_values_splited':s_values_splited};
                    $(".search-form .TREE-GENERATOR#TREE-GENERATOR_ID_<?php echo $f_id;?>").find('select:first').trigger('change', [trigger]);
                }
                
            })
            .success(function(data){
                select_element.slideDown();
                 select_element.find('input').change(function(){
                    var s_value_rel_parent = $(this).attr('data-rel');
                    $('#search_option_'+s_field_id).val(s_value_rel_parent)
                 })
            });
        } else {
            select_element.find('.widget-list.list-radio').html('');
            select_element.find('.widget-header .title').html('');
            select_element.slideUp();
        }
        
    }
    
    /* [END] TreeField */

</script>

<!-- [START] TreeSearch -->
<div class="" style="">
<?php

    $CI =& get_instance();
    $CI->load->model('treefield_m');
    $field_id = $f_id;
    $drop_options = $CI->treefield_m->get_level_values($lang_id, $field_id);
    $drop_selected = array();
    
    $defined_id = false;
    if(isset($values_tree[0]))
    {
        $defined_id = $values_tree[0];
    }
    
    echo '<div class="tree TREE-GENERATOR" id="TREE-GENERATOR_ID_'.$f_id.'">';
        ?>
        <div class="widget" id="option<?php echo $field_id;?>_<?php echo $lang_id;?>_level_0">
        <div class="widget-header">
            <h2 class="title"><?php echo Catégorie ;?></h2>
        </div>
        <ul class="widget-list hidden_input list-radio">
            <?php if(isset($drop_options) && !empty($drop_options))foreach ($drop_options as $key=> $value):if(empty($value)) continue;?>
            <li><label><input type="radio" data-rel="<?php echo ($key!='') ? $value.' - ' : ''?>" name="option<?php echo $field_id;?>_<?php echo $lang_id;?>_level_0" class="v_search tree-input skip" data-val="<?php _che($value);?>" <?php if($key==$defined_id):?> checked="checked"<?php endif;?> value="<?php _che($key, '');?>" /><span><?php _che($value);?></span></label></li>
            <?php endforeach;?>
        </ul>
        </div>
    <?php
    
    $levels_num = $CI->treefield_m->get_max_level($field_id);
    
    if($levels_num>0)
    for($ti=1;$ti<=$levels_num;$ti++)
    {
        $lang_empty = lang('treefield_'.$field_id.'_'.$ti);
        
        $drop_options ='';
        
        if(isset($values_tree[$ti-1]))
            $drop_options = $CI->treefield_m->get_level_values($lang_id, $field_id, $values_tree[$ti-1], 1);
        
        if(empty($drop_options))
            $drop_options =array(''=>lang_check('Please select parent'));
        
            
        $defined_id = false;
        if(isset($values_tree[$ti]))
        {
            $defined_id = $values_tree[$ti];
        }
        
        ?>
        <div class="widget" id="option<?php echo $field_id;?>_<?php echo $lang_id;?>_level_<?php echo $ti;?>" <?php if(!$defined_id):?>style="display: none" <?php endif;?>>
            <div class="widget-header">
                <h2 class="title"><?php echo ${'options_name_'.$f_id};?></h2>
            </div>
            <ul class="widget-list hidden_input list-radio">
                <?php if(isset($drop_options) && !empty($drop_options))foreach ($drop_options as $key=>$value):if(empty($value)) continue;?>
                <li><label><input type="radio" name="option<?php echo $field_id;?>_<?php echo $lang_id;?>_level_<?php echo $ti;?>" data-val="<?php _che($value);?>" class="v_search tree-input skip" <?php if($key==$defined_id):?> checked="checked"<?php endif;?> value="<?php _che($key, '');?>" /><span><?php _che($value);?></span></label></li>
                <?php endforeach;?>
            </ul>
        </div>
        <?php 
    }
   
    
    
    echo '</div>';

?>
</div><!-- /.form-group -->

<script>

$(window).load(function()  {
    var load_val = '<?php echo search_value($field_id); ?>';
    var s_values_splited = (load_val+" ").split(" - "); 
//            $.each(s_values_splited, function( index, value ) {
//                alert( index + ": " + value );
//            });
    var first_load = true;
    if(s_values_splited[0] != '')
    {
        var first_select = $('.TREE-GENERATOR#TREE-GENERATOR_ID_<?php echo $f_id;?>').find('select:first');
        var id = first_select.find('option').filter(function () { return $(this).html() ==  s_values_splited[0]; }).attr('selected', 'selected').val();

        /* test fix */
        first_select.val(id)
        first_select.selectpicker('refresh')
        /* end test fix */

        //first_select.selectpicker('val', id);
        load_by_field(first_select, true, s_values_splited, first_load);
        first_load = false;
    }

});

</script>

<!-- [END] TreeSearch -->

<?php 

echo form_input('search_option_' . $field_id , str_replace('&amp;', '&', search_value($tree_field_id)), 'class="form-control hidden" id="search_option_' . $field_id . '" rel=""'); 

?>


<style type="text/css">
    #TREE-GENERATOR_ID_<?php echo $f_id;?> .field-tree:not(:first-child) {
        display: none;
    } 
</style>









<?php if(isset($options_name_3)): ?>
<div class="widget">
    <div class="widget-header">
        <h2 class="title">Type d'emploi</h2>
    </div>
    <ul class="widget-list hidden_input list-radio">
        <?php if(isset($options_values_arr_3) && !empty($options_values_arr_3))foreach ($options_values_arr_3 as $value):if(empty($value)) continue;?>
        <li><label><input type="radio" name="search_option_3" class="v_search" <?php echo (strtolower(search_value('search_option_3'))==strtolower($value)) ? 'checked=""' : '';?> value="<?php _che($value);?>" /><span><?php _che($value);?></span></label></li>
        <?php endforeach;?>
    </ul>
</div>   <!-- ./widget filters -->       
<?php endif; ?>
</div>