<a href="/menus/view/{{list.Menu.id}}" style="display:block;width:100%;height:100%">
<div class="list-group">
    <div class="list-group-item">
        <div class="row-picture">
            <img ng-if="list.Menu.image" src="{{list.Menu.thumbnail}}" alt="icon">
        </div>
        <div class="row-content">
   <h4 class="list-group-item-heading">{{list.Menu.name}}&nbsp;<small><i class="mdi-action-home" style="font-size: 20pt;"></i>{{list.Restaurant.name}}</small></h4>
   <small class="list-group-item-text">{{list.Menu.description}}</small>
            <p ng-if="list.Menu.remarks"><small class="list-group-item-text">備考：{{list.Menu.remarks}}</small></p>
            <p class="list-group-item-text">
                <span class="label label-info">&yen;{{list.Menu.price|number}}</span>

                <i class="mdi-action-grade mdi-material-lime" style="font-size:16pt;"></i>
                <i ng-if="list.Menu.point > 5" class="mdi-action-grade mdi-material-lime" style="font-size:16pt;"></i>
                <i ng-if="list.Menu.point > 10" class="mdi-action-grade mdi-material-lime" style="font-size:16pt;"></i>
                <i ng-if="list.Menu.point > 15" class="mdi-action-grade mdi-material-lime" style="font-size:16pt;"></i>
                <i ng-if="list.Menu.point > 20" class="mdi-action-grade mdi-material-lime" style="font-size:16pt;"></i>
<? /* 今のところランチのみをターゲットとしているためわざわざ表示しない。
                <span ng-if="list.Menu.combo" class="label label-success">セットメニュー</span>&nbsp;
                <span ng-if="list.Menu.lunch" class="label label-warning">ランチ</span>&nbsp;
                <span ng-if="list.Menu.dinner" class="label label-default">ディナー</span>
*/ ?>
            </p>
        </div>
    </div>
</div>
</a>
<? //echo h($menu['Menu']['point']);?>
