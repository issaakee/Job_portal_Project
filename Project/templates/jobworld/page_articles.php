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
        <main class="container container-palette pt-75">
            <div class="container">
                <div class="wraper-row">
                    <div class="column-content">
                        <?php _widget('center_default_contenttitle'); ?>
                        <?php _widget('center_imagegallery'); ?>
                        <div class="results-grid bottom-liner m95 property_content_position">
                            <?php foreach ($news_articles as $key => $row): ?>
                            <div class="grid-post">
                                <div class="preview">
                                    <a href="<?php echo site_url($lang_code . '/' . $row->id . '/' . url_title_cro($row->title)); ?>">
                                        <?php if (file_exists(FCPATH . 'files/thumbnail/' . $row->image_filename)): ?>
                                            <img src="<?php echo _simg('files/' . $row->image_filename, '850x500', TRUE); ?>" alt="<?php _che($row->title); ?>" />
                                        <?php else: ?>
                                            <img src="assets/img/no_image.jpg" alt="new-image">
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="caption">
                                    <div class="header">
                                        <h2 class="title"><a href="<?php echo site_url($lang_code . '/' . $row->id . '/' . url_title_cro($row->title)); ?>"><?php echo $row->title; ?></a></h2>
                                        <div class="meta-tags">
                                            <span><i class="fa fa-calendar"></i>
                                            <?php
                                            $timestamp = strtotime($row->date);
                                            $m = strtolower(date("F", $timestamp));
                                            echo lang_check('cal_' . $m) . ' ' . date("j, Y", $timestamp);
                                            ?>
                                            </span>
                                            <?php foreach (explode(',', $row->keywords) as $val): ?>
                                               <span><?php echo trim($val); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="description"><?php echo $row->description; ?></div>
                                    <div class="footer">
                                        <a href="<?php echo site_url($lang_code . '/' . $row->id . '/' . url_title_cro($row->title)); ?>" class="btn btn-custom btn-custom-secondary"><?php echo lang_check('Read More');?></a>
                                    </div>
                                </div>
                            </div> <!-- ./ post --> 
                            <?php endforeach; ?>
                        </div>  <!-- ./ posts resullts --> 
                    </div> <!-- ./ content --> 
                    <div class="column-sidebar">
                        <?php _widget('right_calendar');?>
                    </div><!-- ./ sidebar --> 
                </div>
            </div>
        </main>
        <?php _widget('top_banner2_html'); ?>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
    </body>
</html>