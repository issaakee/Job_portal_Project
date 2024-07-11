 <?php
/*
Widget-title: Slider latest Jobs
Widget-preview-image: /assets/img/widgets_preview/top_listing_slider.jpg
 */
?>

 <?php
 $CI = &get_instance();
 $CI->load->model('estate_m');
 $CI->load->model('option_m');

$last_n = 3;

$top_n_estates = $this->estate_m->get_by(array('is_activated' => 1, 'language_id'=>$lang_id), FALSE, $last_n, 'counter_views DESC');
$options_name = $this->option_m->get_lang(NULL, FALSE, $lang_id);

$top_estates_num = $last_n;
$top_estates = array();
$CI->generate_results_array($top_n_estates, $top_estates, $options_name); 
 
?>


<?php if(!empty($last_estates)):?>
<div class="section card-job-slider container container-palette card-job-carousel widget_edit_enabled">
    <div class="container">
        <div class="owl-carousel owl-carousel-custom owl-theme">
            <?php foreach($top_estates as $key=>$item): ?>
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
                <div class="card-job">
                    <div class="card-job-preview">
                        <img src="<?php echo _simg($item['thumbnail_url'], '735x465'); ?>" alt="">
                        <a href="<?php echo $item['url']; ?>" class="link"></a>
                    </div>
                    <div class="card-job-caption">
                        <div class="card-job-body">
                            <h2 class="card-job-title sw_animatable bounceIn"><a href="<?php echo $item['url']; ?>"><?php _che($item['option_10']); ?></a></h2>
                            <div class="description sw_animatable fadeInUp"><?php echo _ch($item['option_chlimit_8']); ?></div>
                            <div class="options sw_animatable moveUp">
                                <span class="opt"><?php echo _ch($item['option_4']); ?></span>
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
                        <div class="card-job-footer">
                            <a href="<?php echo $item['url']; ?>" class="btn btn-custom btn-custom-secondary sw_animatable bounceInLeft"><?php echo lang_check('Apply');?></a>
                            <a href="#" class="btn btn-clear btn-alert-clear text-red sw_animatable bounceInRight helper_option_3_<?php echo $helper_class_option_3;?>"><i class="icon_ribbon_alt"></i><?php echo _ch($item['option_3'], ''); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <a href="" class="btn-nav btn-prev sw_animatable bounceInLeft"><i class="fa fa-angle-left"></i></a>
        <a href="" class="btn-nav btn-next sw_animatable bounceInRight"><i class="fa fa-angle-right"></i></a>
    </div>
</div><!-- ./ job purpose slider --> 
<?php endif;?>