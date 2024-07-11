<?php
/*
Widget-title: Recent Articles
Widget-preview-image: /assets/img/widgets_preview/top_recent_articles.jpg
 */
?>
<?php if(isset($news_module_latest_5) && !empty($news_module_latest_5)):?>
<div class="section section-articles container container-palette widget_edit_enabled">
    <div class="container">
        <h2 class="section-title"><?php echo lang_check('Recent Articles');?></h2><!-- ./ section title --> 
        <div class="row row-flex results-default">
            <?php  $i=0; foreach($news_module_latest_5 as $key=>$row):?> 
            <?php if ($i>3) break; ?>
            <div class="col-md-4">
                <div class="thumbnail thumbnail-article sw_animatable wiggle">
                    <img src="<?php echo _simg('files/'.$row->image_filename, '630x360'); ?>" alt="" class="preview" />
                    <div class="body">
                        <div class="top">
                            Andy Green on 
                            <?php
                            $timestamp = strtotime($row->date);
                            $m = strtolower(date("F", $timestamp));
                            echo lang_check('cal_' . $m) . ' ' . date("j, Y", $timestamp);
                            ?>
                        </div>
                        <h3 class="title">
                            <a href="<?php echo site_url($lang_code.'/'.$row->id.'/'.url_title_cro($row->title)); ?>">
                                <?php echo $row->title; ?>
                            </a>
                        </h3>
                    </div>
                    <div class="footer"><a href="<?php echo site_url($lang_code.'/'.$row->id.'/'.url_title_cro($row->title)); ?>" class="btn btn-more"><?php echo lang_check('Read More');?><i class="arrow_carrot-right"></i></a></div>
                </div>
            </div>
            <?php $i++; endforeach;?>
        </div><!-- ./ articles grid --> 
    </div>
</div><!-- ./ section recent articles --> 
<?php endif;?>