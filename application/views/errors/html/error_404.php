<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>TODO LIST - SAYFA BULUNAMADI!</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin, Dashboard, Bootstrap"/>
    <link rel="shortcut icon" sizes="196x196" href="<?php echo config_item('base_url'); ?>assets/img/icon.png">
    <link rel="stylesheet" href="<?php echo config_item('base_url'); ?>assets/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo config_item('base_url'); ?>assets/css/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="<?php echo config_item('base_url'); ?>assets/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo config_item('base_url'); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo config_item('base_url'); ?>assets/css/core.css">
    <link rel="stylesheet" href="<?php echo config_item('base_url'); ?>assets/css/misc-pages.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
</head>
<body class="simple-page">
<!--<div id="back-to-home">
    <a href="<?php /*echo config_item('base_url'); */ ?>" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
</div>-->
<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="<?php echo config_item('base_url');
        ?>">
            <span><i class="fa fa-gg"></i></span>
            <span>TODO LIST</span>
        </a>
    </div><!-- logo -->
    <h1 id="_404_title" class="animated shake">404</h1>
    <h5 id="_404_msg" class="animated slideInUp">Hata! Bir hata oluştu. Sayfa bulunamadı</h5>
    <div id="_404_form" class="animated slideInUp">
        <a href="<?php echo config_item('base_url'); ?>" class="btn btn-primary" style="width: 100%;">
            <i class="fa fa-home animated zoomIn"></i>&nbsp;Anasayfa
        </a>
    </div>
</div>
</body>
</html>
