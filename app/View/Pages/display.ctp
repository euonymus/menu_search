<?= $this->Map->updateLocation() ?>
<div class="container">
   <h1>Coozo 食うぞ！</h1>
   <?= $this->element('social_buttons') ?>
   <p class="description">Coozoは次世代型ランチメニュー検索！食べたいメニューを選んでお店にGo！</p>
   <div>
   <?= $this->element('regions') ?>
   </div>

        <div style="padding-top:70px;">
            <div>
               <?= $this->Html->link('Coozoとは', '/about', array('target' => '_blank')) ?>
            </div>
            <div>
               <?= $this->Html->link('利用規約', '/terms', array('target' => '_blank')) ?>
            </div>
            <div>
               <?= $this->Html->link('プライバシーポリシー', '/privacy', array('target' => '_blank')) ?>
            </div>
        </div>
</div>