<meta property="og:site_name" content="Coozo" />
<meta property="fb:app_id" content="765271586861527" />
<?
  //本番
  echo $this->Html->meta(array('property'=>'og:title', 'content'=>$title_for_layout));
  echo $this->Html->meta(array('property'=>'og:description', 'content'=>$description_for_layout));

  //og:type start
  if ($this->params['controller'] === 'pages' && $this->params['action'] === 'display'){
    echo $this->Html->meta(array('property'=>'og:type', 'content'=>'website'));
  }else{
    echo $this->Html->meta(array('property'=>'og:type', 'content'=>'article'));
  }
  //og:type end

  $defaultImage = 'http://coozo.co/img/coozo_logo_social_default.png';
  $defaultUrl = Router::reverse($this->request);
  //$defaultUrl = isset($canonical) ? '/' . $canonical : false;

  //og:image start
  $socialImage = isset($socialImage) ? $socialImage : $defaultImage;
  echo $this->Html->meta(array('property'=>'og:image', 'content'=>$socialImage));
  if ($socialImage == $defaultImage) $socialImageWidth = '200';
  if (isset($socialImageWidth)) {
    echo $this->Html->meta(array('property'=>'og:image:width', 'content'=>$socialImageWidth));
  }
  //og:image end

  //og:url start
  // MEMO: $socialUrl はコントローラ側で予めurlencodされている必要がある。
  if (!isset($socialUrl)) $socialUrl = $defaultUrl;
  if ($socialUrl) {
    echo $this->Html->meta(array('property'=>'og:url', 'content'=>'http://coozo.co'.$socialUrl));
  }
  //og:url end
?>
