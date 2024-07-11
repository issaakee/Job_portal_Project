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
                        <h2 class="title"><?php echo lang_check('My rates and availability'); ?></h2>
                    </div> <!-- ./ title --> 
                    <div class="content-box">
                        <div class="validation m25"> 
                            <?php echo anchor('rates/rate_edit/'.$lang_code.'#content', '<i class="icon-plus icon-white"></i>&nbsp;&nbsp;'.lang_check('Add rate'), 'class="btn btn-info"')?>
                        </div>
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
                                    <th data-breakpoints="xs sm" data-type="html"><?php echo lang_check('From date');?></th>
                                    <th data-breakpoints="xs sm" data-type="html"><?php echo lang_check('To date');?></th>
                                    <th data-type="html"><?php echo lang_check('Property');?></th>
                                    <th data-priority="1" data-orderable="false"><?php echo lang_check('Edit');?></th>
                                    <th data-priority="1" data-orderable="false"><?php echo lang_check('Delete');?></th>
                                </thead>
                               <?php if(sw_count($listings)): foreach($listings as $listing_item):?>
                                    <tr>
                                        <td><?php echo $listing_item->id; ?></td>
                                        <td><?php echo $listing_item->date_from; ?></td>
                                        <td><?php echo $listing_item->date_to; ?></td>
                                        <td><?php echo $properties[$listing_item->property_id]; ?></td>
                                        <td><?php echo btn_edit('rates/rate_edit/'.$lang_code.'/'.$listing_item->id)?></td>
                                        <td><?php echo btn_delete('rates/rate_delete/'.$lang_code.'/'.$listing_item->id)?></td>
                                    
                                    </tr>
                                <?php endforeach;?>
                                <?php else:?>
                                <?php endif;?>       
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