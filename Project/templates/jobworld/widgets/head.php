<meta charset="UTF-8">
<title>{page_title}</title>
<meta name="description" content="{page_description}" />
<meta name="keywords" content="{page_keywords}" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="" />

<?php if(isset($page_images) && !empty($page_images)):?>
<meta property="og:image" content="<?php _che($page_images[0]->url);?>" />
<?php else:?>
<meta property="og:image" content="<?php _che($website_logo_url);?>" />
<?php endif;?>
<link rel="canonical" href="<?php echo slug_url(uri_string());?>" />
<link rel="shortcut icon" href="<?php echo $website_favicon_url;?>" type="image/png" />

<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700%7CMontserrat:300,400,500,600,700,800" rel="stylesheet" />
<?php if(config_item('cookie_warning_enabled') === TRUE): ?>
<link href="assets/css/jquery.cookiebar.css" rel="stylesheet"></link>
<?php endif;?>

<?php cache_file('big_css.css', 'assets/libraries/font-awesome/css/font-awesome.min.css'); ?>
<?php cache_file('big_css.css', 'assets/libraries/elegant_font/html_css/style.css'); ?>
<?php cache_file('big_css.css', 'assets/libraries/line-awesome/css/line-awesome.min.css'); ?>

<!-- Start Jquery -->
<?php cache_file('big_js_critical.js', 'assets/js/jquery-2.2.1.min.js'); ?>
<?php cache_file('big_js_critical.js', 'assets/libraries/jquery.mobile/jquery.mobile.custom.min.js'); ?>
<!-- End Jquery -->

<!-- Start BOOTSTRAP -->
<?php cache_file('big_css.css', 'assets/libraries/bootstrap/css/bootstrap.min.css'); ?>
<?php cache_file('big_css.css', 'assets/css/bootstrap-select.min.css'); ?>
<?php cache_file('big_js.js', 'assets/js/popper.min.js'); ?>
<?php cache_file('big_js.js', 'assets/libraries/bootstrap/js/bootstrap.min.js'); ?>
<?php cache_file('big_js.js', 'assets/js/bootstrap-select.min.js'); ?>
<!-- End Bootstrap -->

<!-- Start blueimp  -->
<?php cache_file('big_css.css', 'assets/css/blueimp-gallery.min.css'); ?>
<?php cache_file('big_js.js', 'assets/js/blueimp-gallery.min.js'); ?>
<!-- End blueimp  -->

<?php cache_file('big_css.css', 'assets/libraries/owl.carousel/dist/css/owl.carousel.min.css'); ?>
<?php cache_file('big_css.css', 'assets/libraries/owl.carousel/dist/css/owl.theme.default.css'); ?>
<?php cache_file('big_css.css', 'assets/libraries/owl.carousel/dist/css/animate.css'); ?>
<?php cache_file('big_js.js', 'assets/libraries/owl.carousel/dist/owl.carousel.min.js'); ?>
<!-- Start custom styles  -->

<!-- Start JS MAP  -->
<?php load_map_api(config_db_item('map_version'), $lang_code);?>
    
<?php if(config_db_item('map_version') !='open_street'):?>
<?php cache_file('big_js.js', 'assets/js/map_infobox.js'); ?>
<?php cache_file('big_js.js', 'assets/js/markerclusterer.js'); ?>
<?php cache_file('big_js.js', 'assets/js/google-custom-marker.js'); ?>
<?php endif;?>

<?php cache_file('big_css.css', 'assets/css/map.css'); ?>

<?php cache_file('big_js.js', 'assets/libraries/bootstrap-3-typeahead/bootstrap3-typeahead.min.js'); ?>
<?php cache_file('big_js.js', 'assets/libraries/customd-jquery-number/jquery.number.min.js'); ?>
<?php cache_file('big_js.js', 'assets/libraries/h5Validate-master/jquery.h5validate.js'); ?>
<?php cache_file('big_js.js', 'assets/js/jquery.helpers.js'); ?>

<?php cache_file('big_js.js', 'assets/js/moment-with-locales.min.js'); ?>
<?php cache_file('big_js.js', 'assets/js/moment-timezone-with-data.js'); ?>

