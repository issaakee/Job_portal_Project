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
                        <h2 class="title"><?php echo lang_check('Myreservations'); ?></h2>
                    </div> <!-- ./ title --> 
                    <div class="content-box">
                        <div class="validation m25">
                            <?php if($this->session->flashdata('message')):?>
                            <?php echo $this->session->flashdata('message')?>
                            <?php endif;?>
                            <?php if($this->session->flashdata('error')):?>
                            <p class="alert alert-error"><?php echo $this->session->flashdata('error')?></p>
                            <?php endif;?>
                        </div>
                        <table class="table table-striped data_table">
                            <thead>
                                <th>#</th>
                                <th><?php echo lang('Dates');?></th>
                                <!-- Dynamic generated -->
                                <?php foreach($this->option_m->get_visible($content_language_id) as $row):?>
                                <th data-breakpoints="xs sm md"  data-type="html"><?php echo $row->option?></th>
                                <?php endforeach;?>
                                <!-- End dynamic generated -->
                                <th data-priority="1" data-orderable="false"><?php echo lang('Edit');?></th>
                                <th data-priority="1" data-orderable="false"><?php echo lang('Delete');?></th>
                            </thead>
                            <tbody>
                                <?php if(sw_count($estates)): foreach($estates as $estate):?>
                                <tr>
                                    <td><?php echo $estate->id?></td>
                                    <td>
                                    <?php echo anchor('frontend/viewreservation/'.$lang_code.'/'.$estate->id, date('Y-m-d', strtotime($estate->date_from)).' - '.date('Y-m-d', strtotime($estate->date_to)))?>
                                    <?php if($estate->is_confirmed == 0):?>
                                    &nbsp;<span class="label label-important"><?php echo lang_check('Not confirmed')?></span>
                                    <?php else: ?>
                                    &nbsp;<span class="label label-success"><?php echo lang_check('Confirmed')?></span>
                                    <?php endif;?>
                                    </td>
                                    <!-- Dynamic generated -->
                                    <?php foreach($this->option_m->get_visible($content_language_id) as $row):?>
                                    <td>
                                    <?php echo isset($options[$estate->property_id][$row->option_id])?$options[$estate->property_id][$row->option_id]:'-'?></td>
                                    <?php endforeach;?>
                                    <!-- End dynamic generated -->
                                    <td><?php echo anchor('frontend/viewreservation/'.$lang_code.'/'.$estate->id, '<i class="icon-shopping-cart icon-white"></i> '.lang_check('View/Pay'), array('class'=>'btn btn-info'))?></td>
                                    <td><?php if($estate->is_confirmed == 0):?><?php echo anchor('frontend/deletereservation/'.$lang_code.'/'.$estate->id, '<i class="icon-remove"></i> '.lang('Delete'), array('onclick' => 'return confirm(\''.lang_check('Are you sure?').'\')', 'class'=>'btn btn-danger'))?><?php endif;?></td>
                                </tr>
                                <?php endforeach;?>
                                <?php else:?>
                                <?php endif;?>      
                            </tbody>
                        </table>
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