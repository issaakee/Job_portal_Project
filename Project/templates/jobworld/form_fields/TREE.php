
<?php
    $col=3;
    $f_id = $field->id;
    $placeholder = _ch(${'options_name_'.$f_id});
    $direction = $field->direction;
    if($direction == 'NONE'){
        $col=3;
        $direction = '';
    }
    else
    {
        $placeholder = lang_check($direction);
        $direction=strtolower('_'.$direction);
    }
    
    
    $f_id = $field->id;
    $class_add = $field->class;
    if(empty($class_add))
        $class_add = ' col-sm-3';
    
?>

<div class="<?php echo $class_add; ?>" style="<?php _che($field->style); ?>">
    <div class="form-group">
        <label for="search_option_<?php echo $f_id.$direction; ?>" class="control-label text-color-secondary"><?php echo $placeholder;?></label>
        <?php echo form_treefield('search_option_'.$f_id, 'treefield_m', _che(${'search_option_'.$f_id}), 'value', $lang_id, 'field_search_', true, $placeholder, $f_id, 'class="form-control locationautocomplete"','value_path');?>
    </div><!-- /.select-wrapper -->
</div><!-- /.form-group -->