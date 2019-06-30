<?
    use React\Core\Store;
    $request = explode('/', $_SERVER['REQUEST_URI']);

    if (isset($request[2]))
        $pages = $request[2];
    else $pages = 1;

    $min = ($pages * 15) - 15;
    $max = ($pages * 15);

    Store::Prepare('SELECT id FROM memes ');
    Store::Execute();
    $count = Store::RowCount();

    Store::Prepare('SELECT * FROM memes  ORDER BY id DESC LIMIT ?, ? ');
    Store::BindValue(1,$min, PDO::PARAM_INT);
    Store::BindValue(2,15, PDO::PARAM_INT);
    Store::Execute();
    $data = Store::FetchAll();
    $nump = ceil($count / 15);

    
    ?>
<section class="section section-140" id="">
    <section class="section section-100" id="">
        <section class="section section-20" id="">
            <div class="container-10">
                <div class="row row-50 ">
                    <div class="title">Мемы</div>
                    <div class="desc">Смешные картинки для душы.</div>
                </div>
            </div>
        </section>
        <section class="section section-0" id="">
            <div class="container-5">
                <div class="row row-50 ">
               
                <? foreach ($data as $category) :?>
            <div class="porn-category memes" id="<?=$category['id']?>">
                <div class="memez">
                <div class="porn-category-bottom mems"><?=$category['name']?></div>
                    <div class="porn-category-top memes">
                    <div class="lightgallery">
                    <a href="<?=$category['imgs']?>" class='s-photo-outer'>
                        <img src="<?=$category['imgs']?>" alt="">
                        </a>
                    </div>
                    </div>
                   
                </div>
            </div>
            <? endforeach;?>
                </div>
              
            </div>
        </section>
       
     
    </section>


</section>
<?
printf('<div tooltip="Номер страницы" flow="right" class="page-now">%s</div>',$pages);
if ($pages == 1)
{
    if($pages != $nump) printf('<a href="/memes/%s" tooltip="Следующая страница" flow="left" class="page-right"><i class="fa fa-angle-right"></i></a>',$pages + 1);
}else {
    if($pages == $nump) printf('<a href="/memes/%s" tooltip="Предыдущая страница" flow="right" class="page-left"><i class="fa fa-angle-left"></i></a>
    ',$pages - 1);
    else printf('<a href="/memes/%s" tooltip="Предыдущая страница" flow="right" class="page-left"><i class="fa fa-angle-left"></i></a>
    <a href="/memes/%s" tooltip="Следующая страница" flow="left" class="page-right"><i class="fa fa-angle-right"></i></a>',$pages - 1,$pages + 1);
}
?>
<section class="section section-10" id="">
    <div class="container-10">
        <div class="row row-30 ">
            <div class="pagination">
                    <? printf("<a href='/memes/%s' class='page special'>В начало</a>", 1);
                    if ($pages != 1) printf("<a href='/memes/%s' class='page special'>Предыдущая</a>", $pages - 1);
                    $maxpagefor =  $pages + 5;
                    if ($maxpagefor > $nump) $maxpagefor = $nump;
                    $minpagefor =  $pages - 5;
                    if ($minpagefor < 1) $minpagefor = 1;
                    for($pagefor = $minpagefor; $pagefor <= $maxpagefor; $pagefor++){  
                        if ($pagefor == $pages) printf("<a href='/memes/%s' class='page active'>%s</a>",$pagefor,$pagefor );
                        else printf("<a href='/memes/%s' class='page'>%s</a>",$pagefor,$pagefor );
                    }
                    if ($pages != $nump) printf("<a href='/memes/%s' class='page special'>Следующая</a>", $pages + 1);
                    printf("<a href='/memes/%s' class='page special'>В конец</a>", $nump);?>
            </div>
        </div>
    </div>
</section>



