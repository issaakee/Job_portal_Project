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
                            <?php if(file_exists(APPPATH.'controllers/admin/news.php')):?> 
                            <?php foreach ($news_module_all as $key => $row): ?>
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
                            <nav class="text-center">
                                <div class="pagination news">
                                    <?php echo $news_pagination; ?>
                                </div>
                            </nav>
                            <?php endif;?>               
                        </div>  <!-- ./ posts resullts --> 
                    </div> <!-- ./ content --> 
                    <div class="column-sidebar">
                        <?php if(file_exists(APPPATH.'controllers/admin/news.php')):?>
                        <?php if (true): ?>
                        <div class="widget widget-search-box">
                            <div class="content-box">
                                <form action="#" class="local-form">
                                    <div class="input-group input-with-search color-primary clearfix">
                                        <input type="text" id="search_news" name="search-agent" value="" class="form-control" placeholder="<?php _l('Search');?>">
                                        <button type="submit"  id="btn-search_news" class="input-group-addon"><i class="fa fa-search icon-white"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php _widget('right_calendar');?>
                        <?php if(file_exists(APPPATH.'controllers/admin/news.php')):?>
                        <?php if(!empty($categories)):?>
                        <div class="widget">
                            <div class="widget-header">
                                <h2 class="title"><?php echo lang_check('Categories');?></h2>
                            </div>
                            <ul class="list-pins">
                                <?php foreach ($categories as $id => $category_name): ?>
                                    <?php if ($id != 0): ?>
                                        <li><a href="{page_current_url}?cat=<?php echo $id; ?>#news"><?php echo $category_name; ?></a></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div><!-- ./ widget --> 
                        <?php endif; ?>
                        <?php endif; ?>
                    </div><!-- ./ sidebar --> 
                </div>
            </div>
        </main>
        <?php _widget('top_banner2_html'); ?>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
        <script>
            $(document).ready(function () {
                $("#btn-search_news").click(function (e) {
                    e.preventDefault();
                    if ($('#search_news').val().length > 2 || $('#search_news').val().length == 0)
                    {
                        $.post('<?php echo $ajax_news_load_url; ?>', {search: $('#search_news').val()}, function (data) {
                            $('.list-result').html(data.print);
                            console.log('list-result')
                            reloadElements();
                        }, "json");
                    }
                });
            });
        </script>
    </body>
</html>