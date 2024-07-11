 <?php
/*
Widget-title: Recent reviews
Widget-preview-image: /assets/img/widgets_preview/top_reviews.jpg
 */
?>

<?php

if(!file_exists(APPPATH.'controllers/admin/swin_reviews.php'))
{
    return false;
}

$CI = &get_instance();
$CI->load->model('reviews_m');
$reviews_all = $CI->reviews_m->get_listing(array('message !='=>''));

if(empty($reviews_all)) {
    return false;
}
?>

<div class="section section-reviews container container-palette bg-mask widget_edit_enabled">
    <div class="container">
        <div id="owl-carousel" class="owl-carousel owl-theme owl-reviews-corousel">
            <?php $i=0; foreach ($reviews_all as $key => $value):?>
            <?php if ($i>5) break; ?>
            <div class="item">
                <div class="header">
                    <a href="<?php echo site_url('profile/'.$value['user_id'].'/'.$lang_code);?>"  class="review-thumbnail">
                        <?php if(isset($value['image_user_filename']) && file_exists(FCPATH.'files/thumbnail/'.$value['image_user_filename'])): ?>
                        <img src="<?php echo base_url('files/thumbnail/'.$value['image_user_filename']); ?>" alt="" class="rounded-circle" />
                        <?php else: ?>
                        <img src="assets/img/user-agent.png"  alt="" class="rounded-circle"/>
                        <?php endif; ?>
                    </a>
                </div>
                <div class="body"><?php _che($value['message']);?></div>
                <div class="footer">
                    <a href="<?php echo site_url('profile/'.$value['user_id'].'/'.$lang_code);?>"><?php _che($value['name_surname']);?></a>, Amazon Manager
                </div><!-- ./ review --> 
            </div>
            <?php $i++; endforeach;?>
        </div>
    </div>
</div><!-- ./ section reviews -->