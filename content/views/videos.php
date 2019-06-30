<?
 use React\Core\Store;
 $request = explode('/', $_SERVER['REQUEST_URI']);

 if (isset($request[3]))
     $pages = $request[3];
 else $pages = 1;

 $min = ($pages * 15) - 15;
 $max = ($pages * 15);

Store::Prepare('SELECT name FROM category WHERE id = ?');
Store::BindValue(1,$request[2], PDO::PARAM_INT);
Store::Execute();
$data = Store::Fetch();
?>

<section class="section section-20" id="">
    <div class="container">
        <div class="row row-50 ">
            <div class="title"><?=$data['name']?></div>
            <div class="desc">Для вас мы отобрали различные видео которые набирают популярность прямо сейчас. Посмотри и убедись в этом сам!</div>
        </div>
    </div>
</section>
<?

  Store::Prepare('SELECT id FROM video  WHERE cat = ?');
  Store::BindValue(1,$request[2], PDO::PARAM_INT);
  Store::Execute();
  $count = Store::RowCount();

  Store::Prepare('SELECT * FROM video  WHERE cat = ? ORDER BY id DESC LIMIT ?, ? ');
  Store::BindValue(1,$request[2], PDO::PARAM_INT);
  Store::BindValue(2,$min, PDO::PARAM_INT);
  Store::BindValue(3,15, PDO::PARAM_INT);
  Store::Execute();

  $data = Store::FetchAll();
  $nump = ceil($count / 15);
?>


<section class="section section-10" id="">
    <div class="container-10">
        <div class="row row-30 ">


            <? foreach ($data as $category) :?>
            <div class="porn-category" id="<?=$category['id']?>">
                <a href="/watch/<?=$category['id']?>">
                    <div class="porn-category-top">
                        <img src="<?=$category['preview']?>" alt="">
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
    if($pages != $nump) printf('<a href="/videos/%s/%s" tooltip="Следующая страница" flow="left" class="page-right"><i class="fa fa-angle-right"></i></a>',$request[2],$pages + 1);
}else {
    if($pages == $nump) printf('<a href="/videos/%s/%s" tooltip="Предыдущая страница" flow="right" class="page-left"><i class="fa fa-angle-left"></i></a>
    ',$request[2],$pages - 1);
    else printf('<a href="/videos/%s/%s" tooltip="Предыдущая страница" flow="right" class="page-left"><i class="fa fa-angle-left"></i></a>
    <a href="/videos/%s/%s" tooltip="Следующая страница" flow="left" class="page-right"><i class="fa fa-angle-right"></i></a>',$request[2],$pages - 1,$pages + 1);
}
?>
<section class="section section-10" id="">
    <div class="container-10">
        <div class="row row-30 ">
            <div class="pagination">
                    <? printf("<a href='/videos/%s/%s' class='page special'>В начало</a>",$request[2], 1);
                    if ($pages != 1) printf("<a href='/videos/%s/%s' class='page special'>Предыдущая</a>", $request[2],$pages - 1);
                    $maxpagefor =  $pages + 5;
                    if ($maxpagefor > $nump) $maxpagefor = $nump;
                    $minpagefor =  $pages - 5;
                    if ($minpagefor < 1) $minpagefor = 1;
                    for($pagefor = $minpagefor; $pagefor <= $maxpagefor; $pagefor++){  
                        if ($pagefor == $pages) printf("<a href='/videos/%s/%s' class='page active'>%s</a>",$request[2],$pagefor,$pagefor );
                        else printf("<a href='/videos/%s/%s' class='page'>%s</a>",$request[2],$pagefor,$pagefor );
                    }
                    if ($pages != $nump) printf("<a href='/videos/%s/%s' class='page special'>Следующая</a>",$request[2], $pages + 1);
                    printf("<a href='/videos/%s/%s' class='page special'>В конец</a>",$request[2], $nump);?>
            </div>
        </div>
    </div>
</section>


