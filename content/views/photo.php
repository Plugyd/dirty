<?
    use React\Core\Store;
    $request = explode('/', $_SERVER['REQUEST_URI']);
    Store::Prepare('SELECT * FROM photos  WHERE id = ?');
    Store::BindValue(1, $request[2], PDO::PARAM_INT);
    Store::Execute();
    $data = Store::Fetch();
    
?>



<section class="section section-20" id="">
    <div class="container">
        <div class="row row-50 center">
            <div class="title"><?=$data['name']?></div>
            <div class="desc"><?=$data['desc']?></div>
        </div>
    </div>
</section>

<? 
$imgs = explode(';',$data['imgs']);
$page = 1;
?>

<div id="lightgallery">

    <? foreach ($imgs as $img) :?>
        <a href="<?=$img?>" class='s-photo-outer-photo'>
        <div class="pages-photos-photo">Изображение <?=$page?></div>
                <img src="<?=$img?>" alt="" class="s-photo-photo">
        </a>
        <? $page++;?>
    <? endforeach;?>
</div>
