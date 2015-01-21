<a href="/menus/view/{{list.Menu.id}}" style="display:block;width:100%;height:100%;text-decoration:none;">
<div class="menu-group list-group">
    <div class="list-group-item">
        <div class="row">
            <? /* MEMO: あれば Menu.image を表示 */ ?>
            <div class="menu-list-image col-xs-4" ng-if="!!list.Menu.image">
                <img ng-src="{{list.Menu.thumbnail}}" alt="icon" style="width:100%;">
            </div>
            <? /* MEMO: Menu.image が無く、MenuImage.image があればそっちを表示 */ ?>
            <div class="menu-list-image col-xs-4" ng-if="!list.Menu.image && !!list.MenuImage.thumbnail">
                <img ng-src="{{list.MenuImage.thumbnail}}" alt="icon" style="width:100%;">
            </div>

            <div class="menu-list-text" ng-class="!!list.Menu.image ? 'col-xs-8' : (!!list.MenuImage.thumbnail ? 'col-xs-8': 'col-xs-12')">
               <h2 class="list-group-item-heading">{{list.Menu.name}}<br ng-if="!!list.Menu.image || !!list.MenuImage.thumbnail">
               <small><i class="mdi-maps-store-mall-directory" style="font-size: 15pt;"></i>{{list.Restaurant.name}}</small></h2>

                <div class="list-group-item-text">
                    <span class="price">&yen;{{list.Menu.price|number}}</span><br ng-if="!!list.Menu.image || !!list.MenuImage.thumbnail">
                    <i class="mdi-action-grade mdi-material-lime" style="font-size:16pt;"></i>
                    <i class="mdi-action-grade" ng-class="{'mdi-material-lime':list.Menu.point > 5}" style="font-size:16pt;"></i>
                    <i class="mdi-action-grade" ng-class="{'mdi-material-lime':list.Menu.point >10}" style="font-size:16pt;"></i>
                    <i class="mdi-action-grade" ng-class="{'mdi-material-lime':list.Menu.point >15}" style="font-size:16pt;"></i>
                    <i class="mdi-action-grade" ng-class="{'mdi-material-lime':list.Menu.point >20}" style="font-size:16pt;"></i>
<? /* 今のところランチのみをターゲットとしているためわざわざ表示しない。
                    <span ng-if="list.Menu.combo" class="label label-success">セットメニュー</span>&nbsp;
                    <span ng-if="list.Menu.lunch" class="label label-warning">ランチ</span>&nbsp;
                    <span ng-if="list.Menu.dinner" class="label label-default">ディナー</span>
*/ ?>
                </div>
            </div>
        </div>
        <div ng-if="list.Menu.remarks" class="list-group-item-desc">備考：{{list.Menu.remarks}}</div>
        <div ng-class="{'list-group-item-desc': list.Menu.description}">{{list.Menu.description}}</div>
    </div>
</div>


<? /*
<div class="list-group">
    <div class="list-group-item">
        <div class="row-picture">
            <img ng-if="list.Menu.image" src="{{list.Menu.thumbnail}}" alt="icon" class="img-rounded">
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
*/ ?>
<? /* 今のところランチのみをターゲットとしているためわざわざ表示しない。
                <span ng-if="list.Menu.combo" class="label label-success">セットメニュー</span>&nbsp;
                <span ng-if="list.Menu.lunch" class="label label-warning">ランチ</span>&nbsp;
                <span ng-if="list.Menu.dinner" class="label label-default">ディナー</span>
*/ ?>
<? /*
            </p>
        </div>
    </div>
</div>
*/ ?>
</a>
<? //echo h($menu['Menu']['point']);?>
