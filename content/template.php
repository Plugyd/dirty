<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?php echo $Title;?></title>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" content="<?=$Keywords?>">
    <meta name="description" content="<?=$Description?>">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="" />
    <meta property="og:title" content="<?php echo $Title;?>">
    <link rel="shortcut icon" href="/favicon.ico">

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/artplayer.css">
    <link rel="stylesheet" href="/fontawesome/font-awesome.min.css">
    <link rel="stylesheet" href="/css/lightgallery.min.css">
    <link rel="stylesheet" href="/css/lg-fb-comment-box.min.css">
    <link rel="stylesheet" href="/css/lg-transitions.min.css">
    <script src="/js/artplayer.js"></script>

</head>

<body>
    <div id="top"><i class="fa fa-angle-up"></i></div>
    <? include "part/header.php"; ?>
    <main>
    <? include $viewway; ?>
    </main>
    <? include "part/footer.php"; ?>


    <div class="loader">
<div class="l_main">
  <div class="l_square"><span></span><span></span><span></span></div>
  <div class="l_square"><span></span><span></span><span></span></div>
  <div class="l_square"><span></span><span></span><span></span></div>
  <div class="l_square"><span></span><span></span><span></span></div>
</div>
</div>

    <script src="/js/jquery-3.4.0.min.js"></script>
    <script src="/js/autosize.min.js"></script>
    <script src="/js/script.js"></script>
    <script src="/js/lightgallery-all.min.js"></script>
     
    <!-- <script src="https://kit.fontawesome.com/bd2177d70d.js"></script> -->
    <!-- <script src='https://www.google.com/recaptcha/api.js?hl=ru'></script> -->
    <!-- Todo Google recaptha and kit font awesome -->
</body>

</html>