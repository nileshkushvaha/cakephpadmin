<?php use Cake\Core\Configure;
use Cake\Routing\Router;
$lang = 'en';
if ($Configure::check('language')) {
    $lang = $Configure::read('language.culture');
}
?>
<?= $this->Html->docType();?>
<html lang="en">
<head>
  <?= $this->Html->charset();?>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?= $this->fetch('meta');?>
  
  <?= $this->Html->meta('favicon.ico','/favicon.ico',['type' => 'icon']);?>

  <title><?=$this->fetch('title');?> - <?= Configure::read('Theme.title'); ?></title>
 
  <?= $this->Html->meta('robots','all') ?> 
  
  <?php $path = Router::url(null,['_full'=>true]);
  echo $this->Html->tag('link', null, array('rel' =>'canonical','href'=>$path));?>

  <!-- Bootstrap -->
  <?= $this->Html->css('../assets/css/bootstrap.min.css'); ?>
  
  <!-- Font CSS -->
  <?= $this->Html->css(['../font-awesome/css/font-awesome.min','../assets/css/ionicons.min.css']); ?>
  <!-- Theme style --><?= $this->Html->css(['../assets/css/aos.css','../assets/css/jquery-ui','../assets/css/style.css']); ?>

  <!-- Custom Css -->
  <?= $this->fetch('css'); ?>
  <?=$this->fetch('head-style');?>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<?php
$params = $this->request->getAttribute('params');
$classes = [];
if ($lang) {
  $classes[] = $lang;
}
if (!empty($userArray)) {
  $classes[] = 'logged-in';
  $classes[] = $userArray['name'];
} else {
  $classes[] = 'not-logged-in';
}
$classes[] = $params['controller'];
$classes[] = $params['action'];
array_unique( $classes );
?>
<body class="bg-white inner-page hold-transition page-template-frontend <?php echo implode(' ',$classes);?>">
  <div id="wrapper">
    <?= $this->element('header'); ?>
    <?= $this->fetch('content'); ?>
    <?= $this->element('footer'); ?>
    <?= $this->element('noscript'); ?>
  </div>

<?= $this->Html->script(['jquery.min.js','../assets/js/jquery-ui','../assets/js/bootstrap.bundle.min.js','../assets/js/aos.js','jquery.validate.min','jquery-additional-methods.min','../assets/js/modernizr-custom.js','../assets/js/main.js','../assets/js/functions.js','../assets/js/general.js']); ?>
 
<?= $this->fetch('script'); ?>
<?= $this->Html->script('scripts'); ?>
<?=$this->fetch('bottom-script')?>
<script type="text/javascript">
  var _langChange = false;
  var _ChangeLang = function (_lang){
    <?php
    echo "var _langUrls = [];";
    if ($Configure::check('CurrentLanguageUrls')) {
      echo "var _langUrls = JSON.parse('" . (json_encode($Configure::read('CurrentLanguageUrls'))) . "');";
    }
    ?>
    if(_langChange){
      return;
    }
    if(_langUrls[_lang] !== undefined && _langUrls[_lang] != ''){
       _langChange = true;
      window.location = _langUrls[_lang];
    }
  }
</script>
</body>
</html>