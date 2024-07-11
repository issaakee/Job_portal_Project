<?php
/*
Widget-title: Default page content with title
Widget-preview-image: /assets/img/widgets_preview/center_default_contenttitle.jpg
 */
?>
<?php if(!empty($page_body)):?>
<div class="widget section-body no-border no-padding widget_edit_enabled">
    <div class="widget-header header-styles">
        <h2 class="title">{page_title}</h2>
    </div>
    <div class="content-box">
        {page_body}
    </div>
</div>
<script>

$('document').ready(function(){
    $(".section-body p, .section-body br").each(function(){
        if( $.trim($(this).text()) == "" ){
            $(this).remove();
        }
    });
})

</script>
<?php endif;?>