<div class="widget widget-rsm no-border no-padding">
    <div class="jcompany-card pt-15">
        <div class="thumbnail border">
            <?php
                $company_image ='assets/img/pic/loglo-company.png';
                $company_title ='';
                $company_link ='#';
            
                if(isset($estate_data_option_74) && !empty($estate_data_option_74))
                {
                    //Fetch repository
                    $rep_id = $estate_data_option_74;
                    $file_rep = $this->file_m->get_by(array('repository_id'=>$rep_id));
                    $rep_value = '';
                    if(sw_count($file_rep))
                    {
                        $company_image = base_url('files/'.$file_rep[0]->filename);
                    }
                }
            
                if(isset($estate_data_option_67) && !empty($estate_data_option_67))
                {
                    $company_title =$estate_data_option_67;
                }
            
                if(isset($estate_data_option_69) && !empty($estate_data_option_69))
                {
                    $company_title =$estate_data_option_69;
                }
                ?>
            <a href="<?php echo $company_link;?>" title='<?php echo $company_title;?>'><img src="<?php echo $company_image;?>" alt="<?php echo $company_title;?>" /></a></div>
        <div class="body">
            <h3 class="title">{page_title}</h3>
            <div class="options">
                <?php if(!empty($estate_data_option__36) || !empty($estate_data_option_37)): ?>
                <?php 
                    if(!empty($estate_data_option_36))echo '<span class="opt"><i class="icon_currency"></i>'.$options_prefix_36.price_format($estate_data_option_36, $lang_id).$options_suffix_36.'</span>';
                    if(!empty($estate_data_option_37))echo '<span class="opt"><i class="icon_currency"></i>'.$options_prefix_37.price_format($estate_data_option_37, $lang_id).$options_suffix_37.'</span>';
                ?>
                <?php endif; ?>
                <span class="opt-light"><i class="icon_pin_alt"></i><?php echo _ch($estate_data_address);?></span>
            </div>
            {has_agent}
            <div class="subtext"><?php echo lang_check('from');?> <a href="{agent_url}" class="text-color-secondary"><b>{agent_name_surname}</b></a></div>
            {/has_agent}
            <div class="subtext d-block d-lg-none"><span class="item-label text-red"><i class="icon_ribbon_alt"></i><?php _che($estate_data_option_3,'');?></span></div>
        </div>
    </div>
    <div class="rsm-box editor_content">
        <h3 class="rsm-title"><?php echo lang_check('About the Job');?></h3>
        <div class="decription">
            <?php _che($estate_data_option_17, '<p class="alert alert-success">'.lang_check('Not available').'</p>'); ?>
        </div>
    </div>
</div><!-- ./ widget- job open --> 