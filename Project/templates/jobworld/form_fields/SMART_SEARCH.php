<?php
    $sel_values = array(0,50,100,200,500);
    $suffix = lang_check('km');
    $curr_value=NULL;
    
    if(isset($_GET['search']))$search_json = json_decode($_GET['search']);
    if(isset($search_json->v_search_radius))
    {
        $curr_value=$search_json->v_search_radius;
    }
    
?>


<div class="col-md-6 form-group-smart">
    <div class="row clearfix">
        <div class="form-group form-group-location col-sm-6">
            <label for="search_option_smart" class="control-label text-color-secondary"><?php echo lang_check('Where?');?></label>
            <div class="form-group-location">
                <input id="search_option_smart" value="<?php _che($search_query); ?>" type="text"  class="form-control locationautocomplete" placeholder="<?php echo lang_check('Where?');?>" />
                <i class="fa fa-crosshairs" aria-hidden="true"></i>
            </div><!-- /.form-group -->
        </div><!-- /.form-group -->
        <div class="form-group col-sm-6 form-group-scale form-group-distance">
            <label for="search_radius" class="control-label text-color-secondary"><?php echo lang_check('Distance around position');?></label>
            <input type="range" class="custom-range" min="0" max="50" id="search_radius" name="search_radius">
        </div><!-- /.form-group -->
    </div>
</div>