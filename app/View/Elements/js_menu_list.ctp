<?= $this->Html->script('//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js', array('inline' => false)) ?>
<?= $this->Html->script('ng-infinite-scroll.min', array('inline' => false)) ?>
<? $this->Html->scriptStart(array('inline'=>false)); ?>
/* var listCtrl = function($scope){ */
/*    $scope.lists = <?= json_encode(array('menus'=>$menus)) ?>.menus; */
/* } */
var myApp = angular.module('myApp', ['infinite-scroll']);
myApp.controller('listCtrl', function($scope) {
  $scope.lists = <?= json_encode(array('menus'=>$menus)) ?>.menus;
  /* $scope.lists = [1, 2, 3, 4, 5, 6, 7, 8]; */

  $scope.loadMore = function() {
    //alert(1);
    /* var last = $scope.lists[$scope.lists.length - 1]; */
    /* for(var i = 1; i <= 8; i++) { */
    /*   $scope.lists.push(last + i); */
    /* } */
  };
});

<? $this->Html->scriptEnd(); ?>
<div ng-app="myApp" ng-controller="listCtrl">
    <table class="table table-striped table-hover">
        <tbody infinite-scroll="loadMore()" >
            <tr ng-repeat="list in lists">
                <td>
                    <?= $this->element('js_menu_cell') ?>
                </td>
            </tr>
	</tbody>
    </table>
</div>


<?= $this->element('paginator') ?>
