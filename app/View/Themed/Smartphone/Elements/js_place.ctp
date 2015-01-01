<? $this->Map->initGmapLib(true); ?>
<? $this->Html->scriptStart(array('inline' => false)); ?>
    var getPlace = {
        successCallback: (function(position){
            position.coords.hasInput = true;
            //position.coords.hasMarker = true;
	    gmap.render(position.coords);

            var pyrmont = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);

            var request = {
                location: pyrmont,
		<? /* TODO: 50に変える */ ?>
                radius: '100',
                types: ['restaurant','bar','cafe'],
                rankby: 'distance'
            };

            service = new google.maps.places.PlacesService(map);
            service.search(request, getPlace.callback);
        }),
	callback: (function(results, status) {
	    if (status == google.maps.places.PlacesServiceStatus.OK) {
	      for (var i = 0; i < results.length; i++) {
		var latlng = new google.maps.LatLng(results[i].geometry.location.lat(),results[i].geometry.location.lng());
		var marker = new google.maps.Marker({
		  position: latlng,
		      map:map,
		      name:results[i].name,
                });

		addListenerPoint(marker, results[i]);
                /* // <select id="select"> を取得 */
		/* var select = document.getElementById('RestaurantName'); */
		/* var option = document.createElement('option'); */
		/* option.setAttribute('value', results[i].name); */
		/* option.innerHTML = results[i].name; */
		/* select.appendChild(option); */
	      }

	      function addListenerPoint(marker_m, result_m) {
		google.maps.event.addListener(marker_m, 'click', function() {
		    map.setZoom(18);
		    map.setCenter(marker_m.getPosition());

		    // <input> を取得
		    var input = document.getElementById('RestaurantName');
		    var option = document.createElement('option');
		    input.setAttribute('value', marker_m.name);
		    document.getElementById("show_lat").setAttribute("value",marker_m.getPosition().lat());
		    document.getElementById("show_lng").setAttribute("value",marker_m.getPosition().lng());
                });
	      }


	    }
        }),
    }
    $(function() {
        gmap.getLocation(getPlace);
    });
<? $this->Html->scriptEnd();?>

<div class="form-group">
  <label class="container">レストラン場所</label>
  <div id="map"></div>
  <?= $this->element('latlngInput', array('model' => 'RestaurantGeo')) ?>
</div>
