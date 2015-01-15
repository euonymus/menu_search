<? $this->Map->initGmapLib(true); ?>
<? $this->Html->scriptStart(array('inline' => false)); ?>
    var getPlace = {
        successCallback: (function(position){
	    <? /* positionに外部からアクセスできる様にgmapにセットしておく */ ?>
	    gmap.position = position;
            position.coords.hasInput = true;
            //position.coords.hasMarker = true;
	    // ここでrenderしても display:noneのスタイルを充てる事でmapの位置がずれてしまうのでslideDown時にrenderする
	    //gmap.render(position.coords);

            var pyrmont = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
            var request = {
                location: pyrmont,
                radius: '50',<? /* MEMO: or 100 */ ?>
                types: ['restaurant','bar','cafe'],
                rankby: 'distance'
            };
            service = new google.maps.places.PlacesService(map);
            service.search(request, getPlace.callback);
        }),
	setLatLng: (function() {
	    obj = document.getElementById('RestaurantName');
	    index = obj.selectedIndex;
	    if (index != 0){
	      document.getElementById("show_lat").setAttribute("value",obj.options[index].getAttribute('lat'));
	      document.getElementById("show_lng").setAttribute("value",obj.options[index].getAttribute('lng'));
	    }
        }),
	callback: (function(results, status) {
	    if (status == google.maps.places.PlacesServiceStatus.OK) {
	      for (var i = 0; i < results.length; i++) {
		var select = document.getElementById('RestaurantName');
		var option = document.createElement('option');

		select.setAttribute('onchange', 'getPlace.setLatLng()');
		option.setAttribute('value', results[i].name);
		option.setAttribute('lat', results[i].geometry.location.lat());
		option.setAttribute('lng', results[i].geometry.location.lng());
		option.innerHTML = results[i].name;
		select.appendChild(option);
	      }
	    }
        }),
    }
    $(function() {
        gmap.getLocation(getPlace);
    });
<? $this->Html->scriptEnd();?>

<div class="form-group">
  <div id="map"></div>
  <?= $this->element('latlngInput', array('model' => 'RestaurantGeo')) ?>
</div>
