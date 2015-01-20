<?= $this->Map->updateLocation() ?>
<div class="container">
   <h1><?= $station ?>のランチ検索 Coozo 食うぞ！</h1>
   <?= $this->element('social_buttons') ?>
   <p class="description"><?= $station ?>エリアに特化したランチ検索サービス！Coozoは次世代型ランチメニュー検索！食べたいメニューを選んでお店にGo！</p>

   <div class="row">
      <div class="col-xs-3">
        <?= $this->element('categories') ?>
      </div>
      <div class="col-xs-9">
         <div class="notice-to-eateries well">
            <h2>料理メニューを登録して集客力をアップしませんか！？</h2>
            <h3>レストラン・飲食関係の皆様へ</h3><hr>

            <h4>coozoは食べたいものを写真比較してお店を選ぶ事ができるサービスです</h4>
            <p>等サービスにご登録頂く事によりみなさまのお店のメニューがユーザに露出される機会が増え集客に貢献する事ができます。
            coozoは現在アルファ版としてリリースされております。他店が登録する前にご登録頂く事によりよりユーザの目に付く機会をふやしましょう！</p>

            <div class="eateries-register">
               <i class="glyphicon glyphicon-arrow-right"></i>
               <?= $this->Html->link('今すぐメニューを登録', '/menus/add_restaurant') ?>
            </div>
         </div>
      </div>
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