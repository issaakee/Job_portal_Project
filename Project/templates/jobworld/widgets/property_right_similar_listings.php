<?php

$similar_estates = array();

$CI =& get_instance();

$where = array();
$where['language_id']  = $lang_id;
$where['is_activated'] = 1;
if(isset($CI->data['settings_listing_expiry_days']))
{
    if(is_numeric($CI->data['settings_listing_expiry_days']) && $CI->data['settings_listing_expiry_days'] > 0)
    {
         $where['property.date_modified >']  = date("Y-m-d H:i:s" , time()-$CI->data['settings_listing_expiry_days']*86400);
    }
}

//where (similar properties) price, purpose, county
if(!empty($estate_data_option_37))
{
    $where['field_37_int >'] = 0.7*$estate_data_option_37;
    $where['field_37_int <'] = 1.3*$estate_data_option_37;
}
    
if(!empty($estate_data_option_36))
{
    $where['field_36_int >'] = 0.7*$estate_data_option_36;
    $where['field_36_int <'] = 1.3*$estate_data_option_36;
}
    
if(!empty($estate_data_option_4))
{
    $where['field_4'] = $estate_data_option_4;
}

$where['is_activated'] = 1;
$where['property.id !='] = $property_id;

$similar_estates = $CI->estate_m->get_by($where, FALSE, 3, 'RAND()', 0, array(), NULL);

$similar_estates_array = array();
$CI->generate_results_array($similar_estates, $similar_estates_array, $options_name);
if(sw_count($similar_estates_array) > 0): ?>
<div class="widget widget-posts">
    <div class="widget-header">
        <h2 class="title"><?php echo lang_check('Similar Jobs'); ?></h2>
    </div>
    <div class="w-posts-list">
        <?php foreach($similar_estates_array as $item): ?>
        <div class="item">
            <div class="preview"><a href="<?php echo $item['url']; ?>"><img src="<?php echo _simg($item['thumbnail_url'], '128x128'); ?>" alt=""></a></div>
            <div class="body">
                <h3 class="title"><a href="<?php echo $item['url']; ?>"><?php echo _ch($item['option_10']);?></a></h3>
                <?php if(!empty($item['option_36']) || !empty($item['option_37'])): ?>
                <?php 
                    if(!empty($item['option_36']))echo '<div class="data price">'.$options_prefix_36.price_format($item['option_36'], $lang_id).$options_suffix_36.'</div>';
                    elseif(!empty($item['option_37']))echo '<div class="data price">'.$options_prefix_37.price_format($item['option_37'], $lang_id).$options_suffix_37.'</div>';
                ?>
                <?php endif; ?>
                <div class="data">
                    <?php
                        $timestamp = strtotime($item['date']);
                        $m = strtolower(date("F", $timestamp));
                        echo lang_check('cal_' . $m) . ' ' . date("j, Y", $timestamp);
                    ?>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>
<?php endif;?>