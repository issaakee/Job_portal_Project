<?php
/*
Widget-title: Contact us
Widget-preview-image: /assets/img/widgets_preview/footer_contact.jpg
 */
?>
<div class="col-md-3">
    <div class="f_widget widget-contact widget_edit_enabled">
        <h2 class="title"><?php echo lang_check('Contactez Nous');?></h2><!-- ./ widget title --> 
        <div class="body">
            {settings_address_footer} <br />
            {settings_phone}<br />
            <a href="mailto:{settings_email}" title="<?php echo lang_check('Envoyez-nous un e-mail');?>">{settings_email}</a>
        </div><!-- ./ widget body --> 
    </div><!-- ./ widget contact --> 
</div>