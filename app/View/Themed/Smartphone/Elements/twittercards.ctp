<?
$defaultTitle = h($title_for_layout);
$defaultDesc  = isset($description_for_layout) ? h($description_for_layout) : '';
$defaultImage = 'http://coozo.co/img/coozo_logo_social_default.png';
$twittercards = array(
     'card'        => 'summary',
     'site'        => '@coozo_office',
     'title'       => isset($socialTitle) ? $socialTitle: $defaultTitle,
     'description' => isset($socialDescription) ? $socialDescription:  $defaultDesc,
     'image:src'   => isset($socialImage) ? $socialImage: $defaultImage,
);
?>
<? foreach($twittercards as $key => $val): ?>
<?= $this->element('twittercard', array('tcTag' => $key,'tcContent' => $val)) ?>
<? endforeach; ?>
