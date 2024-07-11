<?php
/*
Widget-title: Section New Jobs in Your Area
Widget-preview-image: /assets/img/widgets_preview/top_recent_jobs_area.jpg
 */
?>

<?php
 $CI = &get_instance();
 $CI->load->model('estate_m');
 $CI->load->model('option_m');

 /* results count */
$last_n = 1;

$top_n_estates = $this->estate_m->get_by(array('is_activated' => 1, 'language_id'=>$lang_id), FALSE, $last_n, 'RAND()');
$options_name = $this->option_m->get_lang(NULL, FALSE, $lang_id);

$top_estates_num = $last_n;
$rand_estates = array();
$CI->generate_results_array($top_n_estates, $rand_estates, $options_name); 
 
?>

<div class="section section-listings container container-palette section-job-area widget_edit_enabled">
    <div class="container">
        <h2 class="section-title"><?php echo lang_check('New Jobs in Your Area');?></h2><!-- ./ section title --> 
        <div class="wraper-row">
            <div class="column-content">
                <div class="results-list">
                    <?php if($last_estates):?>
                    <?php foreach($last_estates as $item): ?>
                    <?php
                        /* colors for field #3 */
                        $helper_class_option_3 ='';
                        if(isset($item['option_3']) && !empty($item['option_3'])) {
                            $key = array_search($item['option_3'], $options_values_arr_3);
                            if($key!== FALSE)
                                $helper_class_option_3 = $key;
                        }

                        /* end colors for field #3 */
                    ?>
                    <div class="item">
                        <div class="flex-row">
                            <div class="grid-content">
                                <h3 class="title text-color-secondary"><a href="<?php echo $item['url']; ?>" title="<?php echo _ch($item['option_10']); ?>"><?php echo _ch($item['option_10']); ?></a></h3>
                                <div class="options">
                                    <?php if(!empty($item['option_79'])):?>
                                        <?php
                                            $val_79 = $item['option_79'];
                                            if(strrpos($val_79, " - ") !== FALSE) {
                                                $pos = strrpos($val_79, " - ");
                                                $val_79 = substr($val_79,0, $pos);
                                            }
                                        ?>
                                        <span class="opt"><?php echo _ch($val_79, '-'); ?></span>
                                    <?php endif;?>
                                    <?php if(!empty($item['option_36']) || !empty($item['option_37'])): ?>
                                    <?php 
                                        if(!empty($item['option_36']))echo '<span class="option opt-price"><i class="icon_currency"></i>'.$options_prefix_36.price_format($item['option_36'], $lang_id).$options_suffix_36.'</span>';
                                        elseif(!empty($item['option_37']))echo '<span class="option opt-price"><i class="icon_currency"></i>'.$options_prefix_37.price_format($item['option_37'], $lang_id).$options_suffix_37.'</span>';
                                    ?>
                                    <?php endif; ?>
                                    <span class="opt-light"><i class="icon_pin_alt"></i><?php _che($item['address']); ?></span>
                                </div>
                            </div>
                            <div class="grid-side"><span class="item-label text-red helper_option_3_<?php echo $helper_class_option_3;?>"><i class="icon_ribbon_alt"></i><?php echo _ch($item['option_3'], ''); ?></span></div>
                        </div>
                    </div><!-- ./ job purpose --> 
                    <?php endforeach;?>
                    <?php else:?>
                    <div class="result-answer">
                        <div class="alert alert-success">
                            <?php _l('Noestates');?>
                        </div>
                    </div>
                    <?php endif;?>
                </div><!-- ./ jobs list --> 
            </div>
            <div class="column-sidebar">
                <?php if(!empty($rand_estates))foreach($rand_estates as $item): ?>
                <?php
                    /* colors for field #3 */
                    $helper_class_option_3 ='';
                    if(isset($item['option_3']) && !empty($item['option_3'])) {
                        $key = array_search($item['option_3'], $options_values_arr_3);
                        if($key!== FALSE)
                            $helper_class_option_3 = $key;
                    }
                    /* end colors for field #3 */
                ?>
                <div class="alert-item">
                    <div class="badget featured"><i class="icon_star"></i></div>
                    <div class="header">
                        <h2 class="title text-color-secondary"><a href="<?php echo $item['url']; ?>" title="<?php echo _ch($item['option_10']); ?>"><?php echo _ch($item['option_10']); ?></a></h2>
                    </div>
                    <div class="body">
                        <ul class="options-list">
                            <?php if(!empty($item['option_36']) || !empty($item['option_37'])): ?>
                            <?php 
                                if(!empty($item['option_36']))echo '<li class="opt"><i class="icon_currency"></i>'.$options_prefix_36.price_format($item['option_36'], $lang_id).$options_suffix_36.'</li>';
                                elseif(!empty($item['option_37']))echo '<li class="opt"><i class="icon_currency"></i>'.$options_prefix_37.price_format($item['option_37'], $lang_id).$options_suffix_37.'</li>';
                            ?>
                            <?php endif; ?>
                            <?php if(!empty($item['option_79'])):?>
                                <?php
                                    $val_79 = $item['option_79'];
                                    if(strrpos($val_79, " - ") !== FALSE) {
                                        $pos = strrpos($val_79, " - ");
                                        $val_79 = substr($val_79,0, $pos);
                                    }
                                ?>
                                <li class="opt"><?php echo _ch($val_79, '-'); ?></li>
                            <?php endif;?>
                            
                            <li class="opt-light"><i class="icon_pin_alt"></i><?php _che($item['address']); ?></li>
                        </ul>
                    </div>
                    <div class="alert-footer">
                        <a href="<?php echo $item['url']; ?>" class="btn btn-custom btn-custom-secondary"><?php echo lang_check('Apply');?></a>
                        <a href="<?php echo $item['url']; ?>" class="btn btn-clear btn-alert-clear text-red helper_option_3_<?php echo $helper_class_option_3;?>"><i class="icon_ribbon_alt"></i><?php echo _ch($item['option_3'], ''); ?></a></div>
                </div><!-- ./ job box --> 
                <?php endforeach;?>
            </div><!-- ./ sideber of section --> 
        </div>
    </div>
</div><!-- ./ jobs sections -->   