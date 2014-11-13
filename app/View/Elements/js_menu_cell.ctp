<a href="/menus/view/{{list.Menu.id}}" style="display:block;width:100%;height:100%">
<div class="list-group">
    <div class="list-group-item">
        <div class="row-picture">
            <img src="{{list.Menu.image}}" alt="icon">
        </div>
        <div class="row-content">
   <h4 class="list-group-item-heading">{{list.Menu.name}}&nbsp;<small><i class="mdi-action-home" style="font-size: 20pt;"></i>{{list.Restaurant.name}}</small></h4>
   <small class="list-group-item-text">{{list.Menu.description}}</small>
            <p><small class="list-group-item-text">備考：{{list.Menu.remarks}}</small></p>
            <p class="list-group-item-text">
<span class="label label-info">{{list.Menu.price}}</span>
<span class="label label-success">セットメニュー</span>&nbsp;
<span class="label label-warning">ランチ</span>&nbsp;
<span class="label label-default">ディナー</span>
            </p>
        </div>
    </div>
</div>
</a>
<? //echo h($menu['Menu']['point']);?>

<?
		  /*
$anchor = $this->element('menu_cell', compact('menu'));
$link = array('controller' => 'menus', 'action' => 'view', $menu['Menu']['id']);
$options = array('escape' => false,
		 'style' => 'display:block;width:100%;height:100%');
echo $this->Html->link($anchor, $link, $options);
		  */
?>