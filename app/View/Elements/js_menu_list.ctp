<? $this->Html->scriptStart(array('inline'=>false)); ?>
var listCtrl = function($scope){
   $scope.lists = <?= json_encode(array('menus'=>$menus)) ?>.menus;
}
<? $this->Html->scriptEnd(); ?>
<div ng-controller="listCtrl">
    <table class="table table-striped table-hover">
        <tbody>
            <tr ng-repeat="list in lists">
                <td>
                    <?= $this->element('js_menu_cell') ?>
                </td>
            </tr>
	</tbody>
    </table>
</div>

<?= $this->element('paginator') ?>
