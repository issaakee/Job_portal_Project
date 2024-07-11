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
                        <h2 class="title"><?php echo lang_check('Saved jobs'); ?></h2>
                    </div> <!-- ./ title --> 
                    <table class="table table-striped data_table">
                        <thead>
                            <th>#</th>
                            <th data-breakpoints="xs sm md" data-type="html"><?php echo lang_check('Property');?></th>
                            <th data-breakpoints="xs sm md" data-type="html" ><?php echo lang_check('Language');?></th>
                            <th data-priority="1" data-orderable="false"><?php echo lang_check('Open');?></th>
                            <th data-priority="1" data-orderable="false"><?php echo lang_check('Delete');?></th>
                        </thead>
                        <?php if(sw_count($listings)): foreach($listings as $listing_item):?>
                            <tr>
                                <td><?php echo $listing_item->id; ?></td>
                                <td><?php echo $properties[$listing_item->property_id]; ?></td>
                                <td><?php echo '['.strtoupper($listing_item->lang_code).']'; ?></td>
                                <td>
                                <a href="<?php echo site_url($listing_uri.'/'.$listing_item->property_id.'/'.$listing_item->lang_code); ?>" class="btn"><i class="icon-white icon-search"></i><?php echo lang_check('Open');?></a>
                                </td>
                                <td><?php echo btn_delete('ffavorites/myfavorites_delete/'.$lang_code.'/'.$listing_item->id)?></td>
                            </tr>
                            <?php endforeach;?>
                        <?php else:?>
                        <?php endif;?>   
                    </table>
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