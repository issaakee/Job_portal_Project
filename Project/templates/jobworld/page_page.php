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
        <main class="container container-palette pt-75 m30">
            <div class="container">
                <div class="wraper-row">
                    <div class="column-content">
                        <div class="box-post-open m15">
                            <div class="post-open-thumbnail">
                                <?php if(isset($page_images) && !empty($page_images)):?>
                                <img src="<?php _che($page_images[0]->url);?>" alt="" />
                                <?php endif;?>
                            </div>
                            <div class="header">
                                <h1 class="title">{page_title}</h1>
                                <div class="meta-tags">
                                    <span><i class="fa fa-calendar"></i>
                                    <?php
                                    $CI = &get_instance();
                                    $CI->load->model('page_m');
                                    $page = $CI->page_m->get_lang($page_id);
                                    $timestamp = strtotime($page->date);
                                    $m = strtolower(date("F", $timestamp));
                                    echo lang_check('cal_' . $m) . ' ' . date("j, Y", $timestamp);
                                    ?>
                                    </span>
                                </div>
                            </div>
                            <div class="body">
                                {page_body}
                                {has_page_documents}
                                <h5><?php _l('Filerepository');?></h5>
                                <ul>
                                {page_documents}
                                <li>
                                    <a href="{url}">{filename}</a>
                                </li>
                                {/page_documents}
                                </ul>
                                {/has_page_documents}
                            </div>
                            <div class="footer">
                                <div class="left-side tags">
                                    <?php if(!empty($page->{'keywords_'.$lang_id})):?>
                                    <b><?php echo lang_check('Tags');?>:</b>
                                    <?php 
                                        $tags = explode(',', $page->{'keywords_'.$lang_id});
                                        foreach ($tags as $key=>$val): ?>
                                        <?php 
                                        $s = ',';
                                        if(sw_count($tags) == $key+1)$s='';
                                        ?>
                                        <a href="#"><?php echo trim($val).$s; ?></a>
                                    <?php endforeach; ?>
                                    <?php endif;?>
                                </div>
                                <div class="right-side">
                                    <ul class="social-content-btns">
                                        <li><a href="https://www.facebook.com/share.php?u={page_current_url}&title={settings_websitetitle}"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="https://twitter.com/home?status={settings_websitetitle}%20{page_current_url}"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- ./ widget post description --> 
                    </div><!-- ./ content --> 
                    <div class="column-sidebar">
                        <?php _widget('right_calendar');?>
                        <?php _widget('right_recentproperties');?>
                    </div><!-- ./ sidebar --> 
                </div>
            </div>
        </main>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
    </body>
</html>