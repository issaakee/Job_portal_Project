<?php
/*
Widget-title: Default page content
Widget-preview-image: /assets/img/widgets_preview/center_default_content.jpg
 */
?>
<?php if(!empty($page_body)):?>
<div class="widget section-body widget_edit_enabled">
    <div class="content-box">
        {page_body}
    </div>
</div>
<?php endif;?>