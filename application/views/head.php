<?php $this->load->helper('url'); ?>

<html>
<head>

<title><?= isset( $page_title ) ? $page_title : 'Beer Me A Link - URL Shortener'; ?></title>

<link type="text/css" rel="stylesheet" href="/css/main.css" />
<script type="text/javascript" src="<?=base_url()?>js/jquery.min.js"></script>

<?php if ( isset( $javascripts ) ) : ?>
<?php foreach ( $javascripts as $src ) : ?>
<script type="text/javascript" src="<?=base_url()?><?=$src?>"></script>
<?php endforeach; ?>
<?php endif; ?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33367343-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<body>

  <div class="wrapper">