<?php
/*
Widget-title: Map & Search
Widget-preview-image: /assets/img/widgets_preview/top_mapsearch_visual.jpg
 */
?>
<?php
$tree_field_id = 79;
$CI = & get_instance();
$values = array();
$CI->load->model('treefield_m');
$CI->load->model('file_m');
$check_option = $CI->treefield_m->get_lang(NULL, FALSE, $lang_id);
foreach ($check_option as $key => $value) {
    if($value->field_id==$tree_field_id){
        $icon = 'icon_id-2';
        // Thumbnail and big image
        if(!empty($value->font_icon_code))
        {
            $icon = $value->font_icon_code;
        }
        $values[$value->value_path]= $icon;
    }
}
?>


<div class="widget-mapsearch container container-palette widget_edit_enabled">
    <div class="map map-top" id="main-map"></div>
    
    <div class="container">
        <div class="search-overflow search-form">
            <form action="#" class="row job-form">
                <?php _search_form_primary(1, 'horizontal/') ;?> 
                <div class="advanced-form-part hidden">
                  <div class="form-row-space"></div>
                  <?php if(config_db_item('secondary_disabled') === TRUE): ?>
                    <!--
                   <input id="search_option_36_from" type="text" class="span3 mPrice" placeholder="<?php _l('Fromprice');?> ({options_prefix_36}{options_suffix_36})" value="<?php echo search_value('36_from'); ?>" />
                   <input id="search_option_36_to" type="text" class="span3 xPrice" placeholder="<?php _l('Toprice');?> ({options_prefix_36}{options_suffix_36})" value="<?php echo search_value('36_to'); ?>" />
                   -->
                    <input id="search_option_19" type="text" class="span3 Bathrooms" placeholder="{options_name_19}" value="<?php echo search_value(19); ?>" />
                   <input id="search_option_20" type="text" class="span3" placeholder="{options_name_20}" value="<?php echo search_value(20); ?>" />
                   <div class="form-row-space"></div>
                   <?php if(file_exists(APPPATH.'controllers/admin/booking.php')):?>
                   <input id="booking_date_from" type="text" class="span3 mPrice" placeholder="<?php _l('FromDate');?>" value="<?php echo search_value('date_from'); ?>" />
                   <input id="booking_date_to" type="text" class="span3 xPrice" placeholder="<?php _l('ToDate');?>" value="<?php echo search_value('date_to'); ?>" />
                   <div class="form-row-space"></div>
                   <?php endif; ?>
                   <?php if(config_db_item('search_energy_efficient_enabled') === TRUE): ?>
                   <select id="search_option_59_to" class="span3 selectpicker nomargin">
                       <option value="">{options_name_59}</option>
                       <option value="50">A</option>
                       <option value="90">B</option>
                       <option value="150">C</option>
                       <option value="230">D</option>
                       <option value="330">E</option>
                       <option value="450">F</option>
                       <option value="999999">G</option>
                   </select>
                   <div class="form-row-space"></div>
                   <?php endif; ?>
                   <label class="checkbox">
                   <input id="search_option_11" type="checkbox" class="span1" value="true{options_name_11}" <?php echo search_value('11', 'checked'); ?>/>{options_name_11}
                   </label>
                   <label class="checkbox">
                   <input id="search_option_22" type="checkbox" class="span1" value="true{options_name_22}" <?php echo search_value('22', 'checked'); ?>/>{options_name_22}
                   </label>
                   <label class="checkbox">
                   <input id="search_option_25" type="checkbox" class="span1" value="true{options_name_25}" <?php echo search_value('25', 'checked'); ?>/>{options_name_25}
                   </label>
                   <label class="checkbox">
                   <input id="search_option_27" type="checkbox" class="span1" value="true{options_name_27}" <?php echo search_value('27', 'checked'); ?>/>{options_name_27}
                   </label>
                   <label class="checkbox">
                   <input id="search_option_28" type="checkbox" class="span1" value="true{options_name_28}" <?php echo search_value('28', 'checked'); ?>/>{options_name_28}
                   </label>
                   <label class="checkbox">
                   <input id="search_option_29" type="checkbox" class="span1" value="true{options_name_29}" <?php echo search_value('29', 'checked'); ?>/>{options_name_29}
                   </label>
                   <label class="checkbox">
                   <input id="search_option_32" type="checkbox" class="span1" value="true{options_name_32}" <?php echo search_value('32', 'checked'); ?>/>{options_name_32}
                   </label>
                   <label class="checkbox">
                   <input id="search_option_30" type="checkbox" class="span1" value="true{options_name_30}" <?php echo search_value('30', 'checked'); ?>/>{options_name_30}
                   </label>
                   <label class="checkbox">
                   <input id="search_option_33" type="checkbox" class="span1" value="true{options_name_33}" <?php echo search_value('33', 'checked'); ?>/>{options_name_33}
                   </label>
                   <label class="checkbox">
                   <input id="search_option_23" type="checkbox" class="span1" value="true{options_name_23}" <?php echo search_value('23', 'checked'); ?>/>{options_name_23}
                   </label>
                   <?php else: ?>
                   <?php _search_form_secondary_hidden(1); ?>
                   <?php endif; ?>
                </div>
                <div class="form-group-btn  <?php if(file_exists(APPPATH.'controllers/admin/savesearch.php')):?> form_field_save <?php endif;?>">
                    <button class="btn btn-outline-primary sw-search-start" type="submit">
                        <span><?php echo lang_check('Search');?><i class="fa fa-spinner fa-spin fa-ajax-indicator hidden"></i></span>
                    </button>
                    <?php if(file_exists(APPPATH.'controllers/admin/savesearch.php')): ?>
                        <button type="button" id="search-save" class="btn btn-custom btn-savesearch btn-custom-secondary btn-icon"><i class="fa fa-spinner fa-spin fa-ajax-indicator" style="display: none;"></i><span>{lang_SaveResearch}</span></button>
                    <?php endif; ?>
                </div>
                <div class="form-group-btn">
                    <button type="submit"  id="search-start" class="btn btn-flat-search"><?php echo lang_check('Search');?></button>
                    <?php if(file_exists(APPPATH.'controllers/admin/savesearch.php')): ?>
                    <?php endif; ?>
                </div>  
            </form>
        </div>
    </div>
