<?php
/*
Widget-title: Recent Jobs
Widget-preview-image: /assets/img/widgets_preview/right_recentproperties.jpg
 */
?>
<?php if(!empty($last_estates)):?>
<div class="widget widget-posts widget_edit_enabled">
    <div class="widget-header">
        <h2 class="title"><?php echo lang_check('Recent Jobs'); ?></h2>
    </div>
    <div class="w-posts-list">
        <?php foreach($last_estates as $item): ?>
        <div class="item">
            <div class="preview"><a href="<?php echo $item['url']; ?>"><img src="<?php echo _simg($item['thumbnail_url'], '128x128'); ?>" alt=""></a></div>
            <div class="body">
                <h3 class="title"><a href="<?php echo $item['url']; ?>"><?php echo _ch($item['option_10']);?></a></h3>
                <?php if(!empty($item['option_36']) || !empty($item['option_37'])): ?>
                <?php 
                    if(!empty($item['option_36']))echo '<div class="data price">'.$options_prefix_36.price_format($item['option_36'], $lang_id).$options_suffix_36.'</div>';
                    elseif(!empty($item['option_37']))echo '<div class="data price">'.$options_prefix_37.price_format($item['option_37'], $lang_id).$options_suffix_37.'</div>';
                ?>
                <?php endif; ?>
                <div class="data">
                    <?php
                        $timestamp = strtotime($item['date']);
                        $m = strtolower(date("F", $timestamp));
                        echo lang_check('cal_' . $m) . ' ' . date("j, Y", $timestamp);
                    ?>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>
<?php endif;?>