<?php
/*
Widget-title: New Jobs in Your Area
Widget-preview-image: /assets/img/widgets_preview/top_latest_listings.jpg
 */
?>
<div class="section section-listings-wide container container-palette widget_edit_enabled">
    <div class="container">
        <h2 class="section-title"><?php echo lang_check('New Jobs in Your Area');?></h2><!-- ./ section title --> 
        <div class="column-content">
            <div class="results-list table middle m0">
                <?php if($last_estates):?>
                <?php foreach($last_estates as $key=>$item): ?>
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
                <div class="item  sw_animatable <?php echo ($key %2 == 0)? 'bounceFadeInLeft':'bounceFadeInRight';?>" >
                    <div class="flex-row">
                        <div class="grid-content">
                            <h3 class="title text-color-secondary"><a href="<?php echo $item['url']; ?>" title="<?php echo _ch($item['option_10']); ?>"><?php echo _ch($item['option_10']); ?></a></h3>
                            <div class="options">
                                <?php if(!empty($item['option_36']) || !empty($item['option_37'])): ?>
                                <?php 
                                    if(!empty($item['option_36']))echo '<span class="option opt-price"><i class="icon_currency"></i>'.$options_prefix_36.price_format($item['option_36'], $lang_id).$options_suffix_36.'</span>';
                                    elseif(!empty($item['option_37']))echo '<span class="option opt-price"><i class="icon_currency"></i>'.$options_prefix_37.price_format($item['option_37'], $lang_id).$options_suffix_37.'</span>';
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
                                    <span class="opt"><?php echo _ch($val_79, '-'); ?></span>
                                <?php endif;?>
                                <span class="opt-light"><i class="icon_pin_alt"></i><?php _che($item['address']); ?></span>
                            </div>
                        </div>
                        <div class="grid"><span class="item-label text-red helper_option_3_<?php echo $helper_class_option_3;?>"><i class="icon_ribbon_alt"></i><?php echo _ch($item['option_3'], ''); ?></span></div>
                        <div class="grid-side">
                            <a href="<?php echo $item['url']; ?>" class="btn btn-custom btn-custom-secondary"><?php echo lang_check('Apply');?></a>
                        </div>
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
    </div>
</div><!-- ./ jobs listigns --> 