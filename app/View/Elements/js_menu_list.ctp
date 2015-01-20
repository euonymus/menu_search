<?
$query_arr = $this->request->query;
$query_arr['callback'] = 'JSON_CALLBACK';
$query_string = '?' . http_build_query($query_arr);
if (($this->params['controller'] == 'menus') && ($this->params['action'] == 'index')) {
  $action = 'search';
} elseif (($this->params['controller'] == 'menus') && ($this->params['action'] == 'likes')) {
  $action = 'likes';
} elseif (($this->params['controller'] == 'restaurants') && ($this->params['action'] == 'view')) {
  $action = 'restaurant/'.$this->request->params['pass'][0];
} elseif (($this->params['controller'] == 'users') && ($this->params['action'] == 'view')) {
  $action = 'registrants/'.$this->request->params['pass'][0];
}
?>
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
<? /*
    this.lists = <?= json_encode(array('menus'=>$menus)) ?>.menus;
*/ ?>
    this.lists = [];
    this.available = true; <? /* $http の制御 */ ?>
    this.busy = false;     <? /* loading.gifの制御 */ ?>
    this.page = 1; <? /* 次のページのスタンバイ */ ?>
  };

  API.prototype.loadMore = function() {
    if (!this.available) return;
    this.available = false;
    this.busy = true;

    var url = "http://<?= $_SERVER["HTTP_HOST"] ?>/api/menus/<?= $action ?>/page:" + this.page + ".json<?= $query_string ?>";
    $http.jsonp(url).success(function(data) {
      var lists = data.menus;
      for (var i = 0; i < lists.length; i++) {
        this.lists.push(lists[i]);
      }
      this.page++;
      this.available = true;
      this.busy = false;
    }.bind(this)).
    error(function(data, status, headers, config) {
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
