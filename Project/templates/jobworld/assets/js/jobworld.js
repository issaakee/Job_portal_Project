"use strict";
$(document).on('ready', function () {
    /* placeholder for IE */
    $.support.placeholder = ('placeholder' in document.createElement('input'));
    
    //fix for IE
    if (!$.support.placeholder) {
        $("[placeholder]").on('focus', function () {
            if ($(this).val() === $(this).attr("placeholder"))
                $(this).val("");
        }).on('blur', function () {
            if ($(this).val() === "")
                $(this).val($(this).attr("placeholder"));
        }).on('blur');

        $("[placeholder]").parents("form").on('submit', function () {
            $(this).find('[placeholder]').each(function () {
                if ($(this).val() === $(this).attr("placeholder")) {
                    $(this).val("");
                }
            });
        });
    }
    /* end placeholder for IE */
    
    $('.selectpicker').selectpicker({
        style: 'selectpicker-primary',
    });
    
    /* Start carusel */
    var owl = $("#owl-carousel");
    if (owl && owl.length) {
        owl.owlCarousel({
            nav: false,
            loop: true,
            singleItem: true,
            autoplay: true,
            animateOut: 'fadeOut',
            items:1,
        });
    }
    
    /* Start carusel */
    var owl = $(".owl-carousel-ini");
    if (owl && owl.length) {
        owl.owlCarousel({
            nav: false,
            loop: true,
            singleItem: true,
            autoplay: true,
            animateOut: 'fadeOut',
            items:1,
        });
    }
    
    /* Start carusel with custom navigation */
    var owls = $(".owl-carousel-custom");
    if (owls && owls.length) {
        owls.each(function(){
            var owl = $(this).owlCarousel({
                nav: false,
                loop: true,
                margin: 0,
                merge:true,
                singleItem: true,
                autoplay: true,
                items:1,
                dots: false,
            });

            // Go to the next item
            $(this).parent().find('.btn-next').click(function(e) {
                e.preventDefault();
                owl.trigger('next.owl.carousel');
            })
            // Go to the previous item
            $(this).parent().find('.btn-prev').click(function(e) {
                e.preventDefault();
                owl.trigger('prev.owl.carousel', [300]);
            })
        })
    }
    
    if(typeof LoadMap_main_default === 'function') {
        LoadMap_main_default();
    }    
    
    if(typeof map_property === 'function') {
        map_property();
    }
    
    if(typeof LoadMap_with_images === 'function') {
        LoadMap_with_images();
    }
    
    if(typeof $.fn.pignoseCalendar === 'function') {
        $('.pg-calendar').pignoseCalendar({
            weeks: [
                'S',
                'M',
                'T',
                'W',
                'T',
                'F',
                'S'
            ],
        });
    }
    
    var geomap = $('#geo-map');
    if (geomap && geomap.length) {
        geomap.geo_map();

        
        geomap.geo_map('set_config',{
            'color_hover': '#18ad50',
            'color_active': '#18ad50',
            /*'color_default': '#000',*/
           'color_border': '#000',
           })

        geomap.geo_map('generate_map','usa')
        geomap.on('clickArea.geo_map', function (event) {
            $('#location_geo').val(event.location);
        })

        if($('#location-select').length) {
            $('#location-select').on('change',function(){
                geomap.geo_map('generate_map',$(this).val())
            }) 
        }
    }
    
    $('#main-menu').on('show.bs.collapse', function () {
       $('body').addClass('screen-mask-xs');
    })
    
    $('#main-menu').on('hidden.bs.collapse', function () {
       $('body').removeClass('screen-mask-xs');
    })
    
  if($('.locationautocomplete').length){
        $('.locationautocomplete').each(function(){
            if(typeof google !== 'undefined')
                var autocomplete = new google.maps.places.Autocomplete($(this)[0]);
        })
        
        $('.locationautocomplete').parent().find('i').click(function(){
            // Try HTML5 geolocation
            if(navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    
                if(typeof google !== 'undefined'){
                    var latlng = new google.maps.LatLng(position.coords.latitude,
                                                     position.coords.longitude);
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({'latLng': latlng}, function(results, status)
                    {
                          if (status == google.maps.GeocoderStatus.OK)
                          {
                              var address = results[0].formatted_address;
                              $('.locationautocomplete').val(address);
                    }
                    });
                } else {
                    $.get('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='+position.coords.latitude+'&lon='+position.coords.longitude, function(data){
                        if(typeof data.address) {
                            if(typeof data.address.city)
                                $('.locationautocomplete').val(data.address.city);
                            else if(typeof data.address.state)
                                $('.locationautocomplete').val(data.address.state);
                        } else {
                            ShowStatus.show("Address not found");
                            return;
                        }
                    });
                }
                
              }, function() {
                // Not has permission
              });
            } else {
              // Browser doesn't support Geolocation

            }
        })
    }
    
    if(window.location.hash && window.location.hash == '#form_contact') {
        $('.validation').removeClass('d-none')
    }
})

function getParameterByName(name, url) {
    if (typeof url === 'undefined')
        url = window.location.href;
    var name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
    if (!results)
        return null;
    if (!results[2])
        return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}