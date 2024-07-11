<div class="widget widget-contact" id="form">
    <h2 class="contact"><?php echo lang_check('Apply Job');?></h2>
    <div class="actions">
            <form method="post" class="job-form default jborder" action="{page_current_url}#form">
                <input type="hidden" name="form" value="contact" />
                <div class="validation m25">
                    {validation_errors} {form_sent_message}
                </div>
                <!-- The form name must be set so the tags identify it -->
                <input type="hidden" name="form" value="contact" />

                <div class="form-group {form_error_firstname}">
                    <input class="form-control" id="firstname" name="firstname" type="text" placeholder="{lang_FirstLast}" value="{form_value_firstname}" />
                </div>
                <div class="form-group {form_error_email}">
                    <input class="form-control" id="email" name="email" type="text" placeholder="{lang_Email}" value="{form_value_email}" />
                </div>
                <div class="form-group {form_error_phone}">
                    <input class="form-control" id="phone" name="phone" type="text" placeholder="{lang_Phone}" value="{form_value_phone}" />
                </div>
                 <div class="form-group {form_error_address} hidden">
                    <input class="form-control" id="address" name="address" type="text" placeholder="{lang_Address}" value="{form_value_address}" />
                </div>

                <div class="form-group {form_error_message}">
                    <textarea id="message" name="message" rows="3" class="form-control" type="text" placeholder="{lang_Message}">{form_value_message}</textarea>
                </div>
                <?php 
                $CI = &get_instance();
                $CI->load->model('repository_m');
                $repository_id = NULL;
                if(isset($_POST['repository_id']))
                {
                    $repository_id = $CI->data['repository_id'] = $_POST['repository_id'];
                }
                else
                {
                    // Create new repository
                    $repository_id = $CI->repository_m->save(array('name'=>'file_m', 'is_activated'=>0));
                    $this->data['repository_id'] = $repository_id;
                }
                ?>
                <div class="form-group UPLOAD-FIELD-TYPE" id="main">
                <div class="controls">
                    <div class="field-row hidden">
                        <?php echo form_input('repository_id', $repository_id, 'class="form-control skip-input" id="repository_id" placeholder="repository_id"')?>
                    </div>
                    <?php if(empty($repository_id)): ?>
                    <span class="label label-danger"><?php echo lang('After saving, you can add files and images');?></span>
                    <br style="clear:both;" />
                    <?php else: ?>
                    <!-- Button to select & upload files -->
                    <span class="btn btn-success fileinput-button">
                        <span><?php echo lang_check('Upload CV, Cover Letter...');?></span>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload_<?php echo $repository_id; ?>" class="FILE_UPLOAD file_<?php echo $repository_id; ?>" type="file" name="files[]" multiple>
                    </span><br style="clear: both;" />
                    <!-- The global progress bar -->
                    <p><?php echo lang_check('Upload progress');?></p>
                    <div id="progress_<?php echo $repository_id; ?>" class="progress progress-success progress-striped">
                        <div class="bar"></div>
                    </div>
                    <!-- The list of files uploaded -->
                    <p><?php echo lang_check('Files uploaded');?>:</p>
                    <ul id="files_<?php echo $repository_id; ?>">
                        <?php 
                        if(isset($repository_id)){
                            //Fetch repository
                            $file_rep = $this->file_m->get_by(array('repository_id'=>$repository_id));
                            if(sw_count($file_rep)) foreach($file_rep as $file_r)
                            {
                                $delete_url = site_url_q('files/upload/rep_'.$file_r->repository_id, '_method=DELETE&amp;file='.rawurlencode($file_r->filename));

                                echo "<li><a target=\"_blank\" href=\"".base_url('files/'.$file_r->filename)."\">$file_r->filename</a>".
                                     '&nbsp;&nbsp;<button class="btn btn-xs btn-mini btn-danger" data-type="POST" data-url='.$delete_url.'><i class="icon-trash icon-white"></i></button></li>';
                            }
                        }
                        ?>
                    </ul>

                    <!-- JavaScript used to call the fileupload widget to upload files -->
                    <script >
                    // When the server is ready...
                    $( document ).ready(function() {

                        // Define the url to send the image data to
                        var url_<?php echo $repository_id; ?> = '<?php echo site_url('files/upload_repository/'.$repository_id);?>';

                        // Call the fileupload widget and set some parameters
                        $('#fileupload_<?php echo $repository_id; ?>').fileupload({
                            url: url_<?php echo $repository_id; ?>,
                            autoUpload: true,
                            dropZone: $('#fileupload_<?php echo $repository_id; ?>'),
                            dataType: 'json',
                            done: function (e, data) {
                                // Add each uploaded file name to the #files list
                                var added=false;
                                $.each(data.result.files, function (index, file) {
                                    if(!file.hasOwnProperty("error"))
                                    {
                                        $('#files_<?php echo $repository_id; ?>').append('<li><a href="'+file.url+'" target="_blank">'+file.name+'</a>&nbsp;&nbsp;<button class="btn btn-xs btn-mini btn-danger" data-type="POST" data-url='+file.delete_url+'><i class="icon-trash icon-white"></i></button></li>');
                                        added=true;
                                    }
                                    else
                                    {
                                        ShowStatus.show(file.error);
                                    }
                                });

                                if(added)
                                {
                                    $('<?php echo '#repository_id'; ?>').val(data.result.repository_id);
                                    reset_events_<?php echo $repository_id; ?>();
                                }
                            },
                            progressall: function (e, data) {
                                // Update the progress bar while files are being uploaded
                                var progress = parseInt(data.loaded / data.total * 100, 10);
                                $('#progress_<?php echo $repository_id; ?> .bar').css(
                                    'width',
                                    progress + '%'
                                );
                            }
                        });

                        reset_events_<?php echo $repository_id; ?>();
                    });

                    function reset_events_<?php echo $repository_id; ?>(){
                        $("#files_<?php echo $repository_id; ?> li button").unbind();
                        $("#files_<?php echo $repository_id; ?> li button.btn-danger").click(function(){
                            var image_el = $(this);

                            $.post($(this).attr('data-url'), function( data ) {
                                var obj = jQuery.parseJSON(data);

                                if(obj.success)
                                {
                                    image_el.parent().remove();
                                }
                                else
                                {
                                    ShowStatus.show('<?php echo lang_check('Unsuccessful, possible permission problems or file not exists'); ?>');
                                }
                                //console.log("Data Loaded: " + obj.success );
                            });

                            return false;
                        });
                    }

                    </script>
                    <?php endif;?>
               </div>
            </div>
                
                <?php if(config_item( 'captcha_disabled')===FALSE): ?>
                <div class="form-group {form_error_captcha}">
                    <div class="row">
                        <div class="col-lg-6" style="padding-top:1px;">
                            <?php echo $captcha[ 'image']; ?>
                        </div>
                        <div class="col-lg-6">
                            <input class="captcha form-control {form_error_captcha}" name="captcha" type="text" placeholder="{lang_Captcha}" value="" />
                            <input class="hidden" name="captcha_hash" type="text" value="<?php echo $captcha_hash; ?>" />
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if(config_item('recaptcha_site_key') !== FALSE): ?>
                <div class="form-group" >
                    <div class="controls">
                        <?php _recaptcha(true); ?>
                   </div>
                </div>
                <?php endif; ?>
            <div class="form-group">
                <button type="submit" class="btn btn-custom btn-custom-secondary"><?php echo lang_check('Submit Application');?></button>
            </div>
        </form>
    </div>
</div><!-- ./ widget --> 