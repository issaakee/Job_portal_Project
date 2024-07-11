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
        <?php _widget('top_default_contenttitle'); ?>
        <?php _widget('bottom_imagegallery'); ?>
        <div class="section section-articles section-results-articles container container-palette">
            <div class="container">
                <?php if(file_exists(APPPATH.'controllers/admin/showroom.php')):?>
                <div class="row row-flex results-default property_content_position">
                    <?php foreach ($showroom_module_all as $key => $row): ?>
                    <div class="col-md-4">
                        <div class="thumbnail thumbnail-article">
                            <?php if(file_exists(FCPATH.'files/thumbnail/'.$row->image_filename)):?>
                            <img src="<?php echo _simg('files/'.$row->image_filename,  '799x405', TRUE); ?>" class="preview"  alt="<?php _che($row->title);?>" />
                            <?php else:?>
                                <img src="assets/img/no_image.jpg" alt="new-image" class="preview" >
                            <?php endif;?>
                            <div class="body">
                                <div class="top">
                                    <?php
                                    $timestamp = strtotime($row->date);
                                    $m = strtolower(date("F", $timestamp));
                                    echo lang_check('cal_' . $m) . ' ' . date("j, Y", $timestamp);
                                    ?>
                                </div>
                                <h3 class="title"><a href="<?php echo site_url('showroom/'.$row->id.'/'.$lang_code); ?>"><?php echo $row->title; ?></a></h3>
                            </div>
                            <div class="footer"><a href="<?php echo site_url('showroom/'.$row->id.'/'.$lang_code); ?>" class="btn btn-more"><?php echo lang_check('Read More');?><i class="arrow_carrot-right"></i></a></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <nav class="text-center">
                        <div class="pagination news">
                            <?php echo $showroom_pagination; ?>
                        </div>
                    </nav>
                </div><!-- ./ articles grid --> 
                <?php endif;?>
            </div>
        </div><!-- ./ section recent articles --> 
        <?php _widget('top_banner2_html');?>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
    </body>
</html>