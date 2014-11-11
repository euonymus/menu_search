<header class="well">
<h1><?= $word['Word']['name'] ?></h1>
</header>


<section id="related">
<? foreach ($word['Related'] as $key => $related): ?>
    <section id="talk-line-<?= $related['id'] ?>" class="panel panel-default">
      <div class="panel-body">
   <?= $related['name'] ?>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <?= $related['WordRelation']['description'] ?>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   (<?= U::toDate($related['WordRelation']['start']) ?> ~ 
    <?= U::toDate($related['WordRelation']['end']) ?> )
      </div>
    </section>
<? endforeach; ?>
</section>




