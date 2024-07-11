<?php
/*
Widget-title: Packadges
Widget-preview-image: /assets/img/widgets_preview/bottom_packadges.jpg
 */
?>

<?php if(file_exists(APPPATH.'controllers/admin/packages.php')): ?>
<?php
$CI =&get_instance();
$CI->load->model('packages_m');
$packages = $CI->packages_m->get();

$CI->load->model('conversions_m');
$conversion_table = $CI->conversions_m->get_conversions_table();
// Generate options
$options = array();
if(sw_count($conversion_table) > 0)
foreach($conversion_table['code'] as $key=>$row)
{
    $options[$key] = $key;
    if(!empty($row->currency_symbol))
        $options[$key].=' ('.$row->currency_symbol.')';

}

?>
<?php if(sw_count($packages)):?>
<div class="section section-plans widget_edit_enabled">
    <div class="container">
        <div class="col-12">
            <div class="plans-grid">
            <?php
            if(sw_count($packages)): foreach($packages as $package):
            ?>
                <div class="item">
                    <div class="body">
                        <div class="type"><?php echo $package->package_name; ?></div>
                        <div class="price">
                            <?php
                            $code = $package->currency_code;
                                if(isset($conversion_table['code'][$code])) {
                                    $code = $conversion_table['code'][$code]->currency_symbol;
                                }
                            ?>
                            <?php _che($code);?><?php echo rtrim(rtrim($package->package_price,0),'.'); ?>
                        </div>
                        <ul class="list-purpose">
                            <li>
                                <span class="<?php if(!$package->auto_activation):?>disabled<?php endif;?>">
                                <?php if(!$package->auto_activation):?>
                                <i class="icon_close"></i>
                                <?php endif;?>
                                <?php echo lang_check('Free property activation');?> 
                                </span>
                            </li>
                            <li>
                                <span class="<?php if(!$package->package_days):?>disabled<?php endif;?>">
                                <?php if(!$package->package_days):?>
                                <i class="icon_close"></i>
                                <?php endif;?>
                                <?php if($package->package_days):?>
                                <?php echo $package->package_days?>x
                                <?php endif;?>
                                <?php echo lang_check('Days limit');?> 
                                </span>
                            </li>
                            <li>
                                <span class="<?php if(!$package->num_listing_limit):?>disabled<?php endif;?>">
                                <?php if(!$package->num_listing_limit):?>
                                <i class="icon_close"></i>
                                <?php endif;?>
                                <?php if($package->num_listing_limit):?>
                                <?php echo $package->num_listing_limit?>x
                                <?php endif;?>
                                <?php echo lang_check('Listings limit');?> 
                                </span>
                            </li>
                            <li>
                                <span class="<?php if(!$package->num_featured_limit):?>disabled<?php endif;?>">
                                <?php if(!$package->num_featured_limit):?>
                                <i class="icon_close"></i>
                                <?php endif;?>
                                <?php if($package->num_featured_limit):?>
                                <?php echo $package->num_featured_limit?>x
                                <?php endif;?>
                                <?php echo lang_check('Free featured limit');?> 
                                </span>
                            </li>
                            <?php if(config_item('enable_num_images_listing')): ?>
                            <li>
                                <span class="<?php if(!$package->num_featured_limit):?>disabled<?php endif;?>">
                                <?php if(!$package->num_featured_limit):?>
                                <i class="icon_close"></i>
                                <?php endif;?>
                                <?php if($package->num_featured_limit):?>
                                <?php echo $package->num_featured_limit?>x
                                <?php endif;?>
                                <?php echo lang_check('Num images limit');?> 
                                </span>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="footer"><a href="#" class="btn btn-custom btn-custom-secondary">Buy Now</a></div>
                </div>
            <?php endforeach;?>
            </div>
            <?php endif;?>  
        </div>
    </div>
</div>
<?php endif;?>
<?php endif;?>