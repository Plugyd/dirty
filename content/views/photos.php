<?
    use React\Core\Store;
    $request = explode('/', $_SERVER['REQUEST_URI']);

    if (isset($request[2]))
        $pages = $request[2];
    else $pages = 1;

    $min = ($pages * 15) - 15;
    $max = ($pages * 15);

    Store::Prepare('SELECT id FROM photos ');
    Store::Execute();
    $count = Store::RowCount();

    Store::Prepare('SELECT * FROM photos  ORDER BY id DESC LIMIT ?, ? ');
    Store::BindValue(1,$min, PDO::PARAM_INT);
    Store::BindValue(2,15, PDO::PARAM_INT);
    Store::Execute();
    $data = Store::FetchAll();
    $nump = ceil($count / 15);

    
    ?>
<section class="section section-20" id="">
    <div class="container">
        <div class="row row-50 ">
            <div class="title">Порно фотографии</div>
            <div class="desc">Любишь смотреть на 18+ фотографии, тогда ты попал куда надо!</div>
        </div>
    </div>
</section>
<section class="section section-10" id="">
    <div class="container">
        <div class="row row-30 ">
            <? foreach ($data as $category) :?>
            <div class="porn-category" id="<?=$category['id']?>">
                <a href="/photo/<?=$category['id']?>">
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


<?
printf('<div tooltip="Номер страницы" flow="right" class="page-now">%s</div>',$pages);
if ($pages == 1)
{
    if($pages != $nump) printf('<a href="/photos/%s" tooltip="Следующая страница" flow="left" class="page-right"><i class="fa fa-angle-right"></i></a>',$pages + 1);
}else {
    if($pages == $nump) printf('<a href="/photos/%s" tooltip="Предыдущая страница" flow="right" class="page-left"><i class="fa fa-angle-left"></i></a>
    ',$pages - 1);
    else printf('<a href="/photos/%s" tooltip="Предыдущая страница" flow="right" class="page-left"><i class="fa fa-angle-left"></i></a>
    <a href="/photos/%s" tooltip="Следующая страница" flow="left" class="page-right"><i class="fa fa-angle-right"></i></a>',$pages - 1,$pages + 1);
}
?>
<section class="section section-10" id="">
    <div class="container-10">
        <div class="row row-30 ">
            <div class="pagination">
                    <? printf("<a href='/photos/%s' class='page special'>В начало</a>", 1);
                    if ($pages != 1) printf("<a href='/photos/%s' class='page special'>Предыдущая</a>", $pages - 1);
                    $maxpagefor =  $pages + 5;
                    if ($maxpagefor > $nump) $maxpagefor = $nump;
                    $minpagefor =  $pages - 5;
                    if ($minpagefor < 1) $minpagefor = 1;
                    for($pagefor = $minpagefor; $pagefor <= $maxpagefor; $pagefor++){  
                        if ($pagefor == $pages) printf("<a href='/photos/%s' class='page active'>%s</a>",$pagefor,$pagefor );
                        else printf("<a href='/photos/%s' class='page'>%s</a>",$pagefor,$pagefor );
                    }
                    if ($pages != $nump) printf("<a href='/photos/%s' class='page special'>Следующая</a>", $pages + 1);
                    printf("<a href='/photos/%s' class='page special'>В конец</a>", $nump);?>
            </div>
        </div>
    </div>
</section>



