<script>
    $(window).load(function() {
        load();
        doPoll();
    });
    
    function load() {
        //definizione coordinate su cui centrare la mappa
        var lat_centro = "45.62899";
        var long_centro = "12.37458";
        var geocoder;
        var Opzioni = {
            zoom: 5,
            center: new google.maps.LatLng(lat_centro, long_centro),
            mapTypeId: google.maps.MapTypeId.HYBRID,
            scrollwheel:false,
            streetViewControl: false
        }
        map = new google.maps.Map(document.getElementById("map"), Opzioni);
	$.get('<?php echo url_for('home/markers',true).'?'.time().'"';?>',function(data) {
             $(data).find('marker').each(function(){
               var infowindow = new google.maps.InfoWindow({
                    content: $(this).attr('name')
                });
                
                var marker = new google.maps.Marker({
	    	    position: new google.maps.LatLng($(this).attr('lat'), $(this).attr('long')),
	    	    map: map,
	    	    title:'',
                    icon: $(this).attr('image')
	    	});
	    	
                
	    	    
	    	google.maps.event.addListener(marker, 'click', function() {
                    map.setCenter(marker.getPosition());
	    	    infowindow.open( map, marker);
	    	});   
         });
         });
        }
        
        function doPoll(){
            $.post('<?php echo url_for('home/checkState')?>', function(data) {
                setTimeout(doPoll,5000);
            });
        }


</script>

<div id="map" style="width: 1000px; height: 400px; margin:0px auto;"></div>