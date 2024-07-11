<?php
/*
Widget-title: Subscribe form
Widget-preview-image: /assets/img/widgets_preview/footer_subscribe.jpg
 */
?>
<div class="col-md-3">
    <div class="f_widget widget-subscribe widget_edit_enabled">
        <h2 class="title"><?php echo lang_check('Newsletter');?></h2><!-- ./ widget title --> 
        <div class="body">
            <form action="#sw_footer_subscribe_form" method="POST" class="subscribe-form" id="sw_footer_subscribe_form">
                <div class="config" data-url="<?php echo site_url('api/subscribe');?>"></div>
                <div class="form-group-subscribe">
                    <button type="submit" class="btn btn-subscribe btn-custom btn-custom-secondary"><i class="icon_mail_alt"></i></button>
                    <input name="subscriber_email" required type="email" class="form-control" placeholder="<?php echo lang_check('Enter Your Email');?>" />
                </div> 
            </form>
        </div><!-- ./ widget body --> 
    </div><!-- ./ widget subscribe --> 
</div>