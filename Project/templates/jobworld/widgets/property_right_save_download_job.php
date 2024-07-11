<div class="widget widget-contact">
    <?php if(!empty($agent_phone)):?>
        <h2 class="contact"><?php echo lang_check('Need help? Call');?> <?php _che($agent_phone);?></h2>
    <?php endif;?>
    <div class="actions">
        <?php if(file_exists(APPPATH.'libraries/Pdf.php')) : ?>
        <a href="<?php echo site_url('api/pdf_export/'.$property_id.'/'.$lang_code) ;?>" class="btn btn-custom btn-custom-secondary"><?php echo lang_check('Download Vacancy
');?></a>
        <?php endif;?>
        
        <?php if(file_exists(APPPATH.'controllers/admin/favorites.php')):?>
        <?php
            $favorite_added = false;
            if(sw_count($not_logged) == 0)
            {
                $CI =& get_instance();
                $CI->load->model('favorites_m');
                $favorite_added = $CI->favorites_m->check_if_exists($this->session->userdata('id'), 
                                                                    $estate_data_id);
                if($favorite_added>0)$favorite_added = true;
            }
        ?>
        <a href="#" id="add_to_favorites" class="btn btn-custom btn-custom-default" style="<?php echo ($favorite_added)?'display:none;':''; ?>"><i class="ion-heart"></i><?php echo lang_check('Save Vacancy');?></a>  
        <a href="#" id="remove_from_favorites" class="btn btn-custom btn-custom-default"  style="<?php echo (!$favorite_added)?'display:none;':''; ?>"><i class="ion-heart text-color-primary"></i><?php echo lang_check('Remove Vacancy');?></a>  
        <?php endif; ?>
        <?php _widget('custom_property_report');?>
    </div>
</div><!-- ./ widget --> 