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
                        <h2 class="title"><?php _l('Edit message'); ?> #<?php echo $enquire->id; ?></h2>
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

                        <div class="form-group">
                            <label for="inputproperty_id" class="control-label"><?php _l('Estate'); ?></label>
                            <div class="controls">
                                <?php echo form_dropdown('property_id', $all_estates, set_value('property_id', $enquire->property_id), ' id="inputproperty_id" class="form-control"'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputNameSurname" class="control-label"><?php _l('Name and surname') ?></label>
                            <div class="controls">
                                <?php echo form_input('name_surname', set_value('name_surname', $enquire->name_surname), 'class="form-control" id="inputNameSurname" placeholder="' . lang_check('Name and surname') . '"') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPhone" class="control-label"><?php _l('Phone') ?></label>
                            <div class="controls">
                                <?php echo form_input('phone', set_value('phone', $enquire->phone), 'class="form-control" id="inputPhone" placeholder="' . lang_check('Phone') . '"') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputMail" class="control-label"><?php _l('Mail') ?></label>
                            <div class="controls">
                                <?php echo form_input('mail', set_value('mail', $enquire->mail), 'class="form-control" id="inputMail" placeholder="' . lang_check('Mail') . '"') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php _l('FromDate') ?></label>
                            <div class="controls">
                                <?php echo form_input('fromdate', set_value('fromdate', $enquire->fromdate), 'class="form-control datetimepicker_standard" data-format="yyyy-MM-dd"') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php _l('ToDate') ?></label>
                            <div class="controls">
                                <?php echo form_input('todate', set_value('todate', $enquire->todate), 'class="form-control datetimepicker_standard" data-format="yyyy-MM-dd"') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputMessage" class="control-label"><?php _l('Message') ?></label>
                            <div class="controls">
                                <?php echo form_textarea('message', set_value('message', $enquire->message), 'placeholder="' . lang_check('Message') . '" id="inputMessage" rows="3" class="form-control"') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress" class="control-label"><?php _l('Address') ?></label>
                            <div class="controls">
                                <?php echo form_textarea('address', set_value('address', $enquire->address), 'placeholder="' . lang_check('Address') . '" id="inputAddress" rows="3" class="form-control"') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputReaded" class="control-label"><?php _l('Readed') ?></label>
                            <div class="controls">
                                <?php echo form_checkbox('readed', '1', set_value('readed', $enquire->readed), 'id="inputReaded"') ?>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="controls">
                                <?php echo form_submit('submit', lang('Save'), 'class="btn btn-primary"') ?>
                                <?php if (isset($enquire->mail)): ?>
                                    <a href="mailto:<?php echo $enquire->mail ?>?subject=<?php echo lang_check('Reply on question for real estate') ?>: <?php echo $all_estates[$enquire->property_id] ?>&amp;body=<?php echo $enquire->message ?>" class="btn btn-default" ><?php echo lang_check('Reply to email') ?></a>
                                <?php endif; ?>
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