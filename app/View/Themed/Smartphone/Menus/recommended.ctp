<div class="well bs-component">
    <h2>おすすめランチメニュー</h2>
    <p>お店毎の一押し料理を一覧しています！！</p>

    <ul class="nav nav-pills">
      <li class="active"><?= $this->Html->link('地域を絞る', '/menus/region/', array()) ?></li>
    </ul>
    <br>
    <?= $this->element('js_menu_list') ?>
</div>
