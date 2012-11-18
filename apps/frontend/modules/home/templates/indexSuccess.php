<script>
    $(window).load(function() {
        load();
    });
    
    var gMarkers = [];
    var map;
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
	    	var id = $(this).attr('id');
                
	    	    
	    	google.maps.event.addListener(marker, 'click', function() {
                    //map.setCenter(marker.getPosition());
                    showinfo(id);
	    	});
                
                gMarkers[$(this).attr('id')] = marker;
         });
         });
         doPoll();
        }
        
        function doPoll(){
            $.post('<?php echo url_for('home/checkState')?>', function(data) {
                $.each($.parseJSON(data), function() {
                    var marker = gMarkers[this.id];
                    if(marker != undefined){
                        marker.setIcon(this.image);
                    }
                });
                
                setTimeout(doPoll,5000);
            });
        }
        
        function showinfo(id){
             $.ajax({
                async: false,
                url: '<?php echo url_for('home/showInfo') ?>?id='+id,
                success: function(data){
                    $('#place_info').html(data);
                }
            });
        }


</script>

<div id="map" style="width: 1000px; height: 400px; margin:0px auto;"></div>
<div id="place_info" style="width: 1000px; height: 400px; margin:0px auto;"></div>