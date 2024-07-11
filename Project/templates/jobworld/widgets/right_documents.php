<?php
/*
Widget-title: Documents
Widget-preview-image: /assets/img/widgets_preview/right_documents.jpg
 */
?>
<?php if(isset($page_documents) && !empty($page_documents)):?>
<div class="widget widget-files widget_edit_enabled">
    <div class="widget-header">
        <h2 class="title black light"><?php echo lang_check('Documents');?></h2>
    </div>
        <ul class="documents-list">
        <?php foreach ($page_documents as $val):?>
        <li>
            <a href="<?php _che($val->url);?>">
                <?php if(file_exists(FCPATH.'/templates/'.$settings_template.'/assets/img/icons/filetype/'.get_file_extension($val->filename).'.png')):?>
                <img src="assets/img/icons/filetype/<?php echo get_file_extension($val->filename);?>.png"/>
                <?php endif;?>
                <?php _che($val->filename);?>
            </a>
        </li>
        <?php endforeach;?>
        </ul>
</div> <!-- ./ widget --> 
<?php endif;?>