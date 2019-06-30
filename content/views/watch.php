<?
	$request = explode('/', $_SERVER['REQUEST_URI']);
	use React\Core\Store;

    Store::Prepare('SELECT * FROM video WHERE id = ?');
    Store::BindValue(1,$request[2], PDO::PARAM_INT);
    Store::Execute();
    $data = Store::Fetch();

    Store::Prepare('UPDATE video SET views = views + 1 WHERE id = ?');
    Store::BindValue(1,$request[2], PDO::PARAM_INT);
    Store::Execute();
    
    ?>
<section class="section section-140" id="">
    <section class="section section-100" id="">
        <section class="section section-20" id="">
            <div class="container-10">
                <div class="row row-50 ">
                    <div class="title"><?=$data['name']?></div>

                </div>
            </div>
        </section>
        <section class="section section-0" id="">
            <div class="container-5">
                <div class="row row-50 ">

                    <div class="artplayer-app"></div>
                </div>
            </div>
        </section>        
        <script>
            var art = new Artplayer({
                container: '.artplayer-app',
                url: '<?=$data['url']?>',
                volume: 0.5,
                isLive: false,
                muted: false,
                autoplay: false,
                pip: true,
                autoSize: true,
                screenshot: true,
                setting: true,
                loop: true,
                flip: true,
                playbackRate: true,
                aspectRatio: true,
                fullscreen: true,
                fullscreenWeb: true,
                mutex: true,
                theme: '#ffad00'
            });
        </script>
        <section class="section section-0" id="">
            <div class="container-5">
                <div class="row row-50 ">
                    <div class="video-desc">

                    <div class="category"><?=$data['name']?></div>
                    <div class="name-category">Домашнее порно</div>

                    </div>
                    <div class="watch-desc"><?=$data['desk']?></div>

                    <div class="but-panel">
                        <div class="button bp repost">Поделиться</div>
                        <div class="button bp like">Нравиться <?=$data['likes']?></div>
                        <div class="button bp download">Скачать</div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-20" id="">
            <div class="container-10">
                <div class="row row-50 ">
                    <div class="title">Комментарии</div>

                </div>
            </div>
        </section>
    </section>

    <?

Store::Prepare('SELECT * FROM video  ORDER BY views DESC LIMIT ?, ?');
Store::BindValue(1,0, PDO::PARAM_INT);
Store::BindValue(2,3, PDO::PARAM_INT);
Store::Execute();
$popylar = Store::FetchAll();
?>


    <section class="section section-120" id="">
        <div class="row row-150 ">
            <div class="title title-m">Популярное</div>

            <? foreach ($popylar as $popylars) :?>
            <div class="porn-category" id="<?=$popylars['id']?>">
                <a href="/watch/<?=$popylars['id']?>">
                    <div class="porn-category-top">
                        <img src="<?=$popylars['preview']?>" alt="">
                    </div>
                    <div class="porn-category-bottom"><?=$popylars['name']?></div>
                </a>
            </div>
            <? endforeach;?>

        </div>
    </section>
</section>

