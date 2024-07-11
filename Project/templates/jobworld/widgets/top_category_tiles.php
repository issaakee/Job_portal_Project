<?php
/*
Widget-title: Categories tiles
Widget-preview-image: /assets/img/widgets_preview/top_category_tiles.jpg
 */
?>

<?php

if(!function_exists('recursion_calc_count')) {
    function recursion_calc_count ($result_count, $tree_listings, $parent_title, $id, &$child_count){
        if (isset($tree_listings[$id]) && sw_count($tree_listings[$id]) > 0){
            foreach ($tree_listings[$id] as $key => $_child) {
                $options = $tree_listings[$_child->parent_id][$_child->id];
                if(isset($result_count[strtolower($parent_title.' - '.$options->value.' -')]))
                    $child_count+= $result_count[strtolower($parent_title.' - '.$options->value.' -')];

                $_parent_title = $parent_title.' - '.$options->value;
                if (isset($tree_listings[$_child->id]) && sw_count($tree_listings[$_child->id]) > 0){    
                    recursion_calc_count($result_count, $tree_listings, $_parent_title, $_child->id, $child_count);
                }
            }
        }
    }
}

$CI = & get_instance();
$treefield_id = 79;

$CI->load->model('treefield_m');
$CI->load->model('option_m');
$CI->load->model('file_m');

$treefields = array();

$check_option= $CI->option_m->get_by(array('id'=>$treefield_id));
// check if option exists
if(!$check_option)
    return false;

if($check_option[0]->type!='TREE')
    return false;

$tree_listings = $CI->treefield_m->get_table_tree($lang_id, $treefield_id, NULL, FALSE, '.order', ',image_filename, repository_id, description, font_icon_code');

if(empty($tree_listings) || !isset($tree_listings[0]))
    return false;

