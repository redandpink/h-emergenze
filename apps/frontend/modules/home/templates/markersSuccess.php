<markers>
    <?php
    foreach ($places as $place) {
        if ($place['place_type'] == 'safe') {
            $map_image = image_path('safe.png');
        } else {
            $map_image = image_path('control.png');
        }
        echo '<marker 
			id="' . $place['id'] . '" 
			lat="' . $place['latitude'] . '" 
			long="' . $place['longitude'] . '"
			name="' . $place['name'] . '"  
			place_type="' . $place['place_type'] . '" 
			image="' . $map_image
        . '"></marker>' .
        "\n";
    }
    ?>
</markers>