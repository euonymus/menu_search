<? $this->Map->initGmapLib(); ?>

<? $this->Html->scriptStart(array('inline' => false)); ?>
    var updateLocation = {
        successCallback: (function(position){
	    $.ajax({
              url: "//<?= $_SERVER["SERVER_NAME"] ?>/geo/update.json",
              type: "POST",
              data: position,
              dataType: "html",
              cache: false,
              success: function(data, textStatus){
                  //alert(data);
		  location.href="<?= $location ?>";
              },
              error: function(xhr, textStatus, errorThrown){
                  alert(textStatus);
		  location.href="<?= $location ?>";
              }
            });
        }),
	errorCallback: (function(positionError){
	    // 引数positionErrorの中身2つを取り出す
	    // コード(1～3のいずれかの値)
	    var code = positionError.code;
	    // メッセージ(開発者向けデバッグ用メッセージ)
	    var message = positionError.message;
     
	    // コードに応じたメッセージを表示
	    switch (code) {
	    case positionError.PERMISSION_DENIED: // codeが1
	      alert("GeolocationAPIのアクセス許可がありません");
	      break;
	    case positionError.POSITION_UNAVAILABLE: // codeが2
	      alert("現在の位置情報を特定できませんでした");
	      break;
	    case positionError.TIMEOUT: // codeが3
	      alert("指定されたタイムアウト時間内に現在の位置情報を特定できませんでした");
	      break;
	    }
	    location.href="<?= $location ?>";
        }),


    }
    $(function() {
        gmap.getLocation(updateLocation);
    });
<? $this->Html->scriptEnd();?>
