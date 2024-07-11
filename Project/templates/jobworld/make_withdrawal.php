<!DOCTYPE html>
<html lang="en">
    <head>
        <?php _widget('head');?>
    </head>
    <body class="<?php _widget('custom_paletteclass'); ?>">
        <header>
             <?php _widget('custom_header_menu-for-loginuser');?>
            <?php _widget('header_mainmenu'); ?>
        </header><!-- ./ header --> 
        <?php _widget('top_pagetitle'); ?>
        <div class="section section-articles section-results-articles container container-palette">
            <div class="container">
                <div class="row">
                <div class="widget widget-submit">
                    <div class="widget-header header-styles">
                        <h2 class="title">
                            <?php echo $page_title; ?>
                            <span>
                            <?php _l('You can withdraw up to:'); ?>
                            <?php
                                $index=0;
                                $currencies = array(''=>'');

                                if(sw_count($withdrawal_amounts) == 0)echo '0';

                                foreach($withdrawal_amounts as $currency=>$amount)
                                {
                                    $currencies[$currency] = $currency;
                                    echo '<span class="label label-success">'.$amount.' '.$currency.'</span>&nbsp;';
                                }
                            ?>
                        </h2>
                    </div> <!-- ./ title --> 
                    <div class="validation m25">
                        <?php echo validation_errors()?>
                        <?php if($this->session->flashdata('message')):?>
                        <?php echo $this->session->flashdata('message')?>
                        <?php endif;?>
                        <?php if($this->session->flashdata('error')):?>
                        <p class="alert alert-error"><?php echo $this->session->flashdata('error')?></p>
                        <?php endif;?>
                    </div>
                    <div class="widget-content">
                        <?php echo form_open(NULL, array('class' => 'job-form default jborder', 'role'=>'form'))?>                    
                                <div class="form-group form-group row">
                                  <label class="col-lg-2 control-label"><?php _l('Amount')?></label>
                                  <div class="col-lg-10 controls">
                                  <div class="input-append">
                                    <?php echo form_input('amount', $this->input->post('amount') ? $this->input->post('amount') : '', 'class="form-control"'); ?>
                                  </div>
                                  </div>
                                </div>

                                <div class="form-group form-group row">
                                  <label class="col-lg-2 control-label"><?php _l('Currency code')?></label>
                                  <div class="col-lg-10 controls">
                                    <?php echo form_dropdown('currency', $currencies, $this->input->post('currency') ? $this->input->post('currency') : '', 'class="form-control"')?>
                                  </div>
                                </div>

                                <div class="form-group form-group row">
                                  <label class="col-lg-2 control-label"><?php _l('Withdrawal email')?></label>
                                  <div class="col-lg-10 controls">
                                  <div class="input-append">
                                    <?php echo form_input('withdrawal_email', $this->input->post('withdrawal_email') ? $this->input->post('withdrawal_email') : '', 'class="form-control"'); ?>
                                  </div>
                                  </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                  <div class="controls">
                                    <?php echo form_submit('submit', lang_check('Request withdrawal'), 'class="btn btn-primary"')?>
                                    <a href="<?php echo site_url('rates/payments/'.$lang_code)?>#content" class="btn btn-default" type="button"><?php echo lang_check('Cancel')?></a>
                                  </div>
                                </div>
                        <?php echo form_close() ?>
                    </div>
                </div> <!-- ./ widget-submit --> 
                
                </div>
            </div>
        </div><!-- ./ section recent articles --> 
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
    </body>
</html>