<div class="container">
   <h1>ランチメニュー検索<?= $station ? ' - '. $station : '' ?></h1>
   <div>
      種類を選択してください
   </div>
   <div class="tag-buttons row">
      <div class="tag-button tag1 text-center col-xs-3"><?= $this->Menu->linkTags('カレー') ?></div>
      <div class="tag-button tag4 text-center col-xs-3"><?= $this->Menu->linkTags('タイカレー') ?></div>
      <div class="tag-button tag8 text-center col-xs-3"><?= $this->Menu->linkTags('インドカレー') ?></div>
      <div class="tag-button tag30 text-center col-xs-3"><?= $this->Menu->linkTags('パスタ') ?></div>

      <div class="tag-button tag13 text-center col-xs-3"><?= $this->Menu->linkTags('ラーメン') ?></div>
      <div class="tag-button tag14 text-center col-xs-3"><?= $this->Menu->linkTags('つけ麺') ?></div>
      <div class="tag-button tag24 text-center col-xs-3"><?= $this->Menu->linkTags('担々麺') ?></div>
      <div class="tag-button tag42 text-center col-xs-3"><?= $this->Menu->linkTags('うどん・そば') ?></div>

      <div class="tag-button tag55 text-center col-xs-3"><?= $this->Menu->linkTags('定食') ?></div>
      <div class="tag-button tag56 text-center col-xs-3"><?= $this->Menu->linkTags('肉料理') ?></div>
      <div class="tag-button tag57 text-center col-xs-3"><?= $this->Menu->linkTags('魚料理') ?></div>
      <div class="tag-button tag94 text-center col-xs-3"><?= $this->Menu->linkTags('郷土料理') ?></div>

      <div class="tag-button tag71 text-center col-xs-3"><?= $this->Menu->linkTags('洋食') ?></div>
      <div class="tag-button tag104 text-center col-xs-3"><?= $this->Menu->linkTags('中華料理') ?></div>
      <div class="tag-button tag128 text-center col-xs-3"><?= $this->Menu->linkTags('タイ料理') ?></div>
      <div class="tag-button tag115 text-center col-xs-3"><?= $this->Menu->linkTags('韓国料理') ?></div>
   </div>
</div>
<? /*
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
          <div class="col-lg-3"><?= $this->Menu->linkTags('カレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('カレーライス') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('スープカレー') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('タイカレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('グリーンカレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('イエローカレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('レッドカレー') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('インドカレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('マトンカレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('キーマカレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('バターチキンカレー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('サグカレー') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/ramen.jpg", array("alt" => "ラーメン")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('醤油ラーメン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('味噌ラーメン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('塩ラーメン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('豚骨ラーメン') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('魚介ラーメン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('トマトラーメン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('豚骨醤油ラーメン') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('担々麺') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('麻婆麺') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('刃削麺') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('支那そば') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('タンメン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ワンタン麺') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ワンタン') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('つけ麺') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('油そば') ?></div>
      </div>
   </div>
</div>

<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/pasta.jpg", array("alt" => "パスタ")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('アラビアータ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ジェノベーゼ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ペペロンチーノ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('カルボナーラ') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('ボンゴレ・ロッソ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ペスカトーレ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ボロネーゼ') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('和風パスタ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('スパゲッティー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ナポリタン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ミートソースパスタ') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/udon.jpg", array("alt" => "うどん・そば")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('うどん') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('讃岐うどん') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('煮込みうどん') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('カレーうどん') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('そば') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('きしめん') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ちゃんぽん') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('焼きそば') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('焼うどん') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('冷やし中華') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/setmenu.jpg", array("alt" => "定食・日本食")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('寿司') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('とんかつ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('天ぷら') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('焼き魚') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('からあげ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('フライ魚') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('エビフライ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('牡蠣フライ') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('焼肉') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('生姜焼き') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('野菜炒め') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('コロッケ') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('すき焼き') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('しゃぶしゃぶ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('おでん') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('焼き鳥') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('お好み焼き') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('もんじゃ焼き') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('たこ焼き') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/yoshoku.jpg", array("alt" => "洋食")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('ステーキ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ハンバーグ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('鉄板焼き') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('グリルチキン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('チキン南蛮') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('オムライス') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ハヤシライス') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('シチュー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ビーフシチュー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('クリームシチュー') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('ハンバーガー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ピザ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('サンドウィッチ') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/don.jpg", array("alt" => "丼もの")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('天丼') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('カツ丼') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('親子丼') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('牛丼') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('鰻重') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('麻婆丼') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('高菜丼') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('釜飯') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('ネギトロ丼') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('いくら丼') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('海鮮丼') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/okinawa.jpg", array("alt" => "沖縄料理")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('沖縄そば') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ゴーヤーチャンプルー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('フーチャンプルー') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ソーメンチャンプルー') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/chinese.jpg", array("alt" => "中華料理")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('餃子') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('飲茶') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('麻婆豆腐') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('チャーハン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('天津飯') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('中華飯') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('回鍋肉') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('酢豚') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('エビチリ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('レバニラ') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/korean.jpg", array("alt" => "韓国料理")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('プルコギ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('カルビ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('チヂミ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ビビンバ') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('スンドゥブ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('キムチチゲ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('サムゲタン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('ユッケジャン') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('チャプチェ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('冷麺') ?></div>
      </div>
   </div>
</div>
<div class="menu-category">
   <div class="menu-large-category">
       <?= $this->Html->image("/img/menu_category/thai.jpg", array("alt" => "タイ料理")) ?>
   </div>
   <div class="menu-small-category">
      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('トムヤムクン') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('トムヤムラーメン') ?></div>
      </div>

      <div class="row">
          <div class="col-lg-3"><?= $this->Menu->linkTags('ガパオ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('カオマンガイ') ?></div>
          <div class="col-lg-3"><?= $this->Menu->linkTags('パッタイ') ?></div>
      </div>
   </div>
</div>
*/ ?>