<?php cache_file('big_css.css', 'assets/libraries/owl.carousel/dist/css/owl.carousel.min.css'); ?>
<?php cache_file('big_css.css', 'assets/libraries/owl.carousel/dist/css/owl.theme.default.css'); ?>
<?php cache_file('big_css.css', 'assets/libraries/owl.carousel/dist/css/animate.css'); ?>
<?php cache_file('big_js_critical.js', 'assets/libraries/owl.carousel/dist/owl.carousel.min.js'); ?>

<!-- fileupload -->
<?php cache_file('big_css.css', 'assets/css/jquery.fileupload-ui.css'); ?>
<?php cache_file('big_css.css', 'assets/css/jquery.fileupload-ui-noscript.css'); ?> 

<?php //cache_file('big_js.js', 'assets/js/load-image.js'); ?>
<?php cache_file('big_js.js', 'assets/js/jquery-ui-1.10.3.custom.min.js'); ?>

<?php cache_file('big_js.js', 'assets/js/fileupload/jquery.iframe-transport.js'); ?>
<?php cache_file('big_js.js', 'assets/js/fileupload/jquery.fileupload.js'); ?>
<?php cache_file('big_js.js', 'assets/js/fileupload/jquery.fileupload-fp.js'); ?>
<?php cache_file('big_js.js', 'assets/js/fileupload/jquery.fileupload-ui.js'); ?>
<!-- end fileupload -->

<!-- Start bootstrap-datetimepicker-master -->
<?php cache_file('big_css.css', 'assets/libraries/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css'); ?>
<?php cache_file('big_js.js', 'assets/libraries/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js'); ?>
<!-- End bootstrap-datetimepicker-master -->

<!-- magnific-popup -->
<!-- url  https://plugins.jquery.com/magnific-popup/ -->
<?php if(config_item('report_property_enabled') == TRUE || config_item('claim_enabled') == TRUE): ?>
<?php cache_file('big_js.js', 'assets/libraries/magnific-popup/jquery.magnific-popup.js'); ?>
<?php cache_file('big_css.css', 'assets/libraries/magnific-popup/magnific-popup.css'); ?>
<?php endif;?>
<!--end magnific-popup -->

<!-- Start foodtable-jquery -->	
<?php cache_file('big_css.css', 'assets/libraries/pg-calendar/pg-calendar-master/dist/css/pignose.calendar.min.css'); ?>
<?php cache_file('big_js.js', 'assets/libraries/pg-calendar/pg-calendar-master/dist/js/pignose.calendar.full.min.js'); ?>
<!-- End footable-jquery -->

<!-- Start data-table -->	
<?php cache_file('big_css.css', 'assets/libraries/datatables/datatables.min.css'); ?>
<?php cache_file('big_js.js', 'assets/libraries/datatables/datatables.min.js'); ?>
<!-- End data-table  -->

<!-- Start masonry -->
<?php cache_file('big_js.js', 'assets/libraries/masonry/dist/masonry.pkgd.min.js'); ?>
<?php cache_file('big_js.js', 'assets/libraries/masonry/dist/imagesloaded.pkgd.min.js'); ?>
<!-- End masonry -->

<!-- Start Template files -->
<?php cache_file('big_css.css', 'assets/css/jobworld.css'); ?>
<?php cache_file('big_css.css', 'assets/css/jobworld-media.css'); ?>
<?php cache_file('big_js.js', 'assets/js/jobworld.js'); ?>
<!-- End  Template files -->

<?php cache_file('big_css.css', 'assets/js/winter_treefield/winter.css'); ?>
<?php cache_file('big_js.js', 'assets/js/winter_treefield/winter.js'); ?>

<?php cache_file('big_css.css', 'assets/css/custom.css'); ?>
<?php cache_file('big_css.css', 'assets/css/custom_media.css'); ?>
<?php cache_file('big_js.js', 'assets/js/custom.js'); ?>
<!-- End custom styles  -->

<?php cache_file('big_css.css', NULL); ?>
<?php cache_file('big_js_critical.js', NULL); ?>

{is_rtl}
<link href="assets/css/styles_rtl.css" rel="stylesheet">
{/is_rtl}

<script>
var location_hash = '';

// to top right away
<?php if(strrpos($page_current_url,'login') ==FALSE):?>
if ( window.location.hash) {
    location_hash = window.location.hash;
    window.location.hash ='';
};
<?php endif?>
</script>
{settings_tracking}