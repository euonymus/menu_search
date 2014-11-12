<div ng-controller="listCtrl">
    <p>AngularJSのテスト</p>
    <ul>
        <li ng-repeat="list in lists">{{list.Menu}}</li>
    </ul>
</div>

<script type="text/javascript">
<!--
var listCtrl = function($scope){
   $scope.lists = <?= json_encode(array('menus'=>$menus)) ?>.menus;
}
-->
</script>
