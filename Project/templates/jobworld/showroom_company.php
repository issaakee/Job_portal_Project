<!DOCTYPE html>
<html lang="en">
    <head>
        <?php _widget('head');?>
    </head>
    <body class="<?php _widget('custom_paletteclass'); ?>">
        <header>
            <?php _widget('custom_header_menu-for-loginuser');?>
            <?php _widget('header_mainmenu'); ?>
        </header><!-- ./ header --> 
        <?php _widget('top_pagetitle'); ?>
        <main class="container container-palette pt-75 m30">
            <div class="container">
                <div class="wraper-row">
                    <div class="column-content">
                           <div class="box-post-open m35">
                            <div class="post-open-thumbnail">
                                <?php if(isset($page_images) && !empty($page_images)):?>
                                <img src="<?php _che($page_images[0]->url);?>" alt="" />
                                <?php endif;?>
                            </div>
                            <div class="header">
                                <h1 class="title">{page_title}</h1>
                                <div class="meta-tags">
                                    <span><i class="fa fa-calendar"></i>
                                    <?php
                                    $CI = &get_instance();
                                    $CI->load->model('page_m');
                                    $page = $CI->page_m->get_lang($page_id);
                                    $timestamp = strtotime($page->date);
                                    $m = strtolower(date("F", $timestamp));
                                    echo lang_check('cal_' . $m) . ' ' . date("j, Y", $timestamp);
                                    ?>
                                    </span>
                                </div>
                            </div>
                            <div class="body">
                                {page_body}
                                {has_page_documents}
                                <h2><?php _l('Filerepository');?></h2>
                                <ul>
                                {page_documents}
                                <li>
                                    <a href="{url}">{filename}</a>
                                </li>
                                {/page_documents}
                                </ul>
                                {/has_page_documents}
                            </div>
                            <div class="footer">
                                <div class="left-side tags">
                                    <?php if(!empty($page->{'keywords_'.$lang_id})):?>
                                    <b><?php echo lang_check('Tags');?>:</b>
                                    <?php 
                                        $tags = explode(',', $page->{'keywords_'.$lang_id});
                                        foreach ($tags as $key=>$val): ?>
                                        <?php 
                                        $s = ',';
                                        if(sw_count($tags) == $key+1)$s='';
                                        ?>
                                        <a href="#"><?php echo trim($val).$s; ?></a>
                                    <?php endforeach; ?>
                                    <?php endif;?>
                                </div>
                                <div class="right-side">
                                    <ul class="social-content-btns">
                                        <li><a href="https://www.facebook.com/share.php?u={page_current_url}&title={settings_websitetitle}"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="https://twitter.com/home?status={settings_websitetitle}%20{page_current_url}"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- ./ widget post description --> 
                        <div class="widget">
                            <div class="widget-header">
                                <h2 class="title"><?php echo lang_check('Locationonmap'); ?></h2>
                            </div>
                            <div>
                                <div class="location-map" id='location-map' style='height: 385px;'></div>
                            </div>
                        </div>
                    </div><!-- ./ content --> 
                    
                    <div class="column-sidebar">
                        
                        
                        <div class="widget widget-posts">
                            <div class="widget-header">
                                <h2 class="title"><?php echo lang_check('Contact Us');?></h2>
                            </div>
                            <div class="content-box">
                                <p class="bottom-border"><strong>
                                    <?php _l('Company');?>
                                    </strong> <span>{page_title}</span>
                                    <br style="clear: both;" />
                                    </p>
                                    <p class="bottom-border"><strong>
                                    <?php _l('Address');?>
                                    </strong> <span>{showroom_data_address}</span>
                                    <br style="clear: both;" />
                                    </p>
                                    <p class="bottom-border"><strong>
                                    <?php _l('Keywords');?>
                                    </strong> <span>{page_keywords}</span>
                                    <br style="clear: both;" />
                                </p>
                            </div>
                        </div>
                    </div><!-- ./ sidebar --> 
                </div>
            </div>
        </main>
        <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'default')); ?>
        <div class="se-pre-con"></div>    
        <?php _widget('custom_popup');?>
        <?php _widget('custom_javascript');?>
             <script>
            var map;
            $(document).ready(function(){

            $("#route_from_button").click(function () { 
                 window.open("https://maps.google.hr/maps?saddr="+$("#route_from").val()+"&daddr={showroom_data_address}@{showroom_data_gps}&hl={lang_code}",'_blank');
                 return false;
             });

            if($('#location-map').length){

            var myLocationEnabled = true;
            var style_map = '';
            var scrollwheelEnabled = false;
            <?php if(config_db_item('map_version') =='open_street'):?>


            var property_map;
            property_map = L.map('location-map', {
                center: [{showroom_data_gps}],
                zoom: {settings_zoom},
                scrollWheelZoom: scrollWheelEnabled,
                dragging: !L.Browser.mobile,
                tap: !L.Browser.mobile
            });     
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(property_map);
            var positron = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png').addTo(property_map);
            var property_marker = L.marker(
                [{showroom_data_gps}],
            ).addTo(property_map);

           property_marker.bindPopup("{showroom_data_address}<br />{lang_GPS}: {showroom_data_gps}");

            <?php else:?>
            var markers = new Array();
            var mapOptions = {
                center: new google.maps.LatLng({showroom_data_gps}),
                zoom: {settings_zoom},
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: scrollwheelEnabled,
                styles:style_map
            };

            var map = new google.maps.Map(document.getElementById('location-map'), mapOptions);

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng({showroom_data_gps}),
                map: map,
            });

            var myOptions = {
                content: "<div class='infobox2'>{showroom_data_address}<br /><?php _l('GPS');?>: {showroom_data_gps}</div>",
                disableAutoPan: false,
                maxWidth: 0,
                pixelOffset: new google.maps.Size(-85, -95),
                zIndex: null,
                closeBoxURL: "",
                infoBoxClearance: new google.maps.Size(1, 1),
                position: new google.maps.LatLng({showroom_data_gps}),
                isHidden: false,
                pane: "floatPane",
                enableEventPropagation: false
            };

            marker.infobox = new InfoBox(myOptions);
            marker.infobox.isOpen = false;
            markers.push(marker);

            // action        
            google.maps.event.addListener(marker, "click", function (e) {
                var curMarker = this;

                $.each(markers, function (index, marker) {
                    // if marker is not the clicked marker, close the marker
                    if (marker !== curMarker) {
                        marker.infobox.close();
                        marker.infobox.isOpen = false;
                    }
                });

                if(curMarker.infobox.isOpen === false) {
                    curMarker.infobox.open(map, this);
                    curMarker.infobox.isOpen = true;
                    map.panTo(curMarker.getPosition());
                } else {
                    curMarker.infobox.close();
                    curMarker.infobox.isOpen = false;
                }
            });

            if(myLocationEnabled){
                var controlDiv = document.createElement('div');
                controlDiv.index = 1;
                map.controls[google.maps.ControlPosition.RIGHT_TOP].push(controlDiv);
                HomeControl(controlDiv, map)
                }
                
                 <?php endif;?>
                }
            })
        </script>
    </body>
</html>