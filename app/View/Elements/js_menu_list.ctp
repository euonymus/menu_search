<?= $this->Html->script('//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js', array('inline' => false)) ?>
<?= $this->Html->script('ng-infinite-scroll.min', array('inline' => false)) ?>
<? $this->Html->scriptStart(array('inline'=>false)); ?>
/* var listCtrl = function($scope){ */
/*    $scope.lists = <?= json_encode(array('menus'=>$menus)) ?>.menus; */
/* } */
var myApp = angular.module('myApp', ['infinite-scroll']);
myApp.controller('listCtrl', function($scope, API) {
  $scope.api = new API();
});

// API constructor function to encapsulate HTTP and pagination logic
myApp.factory('API', function($http) {
  var API = function() {
    this.lists = <?= json_encode(array('menus'=>$menus)) ?>.menus;
    this.busy = false;
    this.page = 2; <? /* 次のページのスタンバイ */ ?>
  };

  API.prototype.loadMore = function() {
    if (this.busy) return;
    this.busy = true;

    var url = "http://<?= $_SERVER["HTTP_HOST"] ?>/api/menus/search/page:" + this.page + ".json?<?= http_build_query($this->request->query) ?>&callback=JSON_CALLBACK";
    $http.jsonp(url).success(function(data) {
      var lists = data.menus;
      for (var i = 0; i < lists.length; i++) {
        this.lists.push(lists[i]);
      }
      this.page++;
      this.busy = false;
    }.bind(this));
  };

  return API;
});

<? $this->Html->scriptEnd(); ?>
<div ng-app="myApp" ng-controller="listCtrl">
    <table class="table table-striped table-hover">
        <tbody infinite-scroll="api.loadMore()" infinite-scroll-disabled="api.busy" infinite-scroll-distance="1">
            <tr ng-repeat="list in api.lists">
                <td>
                    <?= $this->element('js_menu_cell') ?>
                </td>
            </tr>
            <tr ng-show='api.busy'><td><?= $this->Html->image('/img/loading.gif', array('width'=>'100%')) ?></td></tr>
	</tbody>
    </table>
</div>


<?//= $this->element('paginator') ?>
