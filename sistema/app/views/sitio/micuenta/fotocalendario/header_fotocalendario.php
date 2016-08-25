<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Tinbox Sistema</title>


<div id="foopropio"></div>


<script src="<?php echo get_template_directory_uri(); ?>/js/spin.js"></script>


<script>
var opts = {
      lines: 13, 
      length: 20, 
      width: 10, 
      radius: 30, 
      corners: 1, 
      rotate: 0, 
      direction: 1, 
      color: '#E8192C',
      speed: 1, 
      trail: 60,
      shadow: false,
      hwaccel: false,
      className: 'spinner',
      zIndex: 2e9, 
      top: '50%', // Top position relative to parent
      left: '50%', // Left position relative to parent   
      position: 'absolute' // Element positioning
    };

  new Spinner(opts).spin(document.getElementById('foopropio'));
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

   <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.form.min.js"></script>
   <script src="<?php echo get_template_directory_uri(); ?>/js/spin.min.js"></script>


<script src="<?php echo get_template_directory_uri(); ?>/js/easyResponsiveTabs.js"></script>

<!-- <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/estilos.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.css">

<!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.css">

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/easy-responsive-tabs.css " />


  
<?php //wp_head(); ?>
</head>


<body>
