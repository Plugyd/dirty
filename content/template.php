<!DOCTYPE html>
<html lang="ru">

<head>
    <title><?php echo $Title;?></title>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" content="<?=$Keywords?>">
    <meta name="description" content="<?=$Description?>">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="" />
    <meta property="og:title" content="<?php echo $Title;?>">
    <!-- Favicon -->
    <link rel="shortcut icon" href="/favicon.ico">
    <!-- Main styles -->
    <link rel="stylesheet" href="/css/style.min.css">
    <link rel="stylesheet" href="/css/reset.min.css">
    <!-- Font icon -->
    <link rel="stylesheet" href="/fontawesome/font-awesome.min.css">
    <!-- Light gallery -->
    <link rel="stylesheet" href="/css/lightgallery.min.css">
    <link rel="stylesheet" href="/css/lg-fb-comment-box.min.css">
    <link rel="stylesheet" href="/css/lg-transitions.min.css">
    <!-- Artplayer -->
    <link rel="stylesheet" href="/css/artplayer.css">
    <script src="/js/artplayer.js"></script>
    <!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
    <div id="top"><i class="fa fa-angle-up"></i></div>
    <? include "part/header.php"; ?>
    <main>
        <? include $viewway; ?>
    </main>
    <? include "part/footer.php"; ?>
    <div class='loads-all'>
        <section class="loads">
            <div class='sk-wave'>
                <div class='sk-rect sk-rect-1'></div>
                <div class='sk-rect sk-rect-2'></div>
                <div class='sk-rect sk-rect-3'></div>
                <div class='sk-rect sk-rect-4'></div>
                <div class='sk-rect sk-rect-5'></div>
            </div>
        </section>
    </div>
    <script src="/js/jquery-3.4.0.min.js"></script>
    <script src="/js/autosize.min.js"></script>
     <!-- Scripts -->
    <script src="/js/script.min.js"></script>
     <!-- Light gallery -->
    <script src="/js/lightgallery-all.min.js"></script
</body>
</html>