</div><!-- ./ search with map -->


<script>
    var markers = new Array();
    var map;
    var marker_clusterer ;
    $(document).ready(function(){
        var myLocationEnabled = true;
        var style_map = mapStyle;
        var scrollwheelEnabled = false;
        
        <?php if(config_db_item('map_version') =='open_street'):?>
                
        if($('#main-map').length){    
            map = L.map('main-map', {
                <?php if(config_item('custom_map_center') === FALSE): ?>
                center: [{all_estates_center}],
                <?php else: ?>
                center: [<?php echo config_item('custom_map_center'); ?>],
                <?php endif; ?>
                zoom: {settings_zoom}-2,
                scrollWheelZoom: scrollwheelEnabled,
                dragging: !L.Browser.mobile,
                tap: !L.Browser.mobile
            });     
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var positron = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png').addTo(map);

            <?php foreach($all_estates as $item): ?>
                <?php
                    if(!isset($item['gps']))break;
                    if(empty($item['gps']))continue;
                ?>
                <?php 
                    $item['icon'] = 'icon_id-2';
                    if(!empty($item['option_79']) && isset($values[$item['option_79']])){
                        $item['icon'] = $values[$item['option_79']];
                    }
                ?>           
                            
                var marker = L.marker(
                    [<?php _che($item['gps']); ?>],
                    {icon: L.divIcon({
                            html: '<span><i class="<?php _che($item['icon'])?>"></i></span>',
                            className: 'open_steet_map_marker google_marker',
                            iconSize: [50, 46],
                            popupAnchor: [0, -18],
                            iconAnchor: [25, 46],
                        })
                    }
                )/*.addTo(map)*/;

                marker.bindPopup("<?php echo _generate_popup($item, true); ?>", jpopup_customOptions);
                clusters.addLayer(marker);
                markers.push(marker);
            <?php endforeach; ?>
            map.addLayer(clusters);    
            <?php if(config_db_item('map_fixed_position') == FALSE): ?>
            /* set center */
            if(markers.length){
                var limits_center = [];
                for (var i in markers) {
                    if(typeof markers[i]['_latlng'] == 'undefined') continue;
                    var latLngs = [ markers[i].getLatLng() ];
                    limits_center.push(latLngs)
                };
                var bounds = L.latLngBounds(limits_center);
                <?php if(config_db_item('auto_set_zoom_disabled') != FALSE): ?>
                    map.setView(bounds.getCenter());
               <?php else:?>
                    map.fitBounds(bounds);
               <?php endif;?>
            }
            <?php endif;?>
        } 
        <?php else:?>
        // option
        if($('#main-map').length){

        var mapOptions = {
            <?php if(config_item('custom_map_center') === FALSE): ?>
            center: new google.maps.LatLng({all_estates_center}),
            <?php else: ?>
            center: new google.maps.LatLng(<?php echo config_item('custom_map_center'); ?>),
            <?php endif; ?>
            zoom: {settings_zoom},
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: scrollwheelEnabled,
            mapTypeControlOptions: {
              mapTypeIds: c_mapTypeIds,
              position: google.maps.ControlPosition.TOP_RIGHT
            },
            styles: mapStyle
        };
       
        
                map = new google.maps.Map(document.getElementById('main-map'), mapOptions);

                <?php foreach($all_estates as $item): ?>
                    <?php
                        if(!isset($item['gps']))break;
                        if(empty($item['gps']))continue;
                    ?>
                                
                    <?php 
                        $item['icon'] = '';
                        if(!empty($item['option_79']) && isset($values[$item['option_79']])){
                            $item['icon'] = $values[$item['option_79']];
                        }
                    ?>

                var myLatlng = new google.maps.LatLng(<?php _che($item['gps']); ?>);
                var callback = {
                                'click': function(map, e){
                                    var activemarker = e.activemarker;
                                    jQuery.each(markers, function(){
                                        this.activemarker = false;
                                    })

                                    sw_infoBox.close();
                                    if(activemarker) {
                                        e.activemarker = false;
                                        return true;
                                    }
                                    
                                    var boxOptions = {
                                        content: "<?php echo _generate_popup($item, true); ?>",
                                        disableAutoPan: false,
                                        alignBottom: true,
                                        maxWidth: 0,
                                        pixelOffset: new google.maps.Size(-175, -60),
                                        zIndex: null,
                                        closeBoxMargin: "0",
                                        closeBoxURL: "",
                                        infoBoxClearance: new google.maps.Size(1, 1),
                                        isHidden: false,
                                        pane: "floatPane",
                                        enableEventPropagation: false,
                                        closeBoxURL: "assets/img/close.png"
                                    };
                            
                                    sw_infoBox.setOptions( boxOptions);
                                    sw_infoBox.open( map, e );

                                    e.activemarker = true;
                                }
                        };
                var marker_inner ='<span><img src="<?php _che($item['icon'])?>"></span>';
                var marker = new CustomMarker(myLatlng,map,marker_inner,callback);
                markers.push(marker);



                <?php endforeach; ?>

                marker_clusterer = new MarkerClusterer(map, markers, clusterConfig);

        if(mapSearchbox){   
            init_map_searchbox(map);
        }  

        if(myLocationEnabled){
            var controlDiv = document.createElement('div');
            controlDiv.index = 1;
            map.controls[google.maps.ControlPosition.RIGHT_TOP].push(controlDiv);
            HomeControl(controlDiv, map)
            }
        }


        if(rectangleSearchEnabled)
         {
             var controlDiv2 = document.createElement('div');
             controlDiv2.index = 2;
             map.controls[google.maps.ControlPosition.RIGHT_TOP].push(controlDiv2);
             RectangleControl(controlDiv2, map)
         } 

        <?php endif;?>
    })
</script>
    