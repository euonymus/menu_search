    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0px; padding: 0px }
      #map { height: 100% }
    </style>

    <script src="http://maps.google.com/maps/api/js?v=3&sensor=false"
        type="text/javascript" charset="UTF-8"></script>



  <div id="map" style="height:560px"></div>

    <table border="1" cellspacing="0">
    <tr><th>LAT</th><td id="show_lat"></td></tr>
    <tr><th>LNG</th><td id="show_lng"></td></tr>
    </table>





<?= $this->Html->script('geoinfo') ?>

<h1>Geolocation API(getCurrentPosition) Sample</h1>
<button onclick="start()">位置情報取得開始(getCurrentPosition)</button>
<div id="message"></div>
