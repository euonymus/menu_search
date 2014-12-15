<?= $this->element('js_map') ?>

<? $hasPosition = $this->Map->initGmapLib(); ?>



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
              },
              error: function(xhr, textStatus, errorThrown){
                  //alert(textStatus);
              }
            });
        }),
    }
    $(function() {
        gmap.getLocation(updateLocation);
    });
<? $this->Html->scriptEnd();?>
