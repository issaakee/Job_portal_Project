<?php
/*
Widget-title: Featured Jobs
Widget-preview-image: /assets/img/widgets_preview/center_featuredproperties.jpg
 */
?>
<?php if(!empty($featured_properties)):?>
<div class="section-m m105 pt-15 section-listings-wide container container-palette widget_edit_enabled">
    <h2 class="section-title"><?php echo lang_check('Featured Jobs');?></h2><!-- ./ section title --> 
    <div class="column-content">
        <div class="results-list middle result_preload_box" id="results_conteiner">
            <div class="result-container">
                <?php foreach($featured_properties as $key=>$item): ?>
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
                                    <?php if(!empty($option_79)):?>
                                        <span class="opt"><?php echo _ch($option_79, '-'); ?></span>
                                    <?php endif;?>
                                    <?php if(!empty($item['option_36']) || !empty($item['option_37'])): ?>
                                    <?php 
                                        if(!empty($item['option_36']))echo '<span class="option opt-price"><i class="icon_currency"></i>'.$options_prefix_36.price_format($item['option_36'], $lang_id).$options_suffix_36.'</span>';
                                        if(!empty($item['option_37']))echo '<span class="option opt-price"><i class="icon_currency"></i>'.$options_prefix_37.price_format($item['option_37'], $lang_id).$options_suffix_37.'</span>';
                                    ?>
                                    <?php endif; ?>
                                    <span class="opt-light"><i class="icon_pin_alt"></i><?php _che($item['address']); ?></span>
                                </div>
                            </div>
                            <div class="grid"><span class="item-label text-red helper_option_3_<?php echo $helper_class_option_3;?>"><i class="icon_ribbon_alt"></i><?php echo _ch($item['option_3'], ''); ?></span></div>
                            <div class="grid-side">
                                <a href="<?php echo $item['url']; ?>" class="btn btn-custom btn-custom-secondary "><?php echo lang_check('Apply');?></a>
                            </div>
                        </div>
                    </div><!-- ./ job purpose --> 
                <?php endforeach;?>
            </div>
        </div><!-- ./ jobs list --> 
    </div>
</div><!-- ./ jobs listigns --> 
<?php endif;?>