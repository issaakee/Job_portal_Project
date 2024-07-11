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
                        <h2 class="title"><?php echo lang_check('My messages'); ?></h2>
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
                        <table class="table table-striped data_table" data-sorting="true">
                            <thead>
                                <th>#</th>
                                <th data-type="html"><?php _l('Date');?></th>
                                <th data-breakpoints="xs sm" data-type="html"><?php _l('Mail');?></th>
                                <th data-breakpoints="xs sm" data-type="html"><?php _l('Message');?></th>
                                <th data-breakpoints="xs sm" data-type="html"><?php _l('Estate');?></th>
                                <th data-priority="1" data-orderable="false"><?php _l('Edit');?></th>
                                <th data-priority="1" data-orderable="false"><?php _l('Delete');?></th>
                            </thead>
                            <?php if(sw_count($listings)): foreach($listings as $listing_item):?>
                                <tr>
                                    <td><?php echo $listing_item->id; ?>&nbsp;&nbsp;<?php echo $listing_item->readed == 0? '<span class="label label-warning">'.lang_check('Not readed').'</span>':''?></td>
                                    <td><?php echo $listing_item->date; ?></td>
                                    <td><?php echo $listing_item->mail; ?></td>
                                    <td><?php echo $listing_item->message; ?></td>
                                    <td><?php echo $all_estates[$listing_item->property_id]; ?></td>
                                    <td><?php echo btn_edit('fmessages/edit/'.$lang_code.'/'.$listing_item->id)?></td>
                                    <td><?php echo btn_delete('fmessages/delete/'.$lang_code.'/'.$listing_item->id)?></td>
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