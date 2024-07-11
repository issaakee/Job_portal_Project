<?php
/*
Widget-title: Default page content with title
Widget-preview-image: /assets/img/widgets_preview/top_default_contenttitle.jpg
 */
?>
<?php if(!empty($page_body)):?>
<section class="section container container-palette section-body widget_edit_enabled">
    <div class="container">
        <h2 class="section-title">{page_title}</h2><!-- ./ section title --> 
        <div class="body">
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
</section> <!-- /. page_body -->
<?php endif;?>