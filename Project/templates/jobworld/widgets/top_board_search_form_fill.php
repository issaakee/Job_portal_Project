<?php
/*
Widget-title: Search Board fill
Widget-preview-image: /assets/img/widgets_preview/top_board_search_form_fill.jpg
 */
?>
<?php


$treefields = array();
$CI = & get_instance();
$treefield_id = 79;
$treefields = array();
if(isset($options_name_79)){
    $CI->load->model('treefield_m');
    $CI->load->model('file_m');

    $tree_listings = $CI->treefield_m->get_table_tree($lang_id, $treefield_id, NULL, FALSE, '.order', ',image_filename, repository_id, font_icon_code');

    if(!empty($tree_listings) && isset($tree_listings[0])) {

        $_treefields = $tree_listings[0];
       
        foreach ($_treefields as $val) {

            $options = $tree_listings[0][$val->id];
            $treefield = array();
            $field_name = 'value' ;
            $treefield['id'] = trim($options->id);
            $treefield['title'] = str_replace('&', '&amp;', trim($options->$field_name));
            $treefield['title_chlimit'] = character_limiter($options->$field_name, 15);
            $treefield['font_icon_code'] = $options->font_icon_code;
             
            $treefield['url'] = '';
            /* link if have body */
            if(!empty($options->{'body'}))
            {
                $href = slug_url('treefield/'.$lang_code.'/'.$options->id.'/'.url_title_cro($options->value), 'treefield_m');
                $treefield['url'] = $href;
            } else {
                $href = site_url($lang_code.'/'.config_item("results_page_id").'/?search={"v_search_option_'.$treefield_id.'":"'.rawurlencode($treefield['title'].' - ').'"}');
                $treefield['url'] = $href;
            }
            /* end if have body */

            /* Icons(second images) and big image */
            /*$treefield['thumbnail_url_second'] = 'assets/img/icon/category.png';
            $treefield['image_url_second'] = 'assets/img/icon/category.png';
            if(!empty($options->image_filename) && !empty($options->repository_id))
            {
                $files_r = $CI->file_m->get_by(array('repository_id' => $options->repository_id),FALSE, 5,'id ASC');

                  if($files_r and isset($files_r[1]) and file_exists(FCPATH.'files/thumbnail/'.$files_r[1]->filename)) {
                    $treefield['thumbnail_url_second'] = base_url('files/thumbnail/'.$files_r[1]->filename);
                    $treefield['image_url_second'] = base_url('files/'.$files_r[1]->filename);
                  }

            }*/
            /* end Icons(second images) and big image */

            $treefields[] = $treefield;
        }
    }
}

?>

<?php
$CI = &get_instance();
$CI->load->model('estate_m');

 /* results count */
$where = array();
$where['date_modified >'] = date("Y-m-d H:i:s" , time() - 7*86400);
$count = $this->estate_m->count_get_by($where, false, NULL, 'property.id DESC');
?>

<div class="section section-flat-search bg_with_img container container-palette bg-mask search-primary search_hide_distance widget_edit_enabled">
    <img src="assets/img/pic/home_1/header2.jpg" alt="" class="bg_img">
    <div class="container">
        <div class="body">
            <div class="title sw_animatable bounceIn"><?php echo lang_check('Get New Job.');?> <b><?php echo lang_check('Right Now.');?></b></div> <!-- ./ top search title --> 
            <div class="job-form job-form-fill sw_animatable bounceInLeft">
                <form action="#" class="flex-row search-form">
                    <input id="rectangle_ne" type="text" class="hidden" />
                    <input id="rectangle_sw" type="text" class="hidden" />
                    
                    <div class="form-group">
                        <label for="search_option_smart" class="control-label text-color-secondary"><?php echo lang_check('what');?></label>
                        <input type="text" class="form-control" name="search_option_smart" id="search_option_smart" value="<?php _che($search_query); ?>" placeholder="<?php echo lang_check('Keywords');?>" autocomplete="off">
                    </div>  
                    <div class="form-group">
                        <label for="tops_location" class="control-label text-color-secondary"><?php echo lang_check('where');?></label>
                        <div class="form-group-location">
                            <input type="text" class="form-control locationautocomplete" name="search_option_location" value="" id="search_option_location" placeholder="<?php echo lang_check('Location');?>">
                            <i class="fa fa-crosshairs" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="search_types_option" class="control-label text-color-secondary"></label>
                        <select class="form-control selectpicker" name="search_option_<?php echo $treefield_id;?>" title="<?php echo lang_check('Category');?>" id="search_option_<?php echo $treefield_id;?>">
                            <?php foreach ($treefields as $key=>$item): ?>
                                <?php if($treefield_id==79):?>
                                    <?php if(false): /* ativate if have issue with &amp;*/ ?>
                                    <option value="<?php echo str_replace('&amp;','%26',_ch($item['title']));?> -" <?php echo(trim(search_value('79'))== _ch($item['title'])." -") ? 'selected="selected"' : '';?>><?php _che($item['title']);?></option>
                                    <?php else:?>
                                    <option value="<?php echo str_replace('','',_ch($item['title']));?> -" <?php echo(trim(search_value('79'))== _ch($item['title'])." -") ? 'selected="selected"' : '';?>><?php _che($item['title']);?></option>
                                    <?php endif;?>
                                <?php endif;?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group-btn">
                        <button type="submit"  id="search-start" class="btn btn-flat-search"><?php echo lang_check('Search');?><i class="fa fa-spinner fa-spin fa-ajax-indicator hidden"></i></button>
                    </div>  
                </form>
            </div>
            <div class="flat-search-notification sw_animatable bounceInRight"><?php _che($count,0);?> <?php echo lang_check('new jobs posted in the last 7 days');?></div>
        </div> <!-- ./ top search body --> 
    </div>
</div> <!-- ./ top search -->