$this->db->select('property.id, property.is_activated, property_value.property_id,
                    property_value.value, COUNT(value) as count');

$this->db->join('property_value',  'property.id = property_value.property_id');

$this->db->group_by('property_value.value,property.id, property.is_activated, property_value.property_id'); 
$this->db->where('option_id', $treefield_id);
$this->db->where('language_id', $lang_id);
$this->db->where('is_activated', 1);
$this->db->where('is_visible', 1);

if(config_db_item('listing_expiry_days') !== FALSE)
{
    if(is_numeric(config_db_item('listing_expiry_days')) && config_db_item('listing_expiry_days') > 0)
    {
        $this->db->where('date_modified >', date("Y-m-d H:i:s" , time() - config_db_item('listing_expiry_days')*86400));
    }
}

$query= $this->db->get('property');

$result_count = array();

if($query){
    $result = $query->result();
    foreach ($result as $key => $value) {
        if(!empty($value->value)) {
            $v = strtolower($value->value);
            $v = trim($v);
            $result_count[$v]= $value->count;
        }
    }
}

$_treefields = $tree_listings[0];
$treefields = array();
foreach ($_treefields as $val) {
    $options = $tree_listings[0][$val->id];
    $treefield = array();
    $field_name = 'value' ;
    $treefield['id'] = trim($options->id);
    $treefield['title'] = trim($options->$field_name);
    $treefield['title_chlimit'] = character_limiter($options->$field_name, 15);
    $treefield['description'] = trim($options->description);
    $treefield['description_chlimit'] = character_limiter($options->description, 50);
    $treefield['font_icon_code'] = _ch($options->font_icon_code, 'icon_genius');
    
    $treefield['count'] = 0;
    if(isset($result_count[strtolower($treefield['title'].' -')]))
        $treefield['count'] = $result_count[strtolower($treefield['title'].' -')];
    
    $treefield['url'] = '';
    /* link if have body */
    if(!empty($options->{'body'}))
    {
        $href = slug_url('treefield/'.$lang_code.'/'.$options->id.'/'.url_title_cro($options->value), 'treefield_m');
        $treefield['url'] = $href;
    } else {
        $href = site_url($lang_code.'/'.config_db_item("results_page_id").'/?search={"v_search_option_'.$treefield_id.'":"'.rawurlencode($treefield['title'].' - ').'"}');
        $treefield['url'] = $href;
    }
    /* end if have body */
    
    // Thumbnail and big image
    if(!empty($options->image_filename) and file_exists(FCPATH.'files/thumbnail/'.$options->image_filename))
    {
        $files_r = $CI->file_m->get_by(array('repository_id' => $options->repository_id),FALSE, 5,'id ASC');

        // check first image
        $treefield['thumbnail_url'] = base_url('files/thumbnail/'.$options->image_filename);
        $treefield['image_url'] = base_url('files/'.$options->image_filename);
        
        // check second image
        $treefield['thumbnail_url_second'] = '';
        $treefield['image_url_second'] = '';
          if($files_r and isset($files_r[1]) and file_exists(FCPATH.'files/thumbnail/'.$files_r[1]->filename)) {
            $treefield['thumbnail_url_second'] = base_url('files/thumbnail/'.$files_r[1]->filename);
            $treefield['image_url_second'] = base_url('files/'.$files_r[1]->filename);
          }else {
            $treefield['thumbnail_url_second'] = 'assets/img/icon/category.png';
            $treefield['image_url_second'] = 'assets/img/icon/category.png';
        }
        
    }
    else
    {
        $treefield['thumbnail_url'] = 'assets/img/no_image.jpg';
        $treefield['image_url'] = 'assets/img/no_image.jpg';
        $treefield['thumbnail_url_second'] = 'assets/img/icon/category.png';
        $treefield['image_url_second'] = 'assets/img/icon/category.png';
    }
    
    $childs_count = 0;
    $childs = array();
    if (isset($tree_listings[$val->id]) && sw_count($tree_listings[$val->id]) > 0)
        foreach ($tree_listings[$val->id] as $key => $_child) {
            $child = array();
            $options = $tree_listings[$_child->parent_id][$_child->id];
            $field_name = 'value';
            $child['title'] = trim($options->$field_name);
            $child['title_chlimit'] = character_limiter($options->$field_name, 10);
            
            $child['count']= 0;
            if(isset($result_count[strtolower($treefield['title'].' - '.$child['title'].' -')]))
                $child['count'] = $result_count[strtolower($treefield['title'].' - '.$child['title'].' -')];
            
            $child['url'] = '';
            /* link if have body */
                if(!empty($options->{'body'}))
                {
                    // If slug then define slug link
                    $href = slug_url('treefield/'.$lang_code.'/'.$options->id.'/'.url_title_cro($options->value), 'treefield_m');
                    $child['url'] = $href;
                } 
            /* end if have body */
            $child['url'] = '';
            /* link if have body */
            if(!empty($options->{'body'}))
            {
                $href = slug_url('treefield/'.$lang_code.'/'.$options->id.'/'.url_title_cro($options->value), 'treefield_m');
                $child['url'] = $href;
            } else {
                $href = site_url($lang_code.'/'.config_db_item("results_page_id").'/?search={"v_search_option_'.$treefield_id.'":"'.rawurlencode($treefield['title'].' - '.$child['title'].' - ').'"}');
                $child['url'] = $href;
            }
            /* end if have body */    
                
                
            if (isset($tree_listings[$_child->id]) && sw_count($tree_listings[$_child->id]) > 0){
                $parent_title = $treefield['title'].' - '.$child['title'];
                recursion_calc_count($result_count, $tree_listings, $parent_title, $_child->id, $child['count']);
            }   
                   
            $childs_count+=$child['count'];
            $childs[] = $child;
        }

    
    $treefield['count'] += $childs_count;
    $treefield['childs'] = $childs;
    $treefield['childs_more'] = array_slice($childs, 5);
    $treefield['childs_5'] = array_slice($childs, 0, 5);
    $treefields[] = $treefield;
}
?>

<div class="section-slim section-categories container container-palette widget_edit_enabled">
    <div class="container">
        <h2 class="section-title left small"><?php echo lang_check('Browse By Category');?></h2><!-- ./ section title --> 
        <div class="grid-tiles">
            <?php $i=0;  foreach ($treefields as $key=>$item): ?>
            <?php if ($i>3) break; ?>
            <div class="grid-tile">
                <a href='<?php _che($item['url']);?>'>
                    <div class="preview">
                        <i class="<?php _che($item['font_icon_code']);?>"></i>
                    </div>
                    <div class="caption">
                        <h2 class="title"><?php _che($item['title']);?></h2>
                    </div>
                </a>
            </div>  
            <?php $i++; endforeach; ?>
        </div>
    </div>
</div> <!-- ./  Categories grid --> 