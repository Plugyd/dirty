<?
    use React\Core\Store;
    Store::Prepare('SELECT * FROM category  ORDER BY id DESC LIMIT ?, ? ');
    Store::BindValue(1,0, PDO::PARAM_INT);
    Store::BindValue(2,15, PDO::PARAM_INT);
    Store::Execute();
    $data = Store::FetchAll();
?>

<section class="section section-20" id="">
    <div class="container">
        <div class="row row-50 ">
            <div class="title">Категории порно</div>
            <div class="desc">Только лучшее и отборное порно каждый день. Различные жанры порно и категории какие только
                пожелаешь.</div>
        </div>
    </div>
</section>


<section class="section section-10" id="">
    <div class="container">
        <div class="row row-30 ">
            <? foreach ($data as $category) :?>
            <div class="porn-category" id="<?=$category['id']?>">
                <a href="/videos/<?=$category['id']?>">
                    <div class="porn-category-top">
                        <img src="<?=$category['img']?>" alt="">
                    </div>
                    <div class="porn-category-bottom"><?=$category['name']?></div>
                </a>
            </div>
            <? endforeach;?>


        </div>

    </div>
</section>

<section class="section section-20" id="">
    <div class="container">
        <div class="row row-50 ">
            <div class="title">Популярное порно</div>
            <div class="desc">Для вас мы отобрали различные видео которые набирают популярность прямо сейчас. Посмотри и убедись в этом сам!</div>
        </div>
    </div>
</section>

<?
Store::Prepare('SELECT * FROM video  ORDER BY id DESC LIMIT ?, ?');
Store::BindValue(1,0, PDO::PARAM_INT);
Store::BindValue(2,8, PDO::PARAM_INT);
Store::Execute();
$new = Store::FetchAll();

Store::Prepare('SELECT * FROM video  ORDER BY views DESC LIMIT ?, ?');
Store::BindValue(1,0, PDO::PARAM_INT);
Store::BindValue(2,8, PDO::PARAM_INT);
Store::Execute();
$popylar = Store::FetchAll();
?>

<section class="section section-10" id="">
    <div class="container">
        <div class="row row-30 ">

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

    </div>
</section>




<section class="section section-20" id="">
    <div class="container">
        <div class="row row-50 ">
            <div class="title">Новое порно</div>
            <div class="desc">Самые новые порно видео которое только что добавили, специально для тебя.</div>

        </div>
    </div>
</section>


<section class="section section-10" id="">
    <div class="container">
        <div class="row row-30 ">

        <? foreach ($new as $news) :?>
            <div class="porn-category" id="<?=$news['id']?>">
                <a href="/watch/<?=$news['id']?>">
                    <div class="porn-category-top">
                        <img src="<?=$news['preview']?>" alt="">
                    </div>
                    <div class="porn-category-bottom"><?=$news['name']?></div>
                </a>
            </div>
            <? endforeach;?>
        </div>

    </div>
</section>


