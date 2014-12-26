<div class="container">
   <h1>レストラン一覧</h1>
   <span class="label label-success"><?= $station ?></span>
   <table class="table table-striped table-hover">
      <tbody>
<?php foreach ($restaurants as $restaurant): ?>
         <tr>
            <td>
<?php
   $anchor = h($restaurant['Restaurant']['name']);
   $anchor .= '<br>';
   $anchor .= h($restaurant['Restaurant']['description']);

   $url = array('action' => 'view',
		$restaurant['Restaurant']['id']);
   $options = array('escape' => false,
		    'style' => 'display:block;width:100%;height:100%',
		    );
   echo $this->Html->link($anchor, $url, $options);
?>
            </td>
         </tr>
<?php endforeach; ?>
      </tbody>
   </table>
   <?= $this->element('paginator') ?>
</div>
