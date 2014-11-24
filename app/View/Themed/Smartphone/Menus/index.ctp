<? $this->Html->scriptStart(array('inline'=>false)); ?>
$('.menu-large-category').click(function(){
    if ($(this).next().css('display') == 'none') {
        $(this).next().slideDown('fast');
    } else {
        $(this).next().slideUp('fast');
    }
});
<? $this->Html->scriptEnd(); ?>

<div class="menu-category">
  <h1><?= $station ?></h1>
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/curry.jpg", array("alt" => "カレー")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('カレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('カレーライス') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('スープカレー') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('タイカレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('グリーンカレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('イエローカレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('レッドカレー') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('インドカレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('マトンカレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('キーマカレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('バターチキンカレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('サグカレー') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/ramen.jpg", array("alt" => "ラーメン")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('醤油ラーメン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('味噌ラーメン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('塩ラーメン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('豚骨ラーメン') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('魚介ラーメン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('トマトラーメン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('豚骨醤油ラーメン') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('担々麺') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('麻婆麺') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('刃削麺') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('支那そば') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('タンメン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ワンタン麺') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ワンタン') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('つけ麺') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('油そば') ?></div>
      </div>
   </div>
</div>

<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/pasta.jpg", array("alt" => "パスタ")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('アラビアータ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ジェノベーゼ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ペペロンチーノ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('カルボナーラ') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ボンゴレ・ロッソ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ペスカトーレ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ボロネーゼ') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('和風パスタ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('スパゲッティー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ナポリタン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ミートソースパスタ') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/udon.jpg", array("alt" => "うどん・そば")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('うどん') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('讃岐うどん') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('煮込みうどん') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('カレーうどん') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('そば') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('きしめん') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ちゃんぽん') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('焼きそば') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('焼うどん') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('冷やし中華') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/setmenu.jpg", array("alt" => "定食・日本食")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('寿司') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('とんかつ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('天ぷら') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('焼き魚') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('からあげ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('フライ魚') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('エビフライ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('牡蠣フライ') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('焼肉') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('生姜焼き') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('野菜炒め') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('コロッケ') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('すき焼き') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('しゃぶしゃぶ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('おでん') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('焼き鳥') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('お好み焼き') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('もんじゃ焼き') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('たこ焼き') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/yoshoku.jpg", array("alt" => "洋食")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ステーキ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ハンバーグ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('鉄板焼き') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('グリルチキン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('チキン南蛮') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('オムライス') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ハヤシライス') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('シチュー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ビーフシチュー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('クリームシチュー') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ハンバーガー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ピザ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('サンドウィッチ') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/don.jpg", array("alt" => "丼もの")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('天丼') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('カツ丼') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('親子丼') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('牛丼') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('鰻重') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('麻婆丼') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('高菜丼') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('釜飯') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ネギトロ丼') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('いくら丼') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('海鮮丼') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/okinawa.jpg", array("alt" => "沖縄料理")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('沖縄そば') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ゴーヤーチャンプルー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('フーチャンプルー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ソーメンチャンプルー') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/chinese.jpg", array("alt" => "中華料理")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('餃子') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('飲茶') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('麻婆豆腐') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('チャーハン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('天津飯') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('中華飯') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('回鍋肉') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('酢豚') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('エビチリ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('レバニラ') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/korean.jpg", array("alt" => "韓国料理")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('プルコギ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('カルビ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('チヂミ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ビビンバ') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('スンドゥブ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('キムチチゲ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('サムゲタン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ユッケジャン') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('チャプチェ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('冷麺') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/thai.jpg", array("alt" => "タイ料理")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('トムヤムクン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('トムヤムラーメン') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->menuByTags('ガパオ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('カオマンガイ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->menuByTags('パッタイ') ?></div>
      </div>
   </div>
</div>
