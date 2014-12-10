<div class="well bs-component">
    <h2>お気に入りメニュー</h2>
    <p>お客様がお気に入り登録したメニュー一覧</p>

    <ul class="nav nav-pills">
      <li class="active"><?= $this->Html->link('地域を絞る', '/menus/region/', array()) ?></li>
    </ul>
    <br>
    <?= $this->element('js_menu_list') ?>
</div>
