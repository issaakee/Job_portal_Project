<?php 
if (empty($news_module_latest_5)){
    $CI =& get_instance();
    if(file_exists(APPPATH.'controllers/admin/news.php'))
    {
        $news_module_latest_5 = $CI->page_m->get_lang(NULL, FALSE, $lang_id, 
                                                          array('type'=>'MODULE_NEWS_POST'), 
                                                          5, 0, 'date_publish DESC');
    }
    else
    {
        $news_module_latest_5 = $CI->page_m->get_lang(NULL, FALSE, $lang_id, 
                                                          array('type'=>'ARTICLE'), 
                                                          5, 0, 'date DESC');
    }
} 
?>


<?php if(!empty($news_module_latest_5)):?>
<div class="widget widget-posts widget_edit_enabled">
    <div class="widget-header">
        <h2 class="title"><?php echo lang_check('Recent Posts'); ?></h2>
    </div>
    <div class="w-posts-list">
        <?php foreach($news_module_latest_5 as $row): ?>
        <div class="item">
            <div class="preview"><a href="<?php echo site_url($lang_code.'/'.$row->id); ?>">
                <?php if(isset($row->image_filename)):?>
                 <img  src="<?php echo _simg('files/'.$row->image_filename, '128x128'); ?>" />
                <?php else:?>
                  <img  src="assets/img/no_image.jpg" />
                <?php endif;?>
            </a></div>
            <div class="body">
                <h3 class="title"><a href="<?php echo site_url($lang_code.'/'.$row->id); ?>"><?php echo $row->title; ?></a></h3>
                <div class="data">
                    <?php echo date("Y-m-d", strtotime($row->date_publish)); ?>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>
<?php endif;?>