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
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="/css/style.min.css">
    <link rel="stylesheet" href="/css/reset.min.css">
    <!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
    <? include $viewway; ?>
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
    <script src="/js/script.min.js"></script>
    <script src="/js/jcrop.min.js"></script>
</body>
</html>